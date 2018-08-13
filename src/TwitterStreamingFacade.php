<?php

namespace CarlosCGO\LaravelTwitterStreaming;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CarlosCGO\LaravelTwitterStreaming\LaravelTwitterStreamingClass
 */
class TwitterStreamingApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-twitter-streaming';
    }
}
