<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    public function handle(Request $request, Closure $next)
    {
      
        if(Auth::check()){
            if ($this->auth->user()->archived_at) {
                $this->auth->logout();
                return redirect()->route('login');
            }
               return $next($request);
        }else{
            return redirect()->route('login');
        }
    
       
     
    }


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
