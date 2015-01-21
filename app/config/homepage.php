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
            'title' => 'Dance Classes',
            'image' => '/img/home/Dance.jpg',
            'link'  => '/uk/london?search=dance'
        ],
        [
            'title' => 'Martial Arts',
            'image' => '/img/home/MA.jpg',
            'link'  => '/uk/london?search=martial+arts'
        ],
        [
            'title' => 'Pilate Classes',
            'image' => '/img/home/Pilates.jpg',
            'link'  => '/uk/london?search=pilates'
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
            'title'      => 'Yoga Classes For less then £10',
            'link'       => '/uk/london?search=yoga',
            'link_title' => 'View all martial arts fitness classes',
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
            'title'      => 'Fitness classes',
            'link'       => '/uk/london?search=fitness',
            'link_title' => 'View all fitness classes',
            'background' => '/img/home/fitness.jpg',
            'params'     => [
                'size'     => 4,
                'radius'   => '10mi',
                'location' => 'London',
                'search'   => 'fitness',
                'sort'     => 'best'
            ]
        ],
    ]


];