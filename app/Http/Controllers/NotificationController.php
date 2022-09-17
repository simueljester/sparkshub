<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Notification;
use App\Mail\HelloEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Repositories\RequestedBookRepository;

class NotificationController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function read(Notification $notification){
        $notification->read_at = now();
        $notification->save();
        return redirect($notification->url);
    }

    public function sendEmail(Request $request){
        $distinctEmail = array();
        $filter = 'due_dates';
        $three_days = Carbon::now()->addDays(3);

        //get requested books with no returned and has approval
        $requested_books = app(RequestedBookRepository::class)->query()
        ->with('user:id,name,email')
        ->when($filter == 'due_dates', function ($query) use ($filter,$three_days) {
            $query->whereBetween('end_date', [Carbon::now(),$three_days])
            ->whereNull('returned_at')
            ->whereNotNull('approved_at');
        })->get();

        foreach($requested_books as $requested_book){
            $distinctEmail[] = $requested_book->user->email;
        }
    
        foreach(array_unique($distinctEmail) as $email){
             $details = [
                'title' => $request->title ?? 'Due Date Notification',
                'body' => $request->body ?? 'This is to notify you that upcoming due date of your borrowed books'
            ];
            \Mail::to($email)->send(new \App\Mail\HelloEmail($details));
        }
       
        return redirect()->back()->with('success','Users successfully notified via email!');
      
      
       
    }
}
