<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
        'guard' => 'admin',
        'passwords' => 'admins',
        'guard' => 'superadmin',
        'passwords' => 'superadmins',
        'guard' => 'store',
        'passwords' => 'stores',
        'guard' => 'deliveryman',
        'passwords' => 'deliverymen',
        'guard' => 'customer',
        'passwords' => 'customers',
        'guard' => 'supplier',
        'passwords' => 'suppliers',
    ],

    // 'defaults' => [
    //     'guard' => 'admin',
    //     'passwords' => 'admins',
    // ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session"
    |
    */


    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
            'remember' => true, // Ensure this option is set to true

        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins', // Ensure the correct provider is used
        ],
        'superadmin' => [
            'driver' => 'session',
            'provider' => 'superadmins', // Ensure the correct provider is used
        ],
        'store' => [
            'driver' => 'session',
            'provider' => 'stores', // Ensure the correct provider is used
        ],
        'deliveryman' => [
            'driver' => 'session',
            'provider' => 'deliverymen', // Ensure the correct provider is used
        ],
        'customer' => [
            'driver' => 'session',
            'provider' => 'customers', // Ensure the correct provider is used
        ],
        'supplier' => [
            'driver' => 'session',
            'provider' => 'suppliers', // Ensure the correct provider is used
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
            'table' => 'admins',
        ],
        'superadmins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Superadmin::class,
            'table' => 'superadmins',
        ],
        'stores' => [
            'driver' => 'eloquent',
            'model' => App\Models\Store::class,
            'table' => 'stores',
        ],
        'deliverymen' => [
            'driver' => 'eloquent',
            'model' => App\Models\Deliveryman::class,
            'table' => 'deliverymen',
        ],
        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class,
            'table' => 'customers',

        ],
        'suppliers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Supplier::class,
            'table' => 'suppliers',

        ],



        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expiry time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'superadmins' => [
            'provider' => 'superadmins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'deliverymen' => [
            'provider' => 'deliverymen',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'customers' => [
            'provider' => 'customers',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'suppliers' => [
            'provider' => 'suppliers',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
