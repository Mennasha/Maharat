<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\ContactRequest;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share unread contact-request count with all admin views
        View::composer('layouts.admin', function ($view) {
            $view->with('unreadCount', ContactRequest::where('is_read', false)->count());
        });
    }
}
