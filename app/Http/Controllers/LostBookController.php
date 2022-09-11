<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\LostBook;
use Carbon\Carbon;
use App\RequestedBook;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\LostBookRepository;
use App\Http\Repositories\NotificationRepository;

class LostBookController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $reports = app(LostBookRepository::class)->query()
        ->orderBy('created_at','DESC')
        ->when(Auth::user()->role != 'librarian', function ($query) {
            $query->whereUserId(Auth::user()->id);
        })
        ->paginate(10);
        return view('requests.lost-books.index',compact('reports'));
    }
    
    public function create(RequestedBook $requested_book){
       return view('requests.lost-books.create',compact('requested_book'));
    }

    public function save(Request $request){

         $request->validate([
            'subject'           => 'required',
            'date'              => 'required|date',
            'description'       => 'required'
        ]);

        $file = $request->file ? UploadHelper::uploadFile($request->file) : null;
        
        $data = [
            'book_id'              => $request->book_id,
            'requested_book_id'    => $request->requested_book_id,
            'user_id'              => Auth::user()->id,
            'subject'              => $request->subject,
            'description'          => $request->description,
            'file'                 => $file,
            'date_of_incident'     => $request->date
        ];

        DB::beginTransaction();
        try {
            RequestedBook::whereId($request->requested_book_id)->update(['lost_at'=> now()]);
            $lost_book = app(LostBookRepository::class)->save($data);
              //notify all librarians
            $librarians = app(UserRepository::class)->query()->whereRole('librarian')->whereNull('archived_at')->pluck('id');
            foreach($librarians as $librarian){
                $notification_data = [
                    'notifiable_id' => $librarian,
                    'notified_by'   => Auth::user()->id,
                    'description'   => 'submitted a lost book report',
                    'url'           => '/lost-books/show/'.$lost_book->id,
                    'read_at'       => null
                ];
                app(NotificationRepository::class)->save($notification_data);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('request-book.index')->with('error', 'There are some errors in your requests');
        }

        return redirect()->route('lost-books.index')->with('success', 'Report submitted');
    }

    public function show(LostBook $lost_book){
        $lost_book->load('book','requestedBook','user.filedReports','approverAccount');
        return view('requests.lost-books.show',compact('lost_book'));
    }

    public function downloadAttachment(LostBook $lost_book){
        $filepath = public_path('files/'.$lost_book->file);
        return Response()->download($filepath);
    }

    public function approve(LostBook $lost_book){
        DB::beginTransaction();
        try {
            $requested_book = app(LostBookRepository::class)->approve($lost_book->id,Carbon::now()->format('Y-m-d'));
            $notification_data = [
                'notifiable_id' => $lost_book->user_id,
                'notified_by'   => Auth::user()->id,
                'description'   => 'approved your lost book report',
                'url'           => '/lost-books/show/'.$lost_book->id,
                'read_at'       => null
            ];
            app(NotificationRepository::class)->save($notification_data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('request-book.index')->with('error', 'There are some errors in your requests');
        }
        return redirect()->back()->with('success', 'Report approved');
    }
}
