<?php

return [
    'name' => 'Wadi Hof Church System',
    'manifest' => [
        'name' => "Wadi Hof Church System",
        'short_name' => 'wadi-hof',
        'start_url' => '/admin',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation' => 'any',
        'status_bar' => 'black',
        'icons' => [
            '72x72' => [
                'path' => 'icons/icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => 'icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => 'icons/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => 'icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => 'icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => 'icons/icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => 'icons/icon-384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => 'icons/icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '',
            '750x1334' => '',
            '828x1792' => '',
            '1125x2436' => '',
            '1242x2208' => '',
            '1242x2688' => '',
            '1536x2048' => '',
            '1668x2224' => '',
            '1668x2388' => '',
            '2048x2732' => '',
        ],
        'shortcuts' => [
            [
                'name' => 'Families',
                'description' => 'Display All Families',
                'url' => '/admin/families',
            ],
            [
                'name' => 'People',
                'description' => 'Display All People',
                'url' => '/admin/people'
            ]
        ],
        'custom' => []
    ]
];
