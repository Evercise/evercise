<?php

$timeArray = [];
$durationArray = [];
$ticketArray = [];
$priceArray = [];

for ($hours = 0; $hours < 24; $hours++) {
    for ($mins = 0; $mins < 60; $mins += 15) {
        $timeArray[str_pad($hours, 2, '0', STR_PAD_LEFT) . ':'
        . str_pad($mins, 2, '0', STR_PAD_LEFT)] = str_pad($hours, 2, '0', STR_PAD_LEFT) . ':'
            . str_pad($mins, 2, '0', STR_PAD_LEFT);
    }
}

for ($mins = 0; $mins < 125; $mins += 5) {
    $durationArray[str_pad($mins, 2, '0', STR_PAD_LEFT)] = str_pad($mins, 2, '0', STR_PAD_LEFT) . ' mins';
}

for ($tickets = 0; $tickets < 50; $tickets += 1) {
    $ticketArray[str_pad($tickets, 2, '0', STR_PAD_LEFT)] = str_pad($tickets, 2, '0', STR_PAD_LEFT);
}

for ($pounds = 0; $pounds < 100; $pounds++) {
    for ($pence = 0; $pence < 100; $pence += 5) {
        $priceArray[str_pad($pounds, 2, '0', STR_PAD_LEFT) . '.'
        . str_pad($pence, 2, '0', STR_PAD_LEFT)] = '£' . $pounds . '.'
            . str_pad($pence, 2, '0', STR_PAD_LEFT);
    }
}


return [
    'commission' => 10, //Default commission
    'upload_dir' => 'files/',
    'testing_ips' => ['188.39.12.12', '192.168', '127.0.0'],
    'per_page' => [12, 18, 24],
    'default_per_page' => 12,
    'max_display_map_results' => 100,
    'radius' => [
        '1/2 mile' => '0.5mi',
        '1 mile' => '1mi',
        '2 miles' => '2mi',
        '3 miles' => '3mi',
        '5 miles' => '5mi',
        '10 miles' => '10mi'
    ],
    'time' => $timeArray,
    'duration' => $durationArray,
    'tickets' => $ticketArray,
    'price' => $priceArray,
    'default_radius' => '0.5mi',
    'article_main_image' => [
        'width' => 600,
        'height' => 284
    ],

    'user' => [
        'activities' => 100, // Limit
    ],
    'article_category_main_image' => [
        'width' => 600,
        'height' => 284
    ],
    'venue_images' => [
        'regular' => [
            'width' => 1000,
            'height' => 750
        ],
        'thumb' => [
            'width' => 200,
            'height' => 150
        ]
    ],
    'cover_image' => [
        'regular' => [
            'width' => 1000,
            'height' => 400
        ],
        'thumb' => [
            'width' => 200,
            'height' => 80
        ]
    ],
    'class_images' => [
        ['prefix' => 'cover', 'width' => 1920, 'height' => 820],
        [
            'prefix' => 'preview',
            'width' => 409,
            'height' =>308
        ],

        [
            'prefix' => 'module',
            'width' => 250,
            'height' =>311
        ],
        [
            'prefix' => 'thumb',
            'width' => 150,
            'height' => 166
        ],
        [
            'prefix' => 'search',
            'width' => 125,
            'height' =>120
        ]
    ],
    'user_images' => [
        ['prefix' => 'large', 'width' => 300, 'height' => 300],
        ['prefix' => 'medium', 'width' => 200, 'height' => 200],
        ['prefix' => 'small', 'width' => 100, 'height' => 100]
    ],
    'slider_images' => [
        ['prefix' => 'cover', 'width' => 2000, 'height' => 1000],
        ['prefix' => 'medium', 'width' => 1000, 'height' => 500],
        ['prefix' => 'thumb', 'width' => 200, 'height' => 200]
    ],

    /** SEO CRAP */

    'seo_keywords' => [
        'Excercise',
        'Remind',
        'Iggy',
        'TO',
        'ADD',
        'KEYWORDS',
        '!!!!!'
    ],
    'blog' => [
        'title' => 'Evercise Blog',
        'keywords' => 'fitness blog, evercise',
        'description' => 'Pretty cool description'
    ],
    'gallery' => [
        'image_counter' => 3,
        'sizes' => [
            ['prefix' => 'main', 'width' => 1024, 'height' => 300],
            ['prefix' => 'thumb', 'width' => 205, 'height' => 87]
        ]

    ]
];