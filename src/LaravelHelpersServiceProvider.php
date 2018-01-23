<?php

namespace Fei77\LaravelHelpers;

use Illuminate\Support\ServiceProvider;

class LaravelHelpersServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
      // if ($this->app->runningInConsole()) {
      //     $this->publishes([
      //         __DIR__ . '/config/cpanel.php' => config_path('cpanel.php'),
      //     ], 'config');
      // }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias(LaravelHelpers::class, 'LaravelHelpers');
    }
}
