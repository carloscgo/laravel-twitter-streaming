<?php

namespace CarlosCGO\LaravelTwitterStreaming\Test;

use Orchestra\Testbench\TestCase as Orchestra;
use CarlosCGO\LaravelTwitterStreaming\TwitterStreamingFacade;
use CarlosCGO\LaravelTwitterStreaming\TwitterStreamingServiceProvider;

abstract class TestCase extends Orchestra
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            TwitterStreamingServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('laravel-twitter-streaming-', [
            'table' => 'my_table',
            'where_field_business' => 'business_id',
        ]);
    }

    protected function getPackageAliases($app)
    {
        return [
            'TwitterStreaming' => TwitterStreamingFacade::class,
        ];
    }
}
