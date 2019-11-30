<?php
$role = [
    'Guests',
    'Karyawan',
    'Pemilik',
];
$resources = [
    'auth' => [
        'showLogin',
        'login',
        'showRegister',
        'register',
        'logout',
    ],
    'item' => [
        'index',
        'create',
        'new',
        'updateStock',
        'edit',
        'update',
        'delete',
        'listItem',
    ],
    'transaction' => [
        'index',
        'create',
        'store',
        'delete',
    ],
    'home' => [
        'index',
    ]
];


$allowed = [
    'Guests' => [
        'auth' => [
            'showLogin',
            'login',
            'showRegister',
            'register',
        ],
    ],
    'Karyawan' => [
        'item' => [
            'index',
            'create',
            'new',
            'updateStock',
            'listItem',
        ],
        'transaction' => [
            'index',
            'create',
            'store',
        ],
    ],
    'Pemilik' => [
        'item' => [
            '*',
        ],
        'transaction' => [
            '*'
        ]
    ]
];