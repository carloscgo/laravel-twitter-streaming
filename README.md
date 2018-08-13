# Easily work with the Twitter Streaming API in a Laravel app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-twitter-streaming-api.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-twitter-streaming-api)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/laravel-twitter-streaming-api/master.svg?style=flat-square)](https://travis-ci.org/carloscgo/laravel-twitter-streaming-api)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-twitter-streaming-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-twitter-streaming-api)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-twitter-streaming-api.svg?style=flat-square)](https://packagist.org/packages/carloscgo/laravel-twitter-streaming-api)

Twitter provides a streaming API with which you can do interesting things such as listening for tweets that contain specific strings or actions a user might take (e.g. liking a tweet, following someone,...). This package makes it very easy to work with the API.

```php
TwitterStreamingApi::publicStream($business_id)
->whenHears('#laravel', function(array $tweet) {
    echo "{$tweet['user']['screen_name']} tweeted {$tweet['text']}";
})
->startListening();
```

Here's [an example Laravel application](https://github.com/spatie/laravel-twitter-streaming-api-example-app) with the package pre-installed. It contains [an artisan command](https://github.com/spatie/laravel-twitter-streaming-api-example-app/blob/master/app/Console/Commands/ListenForHashTags.php) to kick off the listening process.

## Installation

You can install the package via composer:

``` bash
composer require carloscgo/laravel-twitter-streaming-api
```

You must install this service provider.

```php
// config/app.php
'providers' => [
    ...
    CarlosCGO\LaravelTwitterStreamingApi\TwitterStreamingApiServiceProvider::class,
];
```

This package also comes with a facade, which provides an easy way to call the class.

```php
// config/app.php
'aliases' => [
    ...
    'TwitterStreamingApi' => CarlosCGO\LaravelTwitterStreamingApi\TwitterStreamingApiFacade::class,
];
```

The config file must be published with this command:

```bash
php artisan vendor:publish --provider="CarlosCGO\LaravelTwitterStreamingApi\TwitterStreamingApiServiceProvider" --tag="config"
```

It will be published in `config/laravel-twitter-streaming-api.php`

```php
return [

    /**
     * To work with Twitter's Streaming API you'll need some credentials.
     *
     * If you don't have credentials yet, head over to https://apps.twitter.com/
     */

    'table' => env('TWITTER_CONFIG_TABLE'),

    'where_field_business' => env('TWITTER_FIELD_BUSINESS'),

];
```

## Getting credentials

In order to use this package you'll need to get some credentials from Twitter. Head over to the [Application management on Twitter](https://apps.twitter.com/) to create an application.

Once you've created your application, click on the `Keys and access tokens` tab to retrieve your `consumer_key`, `consumer_secret`, `access_token` and `access_token_secret`.

![Keys and access tokens tab on Twitter](https://carloscgo.github.io/twitter-streaming-api/images/twitter.jpg)

## Usage

Currently, this package works with the public stream and the user stream. Both the `PublicStream` and `UserStream` classes provide a `startListening` function that kicks of the listening process. Unless you cancel it your PHP process will execute that function forever. No code after the function will be run.

In the example below a facade is used. If you don't like facades you can replace them with

```php
app(CarlosCGO\LaravelTwitterStreamingApi\TwitterStreamingApi::class)
```

### The public stream

The public stream can be used to listen for specific words that are being tweeted.

The first parameter of `whenHears` must be a string or an array containing the word or words you want to listen for. The second parameter should be a callable that will be executed when one of your words is used on Twitter.

```php
use TwitterStreamingApi;

TwitterStreamingApi::publicStream($business_id)
->whenHears('#laravel', function(array $tweet) {
    echo "{$tweet['user']['screen_name']} tweeted {$tweet['text']}";
})
->startListening();
```

### The user stream

```php
use TwitterStreamingApi;

TwitterStreamingApi::userStream($business_id)
->onEvent(function(array $event) {
    if ($event['event'] === 'favorite') {
        echo "Our tweet {$event['target_object']['text']} got favorited by {$event['source']['screen_name']}";
    }
})
->startListening();
```

## Suggestion on how to run in a production environment

When using this in production you could opt to create [an artisan command](https://github.com/spatie/laravel-twitter-streaming-api-example-app/blob/8175995/app/Console/Commands/ListenForHashTags.php) to listen for incoming events from Twitter. You can use [Supervisord](http://supervisord.org/) to make sure that command is running all the time.

## A word to the wise

These APIs work in realtime, so they could report a lot of activity. If you need to do some heavy work processing that activity it's best to put that work in a queue to keep your listening process fast.




## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
