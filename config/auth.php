<?php

return [
    'defaults' => [
        'guard' => 'user',
        'passwords' => 'users',
    ],

    'guards' => [
        'user' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
        'retailer' => [
            'driver' => 'passport',
            'provider' => 'retailers',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class
        ],
        'retailers' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Retailer::class
        ]
    ]
];
