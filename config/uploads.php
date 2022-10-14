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
        'max-filesize' => '32M',
    ],

    'files' => [
        'disk' => 'public',
        'dest' => 'files',
        'max-filesize' => '32M',
    ],

    'images' => [
        'disk' => 'public',
        'dest' => 'images',
        'max-filesize' => '32M',
    ],

    'videos' => [
        'disk' => 'public',
        'dest' => 'videos',
        'max-filesize' => '32M',
    ],

];
