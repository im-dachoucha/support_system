<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        Blade::if("user", function(){
            if(auth()->check() && !auth()->user()->is_admin){
                return true;
            }
        });

        Blade::if("admin", function(){
            if(auth()->check() && auth()->user()->is_admin){
                return true;
            }
        });
    }
}
