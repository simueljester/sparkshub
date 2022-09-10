<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

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
}
