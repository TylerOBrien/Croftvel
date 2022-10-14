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
    ],

    'files' => [
        'disk' => 'public',
        'dest' => 'files',
    ],

    'images' => [
        'disk' => 'public',
        'dest' => 'images',
    ],

    'videos' => [
        'disk' => 'public',
        'dest' => 'videos',
    ],

];
