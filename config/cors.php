<?php

return [
    'paths' => ['api/*', 'login', 'logout', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:5173',
        'https://your-frontend.netlify.app'
    ],

    'allowed_headers' => ['*'],

    'supports_credentials' => true,
];
