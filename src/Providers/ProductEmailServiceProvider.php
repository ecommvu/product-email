<?php

namespace Ecommvu\ProductEmail\Providers;

use Illuminate\Support\ServiceProvider;
use Ecommvu\ProductEmail\Providers\EventServiceProvider;

/**
 * ProductEmail service provider
 *
 * @author Ecommvu <support@ecommvu.io>
 */
class ProductEmailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'productemail');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'productemail');

        $this->app->register(EventServiceProvider::class);
    }
}