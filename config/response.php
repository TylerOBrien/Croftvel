<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Keys
    |--------------------------------------------------------------------------
    |
    | Values that will be used as key values in the array that will be created
    | for the response.
    |
    */

    'key' => [
        'message' => 'message',
    ],

    /*
    |--------------------------------------------------------------------------
    | Response Relationships
    |--------------------------------------------------------------------------
    |
    | These values are passed to Laravel's $model->load() or $model->with()
    | functions. They are defined here as a convenience and to minimize
    | repeating code.
    |
    */

    'relationships' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Response Attributes
    |--------------------------------------------------------------------------
    |
    | These values are passed to Laravel's $model->append() function. They are
    | defined here as a convenience and to minimize repeating code.
    |
    */

    'attributes' => [
        'file' => [
            'index' => [ 'url' ],
            'show' => [ 'url' ],
            'store' => [ 'url' ],
        ],

        'image' => [
            'index' => [ 'url' ],
            'show' => [ 'url' ],
            'store' => [ 'url' ],
        ],
    ],
];
