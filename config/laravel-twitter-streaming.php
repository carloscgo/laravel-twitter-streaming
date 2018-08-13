<?php

return [

    /*
     * To work with Twitter's Streaming API you'll need some credentials.
     *
     * If you don't have credentials yet, head over to https://apps.twitter.com/
     */

    'table' => env('TWITTER_CONFIG_TABLE'),

    'where_field_business' => env('TWITTER_FIELD_BUSINESS'),

];
