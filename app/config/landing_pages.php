<?php

$base = 'assets/img/landings/';
return [

    '/uk/london/bootcamp'     => [
        'title'       => 'First Bootcamp Class',
        'description' => 'Get your first Bootcamp class on US',
        'price'       => '£10',
        'category'    => 'Bootcamp',
        'category_id' => 7,
        'total'       => '100',
        'main_image'  => $base . 'bootcamp_assets/bootcamp_landing_img.jpg',
        'popup_image'  => $base . 'default_assets/bootcamp_modal_img.jpg',
        'blocks'      => [
            'large' => [
                [
                    'image' => $base . 'bootcamp_assets/bootcamp_class_img.jpg',
                    'name'  => 'BOOTCAMP',
                    'from'  => '£6',
                    'link'  => 'uk/london?search=bootcamp',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'bootcamp_assets/fitness_class_img.jpg',
                    'name'  => 'FITNESS',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=fitness',
                    'total' => '50',
                ]
            ],
            'small' => [
                [
                    'image' => $base . 'bootcamp_assets/martial_arts_class_img.jpg',
                    'name'  => 'MARTIAL ARTS',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=martial+arts',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'bootcamp_assets/yoga_class_img.jpg',
                    'name'  => 'YOGA',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=yoga',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'bootcamp_assets/pilates_class_img.jpg',
                    'name'  => 'PILATES',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=pilates',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'bootcamp_assets/dance_class_img.jpg',
                    'name'  => 'DANCE',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=dance',
                    'total' => '50',
                ],
            ]
        ]
    ],
    '/uk/london/dance'        => [
        'title'       => 'First Dance Class',
        'description' => 'Get your first Dance class on US',
        'price'       => '£10',
        'category'    => 'Dance',
        'category_id' => 1,
        'total'       => '100',
        'main_image'  => $base . 'dance_assets/dance_landing_img.jpg',
        'popup_image'  => $base . 'default_assets/dance_modal_img.jpg',
        'blocks'      => [
            'large' => [
                [
                    'image' => $base . 'dance_assets/dance_class_img.jpg',
                    'name'  => 'Dance',
                    'from'  => '£6',
                    'link'  => 'uk/london?search=dance',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'dance_assets/fitness_class_img.jpg',
                    'name'  => 'FITNESS',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=fitness',
                    'total' => '50',
                ]
            ],
            'small' => [
                [
                    'image' => $base . 'dance_assets/yoga_class_img.jpg',
                    'name'  => 'YOGA',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=yoga',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'dance_assets/pilates_class_img.jpg',
                    'name'  => 'PILATES',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=pilates',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'dance_assets/bootcamp_class_img.jpg',
                    'name'  => 'BOOTCAMP',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=bootcamp',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'dance_assets/martial_arts_class_img.jpg',
                    'name'  => 'MARTIAL ARTS',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=martial+arts',
                    'total' => '50',
                ],
            ]
        ]
    ],
    '/uk/london/fitnessclasses'      => [
        'title'       => 'First Fitness Class',
        'description' => 'Get your first Fitness class on US',
        'price'       => '£10',
        'category'    => 'Fitness',
        'category_id' => 3,
        'total'       => '100',
        'main_image'  => $base . 'fitness_assets/fitness_landing_img.jpg',
        'popup_image'  => $base . 'default_assets/fitness_modal_img.jpg',
        'blocks'      => [
            'large' => [
                [
                    'image' => $base . 'fitness_assets/yoga_class_img.jpg',
                    'name'  => 'YOGA',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=yoga',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'fitness_assets/fitness_class_img.jpg',
                    'name'  => 'FITNESS',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=fitness',
                    'total' => '50',
                ]
            ],
            'small' => [
                [
                    'image' => $base . 'fitness_assets/pilates_class_img.jpg',
                    'name'  => 'PILATES',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=pilates',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'fitness_assets/dance_class_img.jpg',
                    'name'  => 'Dance',
                    'from'  => '£6',
                    'link'  => 'uk/london?search=dance',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'fitness_assets/bootcamp_class_img.jpg',
                    'name'  => 'BOOTCAMP',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=bootcamp',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'fitness_assets/martial_arts_class_img.jpg',
                    'name'  => 'MARTIAL ARTS',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=martial+arts',
                    'total' => '50',
                ],
            ]
        ]
    ],
    '/uk/london/martialarts' => [
        'title'       => 'First Martial Arts Class',
        'description' => 'Get your first Martial Arts class on US',
        'price'       => '£10',
        'category'    => 'Martial Arts',
        'category_id' => 4,
        'total'       => '100',
        'main_image'  => $base . 'martial_arts_assets/martial_arts_landing_img.jpg',
        'popup_image'  => $base . 'default_assets/martial_arts_modal_img.jpg',
        'blocks'      => [
            'large' => [
                [
                    'image' => $base . 'martial_arts_assets/martial_arts_class_img.jpg',
                    'name'  => 'MARTIAL ARTS',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=martial+arts',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'martial_arts_assets/fitness_class_img.jpg',
                    'name'  => 'FITNESS',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=fitness',
                    'total' => '50',
                ]
            ],
            'small' => [
                [
                    'image' => $base . 'martial_arts_assets/bootcamp_class_img.jpg',
                    'name'  => 'BOOTCAMP',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=bootcamp',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'martial_arts_assets/pilates_class_img.jpg',
                    'name'  => 'PILATES',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=pilates',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'martial_arts_assets/yoga_class_img.jpg',
                    'name'  => 'YOGA',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=yoga',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'martial_arts_assets/dance_class_img.jpg',
                    'name'  => 'Dance',
                    'from'  => '£6',
                    'link'  => 'uk/london?search=dance',
                    'total' => '50',
                ],
            ]
        ]
    ],
    '/uk/london/pilates'      => [
        'title'       => 'First Pilates Class',
        'description' => 'Get your first Pilates class on US',
        'price'       => '£10',
        'category'    => 'Pilates',
        'category_id' => 2,
        'total'       => '100',
        'main_image'  => $base . 'pilates_assets/pilates_class_landing.jpg',
        'popup_image'  => $base . 'default_assets/pilates_modal_img.jpg',
        'blocks'      => [
            'large' => [
                [
                    'image' => $base . 'pilates_assets/pilates_class_img.jpg',
                    'name'  => 'PILATES',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=pilates',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'pilates_assets/yoga_class_img.jpg',
                    'name'  => 'YOGA',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=yoga',
                    'total' => '50',
                ]
            ],
            'small' => [
                [
                    'image' => $base . 'pilates_assets/fitness_class_img.jpg',
                    'name'  => 'FITNESS',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=fitness',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'pilates_assets/dance_class_img.jpg',
                    'name'  => 'Dance',
                    'from'  => '£6',
                    'link'  => 'uk/london?search=dance',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'pilates_assets/bootcamp_class_img.jpg',
                    'name'  => 'BOOTCAMP',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=bootcamp',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'pilates_assets/martial_arts_class_img.jpg',
                    'name'  => 'MARTIAL ARTS',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=martial+arts',
                    'total' => '50',
                ]
            ]
        ]
    ],
    '/uk/london/yoga'         => [
        'title'       => 'First Yoga Class',
        'description' => 'Get your first Yoga class on US',
        'price'       => '£10',
        'category'    => 'Yoga',
        'category_id' => 5,
        'total'       => '100',
        'main_image'  => $base . 'yoga_assets/yoga_landing_img.jpg',
        'popup_image'  => $base . 'default_assets/yoga_modal_img.jpg',
        'blocks'      => [
            'large' => [
                [
                    'image' => $base . 'yoga_assets/yoga_class_img.jpg',
                    'name'  => 'YOGA',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=yoga',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'yoga_assets/pilates_class_img.jpg',
                    'name'  => 'PILATES',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=pilates',
                    'total' => '50',
                ]
            ],
            'small' => [
                [
                    'image' => $base . 'yoga_assets/fitness_class_img.jpg',
                    'name'  => 'FITNESS',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=fitness',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'yoga_assets/dance_class_img.jpg',
                    'name'  => 'Dance',
                    'from'  => '£6',
                    'link'  => 'uk/london?search=dance',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'yoga_assets/bootcamp_class_img.jpg',
                    'name'  => 'BOOTCAMP',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=bootcamp',
                    'total' => '50',
                ],
                [
                    'image' => $base . 'yoga_assets/martial_arts_class_img.jpg',
                    'name'  => 'MARTIAL ARTS',
                    'from'  => '£5',
                    'link'  => 'uk/london?search=martial+arts',
                    'total' => '50',
                ]
            ]
        ]
    ]
];