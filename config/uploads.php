<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Uploads
    |--------------------------------------------------------------------------
    |
    | Settings for files that have been uploaded by users.
    |
    */

    'default' => [
        'disk' => 'public',
        'dest' => 'upload',
        'filesize' => [
            'max' => '32M',
        ],
    ],

    'files' => [
        'disk' => 'public',
        'dest' => 'files',
        'filesize' => [
            'max' => '32M',
        ],
    ],

    'images' => [
        'disk' => 'public',
        'dest' => 'images',
        'filesize' => [
            'max' => '32M',
        ],
    ],

    'videos' => [
        'disk' => 'public',
        'dest' => 'videos',
        'filesize' => [
            'max' => '32M',
        ],
    ],

];
