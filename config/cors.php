<?php

return [
    'paths' => ['api/*', 'login', 'logout', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
    'http://localhost:5174',
    'https://your-frontend.netlify.app',
    'https://resturant-backend-1-t4bw.onrender.com', // Add your backend domain for forms/api
],

    'allowed_headers' => ['*'],

    'supports_credentials' => true,
];
