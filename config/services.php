<?php

return [

    /*
      |--------------------------------------------------------------------------
      | Third Party Services
      |--------------------------------------------------------------------------
      |
      | This file is for storing the credentials for third party services such
      | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
      | default location for this type of information, allowing packages
      | to have a conventional place to find your various credentials.
      |
     */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],
    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],
    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],
    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'twitter' => [
        'client_id' => "Vly3zmjSOHgY3waOxqIuGS0Hm",
        'client_secret' => "Z2OCGsqNhRAUX5vsKZ6ThmrGCCM8ZEvXutUmYQ6NMlnBlc80Zu",
        'redirect' => 'http://td.dev/login/twitter',
    ],
    'facebook' => [
        'client_id' => "1622757971321887",
        'client_secret' => "c0f3fc0bf4cd29ad01410a5e710cb7ae",
        'redirect' => 'http://td.dev/login/facebook',
    ],
     'google' => [
        'client_id' => "1001944169101-ouorckdenbbh0ejq6hidg068j14gai7l.apps.googleusercontent.com",
        'client_secret' => "flIzfKEZUL6D1oXV_MGf-QYs",
        'redirect' => 'http://td.dev/login/google',
    ],
    'linkedin' => [
        'client_id' => "75ctx57wj8h07c",
        'client_secret' => "swMv4L0jRBtOHRDD",
        'redirect' => 'http://td.dev/login/linkedin',
    ]
    
    
];
