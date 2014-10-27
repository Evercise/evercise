<?php



return [
    'per_page'                => [12, 18, 24],
    'default_per_page'        => 12,
    'max_display_map_results' => 100,
    'radius'                  => [
        '1/2 mile' => '0.5mi',
        '1 mile'   => '1mi',
        '2 miles'  => '2mi',
        '3 miles'  => '3mi',
        '5 miles'  => '5mi',
        '10 miles' => '10mi'
    ],
    'default_radius'          => '0.5mi',
    'article_main_image'      => [
        'width'  => 300,
        'height' => 200
    ],
    'article_category_main_image'=> [
        'width'  => 300,
        'height' => 200
    ],
    /** SEO CRAPP */

    'seo_keywords' => [
        'Excercise', 'Remind', 'Iggy', 'TO', 'ADD', 'KEYWORDS', '!!!!!'
    ],

    'blog'  => [
        'title' => 'Evercise Blog',
        'keywords' => 'fitness blog, evercise',
        'description' => 'Pretty cool description'
    ],

    'gallery' => [
        'image_counter' => 3,
        'sizes' => [
            ['prefix' => 'main', 'width' => 1024, 'height' => 300],
            ['prefix' => 'thumb', 'width' => 200, 'height' => 200]
        ]

    ]
];