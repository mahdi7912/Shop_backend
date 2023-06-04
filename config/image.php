<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    'index-image-sizes' => [
        'large' => [
            'width' => '800',
            'heigth' => '600'
        ],

        'medium' => [
            'width' => '400',
            'heigth' => '300'
        ],

        'small' => [
            'width' => '80',
            'heigth' => '60'
        ]
        ],

        'default-current-index-image' => 'medium'

];
