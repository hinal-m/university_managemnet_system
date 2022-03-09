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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '110871430899-b31i021dlcl7ilsrt9qtk9hgglut4s8j.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/college/google/callback',
    ],
    'google' => [
        'client_id' => '110871430899-b31i021dlcl7ilsrt9qtk9hgglut4s8j.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/university/google/callback',
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => 'http://localhost:8000/university/facebook/callback',
    ],
    'twitter' => [
        'client_id' => 'UV9BblJUMGtvOVBOb25za1B2R3I6MTpjaQ',
        'client_secret' => 'mc2B4N6WJQ7SP48R93Ci8DVmzF-B4gqkUqClkzArJSWCm_vNRa',
        'redirect' => 'http://127.0.0.1:8000/university/callback/twitter',
    ],
    'github' => [
        'client_id' => 'Iv1.5c5710e4327831ca',
        'client_secret' => '9291a68425748d2f8c95b8c6ce199f1e1c401e7e',
        'redirect' => 'http://127.0.0.1:8000/university/callback/github',
      ], 

];
