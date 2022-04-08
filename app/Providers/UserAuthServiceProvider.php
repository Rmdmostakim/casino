<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\UserAuthentication;
use App\Helpers\AdminAuthentication;
use App\Helpers\GamePlay;
class UserAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('usersAuth', function ($app) {
            return new UserAuthentication;
        });

        $this->app->singleton('gameControlls', function ($app) {
            return new GamePlay;
        });

        $this->app->singleton('adminAuth', function ($app) {
            return new AdminAuthentication;
        });
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
