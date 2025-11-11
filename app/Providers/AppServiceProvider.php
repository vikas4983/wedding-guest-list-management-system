<?php

namespace App\Providers;

use App\Services\CountService;
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
        $modelCount = app(CountService::class)->getCount();
        View::share('count', $modelCount);
    }
}
