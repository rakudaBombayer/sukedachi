<?php

namespace App\Providers;
// AppServiceProvider.php の bootメソッドに追加
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;



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
        // if (env('APP_ENV') === 'production') {
        // URL::forceScheme('https');
        // }
        if (App::environment('production')) {
        URL::forceScheme('https');
        }
    }
}