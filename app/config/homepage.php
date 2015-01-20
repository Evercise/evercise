<?php




return [
    'popular_searches' => [
        'Cardio',
        'Rope Climbing',
        'Hula',
        'Yoga',
        'Martial Arts',
        'Krav Maga',
        'Zumba'
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
        'martial arts',
        'yoga',
        'zumba',
        'swiming',
        'peanuts',
        'to the pub',
        'tofu',
        'martial arts',
        'yoga',
        'zumba',
        'swiming',
        'peanuts',
        'tofu',
        'martial arts',
        'zumba',
        'swiming',
        'peanuts',
        'tofu',
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
            'title'      => 'Martial Arts Sessions For less then 10£',
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