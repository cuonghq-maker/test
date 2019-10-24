<?php

namespace App\Providers;

use App\ProductType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

// use App\Cart;

// use App\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     *
     * @return void
     */

    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        view()->composer('header', function ($view) {
            $loai_sp = ProductType::all();
            $view->with('loai_sp', $loai_sp);
        });

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
