<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DingoSerializerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['Dingo\Api\Transformer\Factory']->setAdapter(function ($app) {
            $fractal = new League\Fractal\Manager;
            $fractal->setSerializer(new App\Http\Serializers\NoDataArraySerializer());
            return new Dingo\Api\Transformer\Adapter\Fractal($fractal);
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
