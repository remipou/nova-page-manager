<?php

namespace Remipou\NovaPageManager;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Laravel\Nova\Trix\PruneStaleAttachments;

class NovaPageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/pagemanager.php' => config_path('pagemanager.php'),
        ]);

        $this->mergeConfigFrom(__DIR__.'/config/pagemanager.php', 'pagemanager');

        $this->loadMigrationsFrom(__DIR__.'/migrations');

        $this->loadViewsFrom(__DIR__.'/views', 'pagemanager');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/templates'),
        ]);

        Nova::serving(function (ServingNova $event) {
            //Nova::script('nova-page-manager', __DIR__ . '/../dist/js/nova-page-manager.js');
            Nova::style('nova-page-manager', __DIR__.'/../dist/css/nova-page-manager.css');
        });

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->call(function () {
                (new PruneStaleAttachments)();
            })->daily();
        });
    }

    public function register()
    {
    }
}
