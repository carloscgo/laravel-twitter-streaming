<?php

namespace CarlosCGO\LaravelTwitterStreaming;

use Illuminate\Support\ServiceProvider;

class TwitterStreamingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-twitter-streaming.php' => config_path('laravel-twitter-streaming.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-twitter-streaming.php', 'laravel-twitter-streaming');

        $this->app->bind('laravel-twitter-streaming', TwitterStreaming::class);
    }
}
