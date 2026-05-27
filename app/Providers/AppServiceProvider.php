<?php

namespace App\Providers;

use App\Repositories\ItemRepository;
use Illuminate\Support\ServiceProvider;
use App\Services\TranslationExportService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TranslationExportService::class, function ($app) {
            return new TranslationExportService($app->make(\Illuminate\Filesystem\Filesystem::class));
        });
       /* $this->app->bind(ItemRepository::class, function ($app) {
            return new ItemRepository();
        });*/
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
