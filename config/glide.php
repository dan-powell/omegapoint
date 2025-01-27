<?php

return [
    // Enable public route for processed images
    'enabled' => true,

    'standalone' => true,

    // Security key
    'key' => env('GLIDE_KEY', 'fhdjshfoiur32hjiods34432'),

    // Validate image requests using keys. Should always be enabled in a production environment to prevent uncontrolled image manipulation
    'validate' => true,

    'url' => 'https://media.' . env('APP_URL'),

    // Route prefix
    'route' => 'image.php',

    // Default image storage disk
    'disk' => 'news',

    // Cache disk for storing processed images
    // Ideally should be set to a private seperate disk
    'cache' => 'cache',

    // Default image quality
    'quality' => '90',

    // Set the maximum image size in pixels. Set to null the disable (should alwayts be enabled to prevent memory issues)
    'max_image_size' => 2560 * 2560,

    // Supported image types
    'mime_types' => [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/webp',
        'image/gif',
    ],

    // Image processing presets
    // See https://glide.thephpleague.com/2.0/config/defaults-and-presets/ for more info on using presets
    'presets' => [
        'sm' => [
            'w' => 200,
            'h' => null,
        ],
        'md' => [
            'w' => 600,
            'h' => null,
        ],
        'md_3x2' => [
            'w' => 600,
            'h' => 400,
            'fit' => 'crop',
        ],
    ],

    // Array of widths used by default when creating srcset URLs
    'srcset' => [
        320, 640, 970, 1024, 1280, 1680, 1920, 2560,
    ],
];
