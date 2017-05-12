<?php

return [
    'auth' => [
        /*
        |----------------------------------------------------------------------
        | Inetworx Authentication Credentials
        |----------------------------------------------------------------------
        */
        'credentials' => [
            'auth_header' => [
                'username' => env('INETWORX_AUTH_HEADER_USERNAME'),
                'password' => env('INETWORX_AUTH_HEADER_PASSWORD'),
            ],

            'api' => [
                'username' => env('INETWORX_API_USERNAME'),
                'password' => env('INETWORX_API_PASSWORD'),
            ],
        ],
    ],
];
