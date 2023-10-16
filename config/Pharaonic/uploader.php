<?php

return [
    /**
     * Storage Disk (local, public, s3, ...)
     */
    'disk'  => 'public',

    /**
     * Uploading Path
     */
    'path'  => '/',

    /**
     * Route URL /..../hash
     */
    'route' => 'uploads',

    /**
     * User Model
     */
    'user'  => \App\Models\User::class,

    /**
     * Contoller Class for handling permissions
     * Allow custom controllers.
     */
    'controller'  => \Pharaonic\Laravel\Uploader\Controller\UploadController::class,

    /**
     * Expiry time of temporary-url in minutes
     */
    'expire' => 15,

    /**
     * Default Options
     */
    'options'   => [

        // Prefix Hash
        'prefix' => date('Ymd_'),

        // Visits Counting
        'visitable' => false,

        // Permitting only specific users
        'private' => false,
    ]
];
