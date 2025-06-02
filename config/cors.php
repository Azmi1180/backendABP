<?php

return [
    'paths' => ['api/*', '*', 'login', 'register', 'logout', 'sanctum/csrf-cookie'], // Add '*' or specific paths like 'login', 'register'
    'allowed_methods' => ['*'], // Allows all methods or specify: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS']
    'allowed_origins' => [env('FRONTEND_URL', 'http://localhost:5173')], // Your React app's URL
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Allows all headers or specify
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // IMPORTANT for sending cookies (session)
];