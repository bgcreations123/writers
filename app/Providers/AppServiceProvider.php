<?php

namespace App\Providers;

use Auth;
use App\Message;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // View::composer('*', MessagesComposer::class);
        view()->composer('*', function($view)
        {
            if (Auth::check()) {
                $view->with('message_count', Message::Where([['reciever_id', Auth::user()->id], ['message_status_id', 2]])->get());
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
