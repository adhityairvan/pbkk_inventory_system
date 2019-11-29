<?php

$roles = [
    'Guests' => [
        'auth' => [
            'showLogin',
            'login',
            'showRegister',
            'register',
        ],
    ],
    'LoggedIn' => [
        'item' => [
            'index',
            'create',
            'new',
            'updateStock'
        ],
        'transaction' => [
            'index',
        ],
    ]
];