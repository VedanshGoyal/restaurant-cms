<?php

return [

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN', 'mailgun_domain'),
        'secret' => env('MAILGUN_SECRET', 'mailgun_api_key'),
    ],

];
