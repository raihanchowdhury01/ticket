<?php

return [
    /*
    |--------------------------------------------------------------------------
    | bKash API Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for bKash payment gateway integration.
    | Set the appropriate values for your application.
    |
    */

    'app_key' => env('BKASH_APP_KEY', 'your_app_key'),       // Your bKash application key
    'app_secret' => env('BKASH_APP_SECRET', 'your_app_secret'), // Your bKash application secret
    'username' => env('BKASH_USERNAME', 'your_username'),     // Your bKash username (for sandbox)
    'password' => env('BKASH_PASSWORD', 'your_password'),     // Your bKash password (for sandbox)
    
    // Set the base URL for bKash API (sandbox or live)
    'base_url' => env('BKASH_BASE_URL', 'https://sandbox.bkash.com'), // Use sandbox for testing or live for production
];
