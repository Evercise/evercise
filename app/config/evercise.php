<?php

$timeArray = [];
$durationArray = [];
$priceArray = [];

foreach (range(strtotime("00:00"), strtotime("24:00"), 15 * 60) as $time) {
    $timeArray[date("H:i", $time)] = date("H:i", $time);
}

foreach (range(0, 125, 5) as $mins) {
    $durationArray[str_pad($mins, 2, '0', STR_PAD_LEFT)] = str_pad($mins, 2, '0', STR_PAD_LEFT) . ' mins';
}
foreach (range(1, 300) as $pounds) {
    $priceArray[number_format($pounds / 2, 2)] = '£' . number_format($pounds / 2, 2);
}


return [

    'stripe_testing'           => false,
    'stripe_api_key'        => getenv('STRIPE_API_KEY') ?: false,
    'stripe_pub_key'        => getenv('STRIPE_PUB_KEY') ?: false,
    'stripe_api_key_test'        => getenv('STRIPE_API_KEY_TEST') ?: false,
    'stripe_pub_key_test'        => getenv('STRIPE_PUB_KEY_TEST') ?: false,
    'transaction_types'           => [
        'wallettoppup',
        'cartcompleted',
        'topupcompleted',
        'milestonecompleted'
    ],
    'minimim_withdraw'            => 5,
    'payments_to_trainers'        => 'Monday 4pm',
    'pending_emails'              => ['mlatko@gmail.com'],
    'commission'                  => 10, //Default commission
    'upload_dir'                  => 'files/',
    'testing_ips'                 => ['188.39.12.12', '192.168', '127.0.0'],
    'per_page'                    => [12, 18, 24],
    'default_per_page'            => 12,
    'max_display_map_results'     => 100,
    'radius'                      => [
        '1/2 mile' => '0.5mi',
        '1 mile'   => '1mi',
        '2 miles'  => '2mi',
        '3 miles'  => '3mi',
        '5 miles'  => '5mi',
        '10 miles' => '10mi',
        '25 miles' => '25mi'
    ],
    'time'                        => $timeArray,
    'duration'                    => $durationArray,
    'tickets'                     => array_combine(range(1, 120), range(1, 120)),
    'price'                       => $priceArray,
    'default_radius'              => '10mi',
    'article_main_image'          => [
        'regular' => [
            'width'  => 600,
            'height' => 284
        ],
        'thumb'   => [
            'width'  => 200,
            'height' => 200
        ]
    ],
    'user'                        => [
        'activities' => 100, // Limit
    ],
    'article_category_main_image' => [
        'width'  => 600,
        'height' => 284
    ],
    'venue_images'                => [
        'regular' => [
            'width'  => 1000,
            'height' => 750
        ],
        'thumb'   => [
            'width'  => 200,
            'height' => 150
        ]
    ],
    'cover_image'                 => [
        'regular' => [
            'width'  => 1000,
            'height' => 400
        ],
        'thumb'   => [
            'width'  => 200,
            'height' => 80
        ]
    ],
    'class_images'                => [
        ['prefix' => 'cover', 'width' => 1920, 'height' => 820],
        [
            'prefix' => 'preview',
            'width'  => 409,
            'height' => 308
        ],
        [
            'prefix' => 'module',
            'width'  => 315,
            'height' => 250
        ],
        [
            'prefix' => 'thumb',
            'width'  => 150,
            'height' => 166
        ],
        [
            'prefix' => 'search',
            'width'  => 125,
            'height' => 120
        ]
    ],
    'user_images'                 => [
        ['prefix' => 'large', 'width' => 300, 'height' => 300],
        ['prefix' => 'medium', 'width' => 200, 'height' => 200],
        ['prefix' => 'small', 'width' => 100, 'height' => 100]
    ],
    'slider_images'               => [
        ['prefix' => 'cover', 'width' => 2000, 'height' => 1000],
        ['prefix' => 'medium', 'width' => 1000, 'height' => 500],
        ['prefix' => 'thumb', 'width' => 200, 'height' => 200]
    ],
    /** SEO CRAP */

    'seo_keywords'                => [
        'Excercise',
        'Remind',
        'Iggy',
        'TO',
        'ADD',
        'KEYWORDS',
        '!!!!!'
    ],
    'blog'                        => [
        'title'       => 'Evercise Blog',
        'keywords'    => 'fitness blog, evercise',
        'description' => 'Pretty cool description'
    ],
    'gallery'                     => [
        'image_counter' => 3,
        'sizes'         => [
            ['prefix' => 'main', 'width' => 1920, 'height' => 820],
            ['prefix' => 'thumb', 'width' => 205, 'height' => 87]
        ]

    ],
    'article_no_img'              => '/files/article/no-img.jpg'
];