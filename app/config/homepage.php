<?php




return [
    'popular_searches' => [
        'Yoga',
        'Zumba',
        'Insanity',
        'Fight klub',
        'Bootcamp',
        'Boxing',
        'Pilates'
    ],
    'category_blocks'  => [
        [
            'title' => 'Martial Arts',
            'image' => '/url/to/somewere.png',
            'link'  => '/uk/london?search=martial+arts'
        ],
        [
            'title' => 'Yoga Classes',
            'image' => '/url/to/somewere.png',
            'link'  => '/uk/london?search=yoga'
        ],
        [
            'title' => 'Dance Classes',
            'image' => '/url/to/somewere.png',
            'link'  => '/uk/london?search=dance'
        ]
    ],
    'category_tags'    => [
        'kettlebell',
        'hiit',
        'mma',
        'workout',
        'suspension training',
        'belly dancing',
        'pilates',
        'pregnancy yoga',
        'yoga',
        'insanity', 
        'running',
        'total body bootcamp',
        'salsa',
        'strength and conditioning',
        'self defence',
        'circuit',
        'latin dance',
        'balance',
        'aerobics',
        'hatha yoga',
        'crossfit',
        'zumba'
    ],
    'blocks'           => [
        [
            'title'      => 'New This Week',
            'link'       => '/uk/london?sort=newest',
            'link_title' => 'View all new this week',
            'params'     => [
                'size'     => 4,
                'radius'   => '10mi',
                'location' => 'London',
                'sort'     => 'newest'
            ]
        ],
        [
            'title'      => 'Martial Arts Sessions For less then £10',
            'link'       => '/uk/london?sort=newest',
            'link_title' => 'View all new this week',
            'params'     => [
                'size'     => 4,
                'radius'   => '10mi',
                'location' => 'London',
                'search'   => 'martial arts',
                'sort'     => 'best',
                'price'    => [
                    'under' => 10
                ]
            ]
        ],
        [
            'title'      => 'Ten-Hut! Great Deals on Bootcamp Sessions',
            'link'       => '/uk/london?search=bootcamp',
            'link_title' => 'View all',
            'background' => '/img/background/somehting.png',
            'params'     => [
                'size'     => 4,
                'radius'   => '10mi',
                'location' => 'London',
                'search'   => 'bootcamp',
                'sort'     => 'best'
            ]
        ],
    ]


];