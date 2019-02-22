<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('Dingo\Api\Transformer\Factory')->setAdapter(function () {
            $fractalManager = new \League\Fractal\Manager;
            $fractalManager->setSerializer(new \App\Traits\NoDataArraySerializer);
            return new \Dingo\Api\Transformer\Adapter\Fractal($fractalManager);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->environment() == 'local'){
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    }
}
