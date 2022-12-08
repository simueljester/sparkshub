<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use App\RequestedBook;
use Illuminate\Http\Request;
use App\Http\Repositories\BookRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\NotificationRepository;
use App\Http\Repositories\RequestedBookRepository;
use Illuminate\Pagination\Paginator;

class RequestedBookController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        
        Paginator::useBootstrap();
        $three_days = Carbon::now()->addDays(3);
        $filter = $request->filter ?? null;
        $requests = app(RequestedBookRepository::class)->query()
        ->with('book:id,title,category_id','user:id,role,name')
        ->when($filter == 'due_dates', function ($query) use ($filter,$three_days) {
            $query->whereBetween('end_date', [Carbon::now(),$three_days])
            ->whereNull('returned_at');
        })
        ->when($filter == 'unreturned', function ($query) use ($filter) {
            $query->whereNull('returned_at');
        })
        ->when($filter == 'pending', function ($query) use ($filter) {
            $query->whereNull('returned_at')->whereNull('approved_at');
        })
        ->when($filter == 'lost', function ($query) use ($filter) {
            $query->whereNotNull('lost_at');
        })
        ->when(Auth::user()->role != 'librarian', function ($query) {
            $query->whereUserId(Auth::user()->id);
        })
        ->orderBy('created_at','DESC')
        ->paginate(10);
        return view('requests.index',compact('requests','filter'));
    }

    //can access this function thru library
    public function requestBook(Request $request){
        $book = app(BookRepository::class)->find($request->book_id);
        $book->load('category:id,name');    
        return view('requests.request-book',compact('book'));
    }

    public function save(Request $request){
       
        $start_date = Carbon::now()->startOfDay();
        $end_date = Carbon::parse($request->end_date)->endOfDay();
        $diff = $end_date->diffInDays($start_date);
        if($diff > 5){
            return redirect()->route('library.books')->with('error', 'Maximum of 5 days to borrow this book');
        }
        $book = app(BookRepository::class)->find($request->book_id);
        if($book->copies == 0){
            return redirect()->back()->with('error', 'There are no copies available for this book');
        }

        DB::beginTransaction();
        try {
            $data = [
                'book_id'       => $request->book_id,
                'user_id'       => $request->user_id,
                'message'       => $request->message,
                'start_date'    => $start_date,
                'end_date'      => $end_date,
                'approved_at'   => null,
                'approver'      => null,
                'returned_at'   => null,
                'duration'      => null
            ];
            $requested_book = app(RequestedBookRepository::class)->save($data);

            //notify all librarians
            $librarians = app(UserRepository::class)->query()->whereRole('librarian')->whereNull('archived_at')->pluck('id');
            foreach($librarians as $librarian){
                $notification_data = [
                    'notifiable_id' => $librarian,
                    'notified_by'   => $request->user_id,
                    'description'   => 'has requested to borrow book '. $requested_book->book->title,
                    'url'           => '/request-book/show/'.$requested_book->id,
                    'read_at'       => null
                ];
                app(NotificationRepository::class)->save($notification_data);
            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('library.index')->with('error', 'There are some errors in your requests');
        }
  
        return redirect()->route('request-book.index')->with('success', 'Book successfully requested!');
    }

    public function show(RequestedBook $requested_book){
        $requested_book->load('book.category','user','approverAccount');
        return view('requests.show',compact('requested_book'));
    }

    public function approve(Request $request){
        $requested_book = app(RequestedBookRepository::class)->find($request->requested_book);
        if(now()->gt($requested_book->end_date)){
            return redirect()->back()->with('error', 'Requested end date has passed. Unable to approve');
        }
        $book = app(BookRepository::class)->find($requested_book->book_id);
        if($book->copies == 0){
            return redirect()->back()->with('error', 'There are no copies available for this book');
        }
        DB::beginTransaction();
        try {
            $requested_book = app(RequestedBookRepository::class)->approve($request->requested_book,$request->approval_date);
            $book->copies = $book->copies - 1;
            $book->save();

            $notification_data = [
                'notifiable_id' => $requested_book->user_id,
                'notified_by'   => Auth::user()->id,
                'description'   => 'approved your book request '.$requested_book->book->title,
                'url'           => '/request-book/show/'.$requested_book->id,
                'read_at'       => null
            ];
            app(NotificationRepository::class)->save($notification_data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('library.index')->with('error', 'There are some errors in your requests');
        }
        return redirect()->route('request-book.show',$requested_book)->with('success', 'Request successfully approved!');
    }

    public function returned(Request $request){
        $return_date = Carbon::parse($request->returned_date);
        $requested_book = app(RequestedBookRepository::class)->find($request->requested_book);
        if($requested_book->approved_at->gt($return_date)){
            return redirect()->back()->with('error', 'Returned date must be greater than approved date '.$requested_book->approved_at);
        }

        DB::beginTransaction();
        try {
            $requested_book->returned_at = $return_date;
            $requested_book->duration = $return_date->diffInSeconds($requested_book->approved_at);
            $requested_book->lost_at = null;
            $requested_book->save();

            $book = app(BookRepository::class)->find($requested_book->book_id);
            $book->copies = $book->copies + 1;
        $book->save();

             DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('library.index')->with('error', 'There are some errors in your requests');
        }
        return redirect()->route('request-book.show',$requested_book)->with('success', 'Request successfully marked as returned!');
    }
}
