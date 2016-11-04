<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Config for sneefr website
    |--------------------------------------------------------------------------
    */
    'APP_DEBUGBAR' => env('APP_DEBUGBAR'),
    'APP_ENV'      => env('APP_ENV'),

    /*
    |--------------------------------------------------------------------------
    | Keys used across different services
    |--------------------------------------------------------------------------
    */
    'keys'         => [
        'APP_HASH_KEY'           => env('APP_HASH_KEY'),
        // Google services
        'GOOGLE_API_KEY'         => env('GOOGLE_API_KEY'),
        // Facebook services
        'FACEBOOK_CLIENT_ID'     => env('FACEBOOK_CLIENT_ID'),
        'FACEBOOK_CLIENT_SECRET' => env('FACEBOOK_CLIENT_SECRET'),
        // MapBox services
        'MAPBOX_KEY'             => env('MAPBOX_KEY'),
        // Cloudimage services
        'CLOUD_IMAGE_ROOT_URL'   => env('CLOUD_IMAGE_ROOT_URL'),
        // Intercom chat service
        'INTERCOM_APP_ID'        => env('INTERCOM_APP_ID'),
    ],
];
