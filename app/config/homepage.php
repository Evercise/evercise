<?php




return [
    'popular_searches' => [
        'Yoga',
        'Dance',
        'Workout',
        'Bootcamp',
        'Boxing'
    ],
    'category_blocks'  => [
        [
            'title' => 'Yoga Classes',
            'image' => '/img/home/yoga.jpg',
            'link'  => '/uk/london?search=yoga'
        ],
        [
            'title' => 'Martial Arts',
            'image' => '/img/home/martial-arts.jpg',
            'link'  => '/uk/london?search=martial+arts'
        ],
        [
            'title' => 'Pilates Classes',
            'image' => '/img/home/Pilates.jpg',
            'link'  => '/uk/london?search=pilates'
        ]
    ],
    'category_tags'    => [

        'Belly dance',
        'Vinyasa yoga',
        'Workout',
        'Karate',
        'Insanity',
        'Pregnancy Yoga',
        'Bootcamp',
        'Tai Chi',
        'Salsa',
        'Pilates',
        'Aqua cycling',
        'Hiit',
        'Boxing',
        'Suspension training',
        'Body conditioning',

/*        'kettlebell',
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
        'zumba'*/
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
            'title'      => 'Move your body from £5',
            'link'       => '/uk/london?search=dance&order=price_asc',
            'link_title' => 'View all dance classes',
            'params'     => [
                'size'     => 4,
                'radius'   => '10mi',
                'location' => 'London',
                'search'   => 'dance',
                'sort'     => 'price_asc',
            ]
        ],
        [
            'title'      => 'Get active, get fit, get inspired',
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