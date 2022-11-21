<?php

return [

    /*
    |--------------------------------------------------------------------------
    | The max tweets per page (Pagination)
    |--------------------------------------------------------------------------
    |
    | This option controls the max number of records
    | that can return to the client once he uses our API.
    |
    | Supported: "int"
    |
    */

    'per_page' => 10,

    /*
    |--------------------------------------------------------------------------
    | rate limiter
    |--------------------------------------------------------------------------
    |
    | Here you may specify a rate limiter that will be applied to all routes
    | we have inside application it will be applied only on API.
    |
    */

    'rate_limiter' => 60,
];
