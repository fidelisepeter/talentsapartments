<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        
        if (env('ENFORCE_SSL', true)) {
            $url->forceScheme('https');
            # code...
        }
        //Store Viewing Year
        View::share( 'viewingYear', DB::table('settings')->value('viewing_year'));

    }
}
