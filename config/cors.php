<?php

return [
    'paths' => ['api/*', 'login', 'logout', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
    'http://localhost:5174',
    'https://blueskyrestaurant.netlify.app',
     // Add your backend domain for forms/api
],

    'allowed_headers' => ['*'],

    'supports_credentials' => true,
];
