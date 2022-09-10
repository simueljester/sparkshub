<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\RequestedBook;
use Illuminate\Http\Request;
use App\Http\Repositories\BookRepository;
use App\Http\Repositories\RequestedBookRepository;

class RequestedBookController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $requests = app(RequestedBookRepository::class)->query()->with('book:id,title,category_id','user:id,role,name')->orderBy('created_at','DESC')->get();
        return view('requests.index',compact('requests'));
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
        $book = app(BookRepository::class)->find($request->book_id);
        if($book->copies == 0){
            return redirect()->back()->with('error', 'There are no copies available for this book');
        }
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

        app(RequestedBookRepository::class)->save($data);
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
        $requested_book = app(RequestedBookRepository::class)->approve($request->requested_book,$request->approval_date);
        $book->copies = $book->copies - 1;
        $book->save();
        return redirect()->route('request-book.show',$requested_book)->with('success', 'Request successfully approved!');
    }

    public function returned(Request $request){
        $return_date = Carbon::parse($request->returned_date);
        $requested_book = app(RequestedBookRepository::class)->find($request->requested_book);
        if($requested_book->approved_at->gt($return_date)){
            return redirect()->back()->with('error', 'Returned date must be greater than approved date '.$requested_book->approved_at);
        }
        $requested_book->returned_at = $return_date;
        $requested_book->duration = $return_date->diffInSeconds($requested_book->approved_at);
        $requested_book->save();

        $book = app(BookRepository::class)->find($requested_book->book_id);
        $book->copies = $book->copies + 1;
        $book->save();
        return redirect()->route('request-book.show',$requested_book)->with('success', 'Request successfully marked as returned!');
    }
}
