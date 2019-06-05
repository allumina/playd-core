<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Package Configuration Option
    |--------------------------------------------------------------------------
    | Describe what it does. 
    */

    'connection' => env('PLAYD_DB_CONNECTION', 'mysql'),
    'theme' => env('PLAYD_THEME', 'tartan'),
    'token_expire_in' => env('PLAYD_TOKEN_EXPIRE_IN', 3600),
    'token_refresh_in' => env('PLAYD_TOKEN_REFRESH_IN', 3600),
    'hash_rounds' => env('PLAYD_HASH_ROUNDS', 14),
];
