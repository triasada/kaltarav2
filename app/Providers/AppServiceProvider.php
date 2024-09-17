<?php

namespace App\Providers;

use App\District;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('vendor.pagination.bootstrap-4');
	    Schema::defaultStringLength(191);
        View::composer('auth.register', function ($view)
        {
            $districts = District::get()->pluck('name','id');
            return $view->with('districts',$districts);
        });
    }
}
