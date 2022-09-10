<?php

namespace App\Providers;


use Auth;
use App\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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

        View::composer('*', function($view){
            $notifications = Notification::where('notifiable_id', Auth::id())
                    ->whereNull('read_at')
                    ->with('notifiable','notifiedBy')
                    ->orderBy('created_at','DESC')
                    ->limit(5)
                    ->get();

            View::share([
                'notifications' => $notifications,
            ]);
        });
     
    }
}
