<?php

namespace App\Http\Middleware;

use Closure;
use App\UserLog;
use Session;
use Auth;
use Illuminate\Http\Request;

class LastActivityAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id =  Session::get('login_session_id');
        $login = UserLog::find($id) ?? null;
        if($login){
            if(Auth::check()){
                $login->last_activity = now();
                $login->save();  
            }
        }else{
            Auth::logout();
        }
    
        return $next($request);
    }
}
