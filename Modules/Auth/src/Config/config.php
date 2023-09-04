<?php
return [
    'country_code' => '+98',
    'allow_country_codes' => [
        '+971',
    ],
    'otp_send_request_limit_time' => 5,  //5, // minutes
    'otp_send_request_limit_count' => 3,
    'otp_expired_time' => 120, // seconds

    'fake_login_secret_code' => 'JB-SECRET-CODE',
    'decorators' => [
        'tryCatch' => true,
        'dbTransaction' => true,
        'cache' => false,
    ],
];
