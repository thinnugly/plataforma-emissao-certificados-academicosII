<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'director' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'office' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'officeTitular' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
        ],
        'professor' => [
            'profile' => 'r,u',
        ],
        'funcionario' => [
            'profile' => 'r,u',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
