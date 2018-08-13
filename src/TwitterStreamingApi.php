<?php

namespace Spatie\LaravelTwitterStreamingApi;

use Spatie\TwitterStreamingApi\UserStream;
use Illuminate\Contracts\Config\Repository;
use Spatie\TwitterStreamingApi\PublicStream;
use Illuminate\Support\Facades\DB;

class TwitterStreamingApi
{
    /** @var array */
    protected $config;

    public function __construct(Repository $config)
    {
        $this->config = $config['laravel-twitter-streaming-api'];
    }

    private function getConfig($business_id)
    {
        $config = DB::table($this->config['table'])
            ->where($this->config['where_field_business'], $business_id)
            ->get(['access_token', 'access_token_secret', 'consumer_key', 'consumer_secret'])
            ->first();

        return $config;
    }

    public function publicStream($business_id): PublicStream
    {
        $config = $this->getConfig($business_id);

        return new PublicStream(
            $config->access_token,
            $config->access_token_secret,
            $config->consumer_key,
            $config->consumer_secret
        );
    }

    public function userStream($business_id): UserStream
    {
        $config = $this->getConfig($business_id);

        return new UserStream(
            $config->access_token,
            $config->access_token_secret,
            $config->consumer_key,
            $config->consumer_secret
        );
    }
}
