<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\BebrasPengumumanService;

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
        // Share pengumuman years to navbar (from database via service)
        View::composer('components.navbar', function ($view) {
            $pengumumanService = app(BebrasPengumumanService::class);
            $years = $pengumumanService->getYears(); // Gets data from database directly
            $view->with('pengumumanYears', $years);
        });
    }
}
