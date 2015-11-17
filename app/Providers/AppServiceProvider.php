<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Business;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $system = Business::all()->first();
        view()->share('business_name',$system->business_name);
        view()->share('favicon', $system->favicon);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
