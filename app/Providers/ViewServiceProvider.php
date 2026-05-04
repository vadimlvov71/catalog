<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use App\Enums\ItemStatus;
use App\Enums\Language;


class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        // Share data with specific views
        View::composer(['admin.items.*', 'admin.categories.*'], function ($view) {
            $view->with('statuses', ItemStatus::cases());
        });
        View::composer(['admin.items.*', 'admin.categories.*'], function ($view) {
            $view->with('languages', Language::cases());
        });
        View::composer(['admin.items.*', 'admin.categories.*'], function ($view) {
            $view->with('locales', Config::get('app.available_locales'));
        });
        
;
        // Or share with all views
       /* View::composer('*', function ($view) {
            $view->with('statuses', ItemStatus::cases());
        });*/

        // Share with multiple view groups
       /* View::composer(['item.*', 'products.*'], function ($view) {
            $view->with('statuses', ItemStatus::cases());
        });*/
    }
}