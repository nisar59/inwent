<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

       // 'ftp' => [
       //      'driver' => 'ftp',
       //      'host' => env('FTP_HOST', '127.0.0.1'),
       //      'username' => env('FTP_USERNAME', 'maharnisar'),
       //      'password' => env('FTP_PASSWORD', '123456789'),
       //      'root' => env('FTP_ROOT',), // for example: /public_html/images
       //      'ftp_url'=>env('FTP_URL', 'http://localhost/filezila/'),
       //      // Optional FTP Settings...
       //      // 'port' => env('FTP_PORT', 21),
       //      // 'passive' => true,
       //      // 'ssl' => true,
       //      // 'timeout' => 30,
       //  ],

        'ftp' => [
            'driver' => 'ftp',
            'host' => env('FTP_HOST', 'ftp.inwent.ca'),
            'username' => env('FTP_USERNAME', 'media@media.inwent.ca'),
            'password' => env('FTP_PASSWORD', 'eQqSbwNyjYLcc7wgrHcB'),
            'root' => env('FTP_ROOT'), // for example: /public_html/images
            'ftp_url'=>env('FTP_URL', 'https://media.inwent.ca/'),
            // Optional FTP Settings...
            // 'port' => env('FTP_PORT', 21),
            // 'passive' => true,
            // 'ssl' => true,
            // 'timeout' => 30,
        ],        

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
