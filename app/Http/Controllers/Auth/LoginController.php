<?php

namespace App\Http\Controllers\Auth;

use Session;
use DateTime;
use Auth;
use App\UserLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user){

        if ($user->archived_at) {// do your magic here
            Auth::logout();
            $message = $user->archived_reason ?? 'Your account is currently inactive. Please contact your administrator';
            return redirect('/login')->with('error', $message);   
        }

        $dt = new DateTime();
        $server = \Request::server();
        $useragent = $server['HTTP_USER_AGENT'];
        $ip_address = \Request::ip();
        
        $log = new UserLog;
        $log->user_id = Auth::user()->id;
        $log->ip_address = $ip_address;
        $log->user_agent = $useragent;
        $log->last_activity = now();
        $log->save();
        Session::put('login_session_id', $log->id);

        if(Auth::user()->role == 'admin' || Auth::user()->role == 'librarian'){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('library.index');
        }

   
    
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
}
