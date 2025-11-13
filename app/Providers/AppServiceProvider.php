<?php

namespace App\Providers;

use App\Services\CountService;
use App\Services\StaticDataService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CountService::class, function () {
            return new CountService();
        });
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Count
        $modelCount = app(CountService::class)->getCount();
        View::share('count', $modelCount);
        // Event
        $data = app(StaticDataService::class)->getData();
        View::share('data', $data);
        // Dashboard
        
    }
}
