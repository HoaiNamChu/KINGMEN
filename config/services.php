<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

<<<<<<< HEAD
    'google' => [

        'client_id' => '287307522473-qqmbkl8mcus4dmo4m48md4e14jum6rot.apps.googleusercontent.com',

        'client_secret' => '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',

        'redirect' => env('APP_URL').'auth/google/callback',

    ],

];  
=======
];
>>>>>>> d17a51d63ad1223aa572ebff2767f844dd72150f
