<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if(Auth::check()){
            if(Auth::user()->archived_at != null) {
                Auth::logout();
                return redirect('login')->withErrors(['Your account is inactive']);
            }
        }
     
    }
}
