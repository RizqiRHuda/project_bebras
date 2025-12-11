<?php
namespace App\Providers;

use App\Services\BebrasPengumumanService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Share pengumuman years to navbar
        View::composer('components.navbar', function ($view) {
            $pengumumanService = app(BebrasPengumumanService::class);
            $years             = $pengumumanService->getYears();
            $view->with('pengumumanYears', $years);
        });

        View::composer('components.navbar', function ($view) {
            $workshopYears = DB::table('tahun_workshop')
                ->orderBy('tahun', 'asc')
                ->get();

            $view->with('workshopYears', $workshopYears);
        });
    }
}
