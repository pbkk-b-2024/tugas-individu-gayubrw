<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Here you may specify the rate limiting configuration for your API routes.
    | You can set the limit on the number of requests a user can make in a
    | specified amount of time to prevent abuse and protect your application.
    |
    */

    'rate_limits' => [
        'default' => env('API_RATE_LIMIT', 60), // 60 requests per minute
        'auth' => env('API_AUTH_RATE_LIMIT', 10), // 10 requests per minute for authenticated users
    ],

    /*
    |--------------------------------------------------------------------------
    | API Middleware
    |--------------------------------------------------------------------------
    |
    | The middleware listed below will be automatically applied to all routes
    | in your `routes/api.php` file. You may add or modify the middleware
    | as necessary for your application's requirements.
    |
    */

    'middleware' => [
        'throttle:api', // Apply rate limiting to API routes
        'bindings',     // Route model binding
    ],

    /*
    |--------------------------------------------------------------------------
    | API Prefix
    |--------------------------------------------------------------------------
    |
    | By default, Laravel uses the `/api` prefix for all API routes. You can
    | change this prefix if you want to customize the endpoint structure
    | for your API.
    |
    */

    'prefix' => env('API_PREFIX', 'api'), // Default is /api

    'api' => [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        'throttle:api',
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ],

];
