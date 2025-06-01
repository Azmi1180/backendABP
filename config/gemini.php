<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Gemini API Key
    |--------------------------------------------------------------------------
    |
    | Your Gemini API Key. You can obtain this from Google AI Studio.
    | This will be used by the Gemini client for authentication.
    |
    */
    'api_key' => env('GEMINI_API_KEY', null), // Default to null if not in .env

    /*
    |--------------------------------------------------------------------------
    | Other Gemini Configurations (if any)
    |--------------------------------------------------------------------------
    |
    | You can add other package-specific configurations here if needed.
    | Refer to the package documentation for available options.
    | For example, default model, request options, etc.
    |
    */
    // 'default_model' => 'gemini-pro',
    // 'http_client_options' => [
    //     'timeout' => 30,
    // ],
];