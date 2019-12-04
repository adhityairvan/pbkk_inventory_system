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
    ],
    'user' => [
        'index',
        'delete',
        'create',
    ],
    'kategori' => [
        'index',
        'delete',
        'list',
        'create',
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
        'auth' => [
            'logout',
        ],
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
        'user' => [
            'index',
        ],
        'kategori' => [
            'index'
        ]
    ],
    'Pemilik' => [
        'auth' => [
            'logout',
        ],
        'item' => [
            '*',
        ],
        'transaction' => [
            '*'
        ],
        'kategori' => [
            '*'
        ],
        'user' => [
            '*'
        ]
    ]
];