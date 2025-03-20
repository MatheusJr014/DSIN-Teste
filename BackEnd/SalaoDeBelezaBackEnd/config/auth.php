<?php
return [

    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
        'users' => [ 
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\Users::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],
];
