<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\ViewComposers\SidebarComposer;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('admin.partials.sidebar', SidebarComposer::class);
    }
}
