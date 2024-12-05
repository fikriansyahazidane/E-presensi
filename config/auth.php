<?php

// config/auth.php

return [
    'defaults' => [
        'guard' => 'web',  // Default guard is 'web' for regular users
        'passwords' => 'users',  // Default password reset provider is 'users'
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'karyawan' => [
            'driver' => 'session',
            'provider' => 'karyawans',  // Karyawan provider, specific to 'karyawan' guard
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,  // Regular user model
        ],
        'karyawans' => [
            'driver' => 'eloquent',
            'model' => App\Models\Karyawan::class,  // Karyawan model for the 'karyawan' guard
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'karyawans' => [
            'provider' => 'karyawans',  // Reset password config for karyawan
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],
];
