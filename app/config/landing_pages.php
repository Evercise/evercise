<?php

$base = 'assets/img/landings/';
return [
      '/uk/london/bootcamp' => [
          'title' => 'First Bootcamp Class',
          'description' => 'Get your first Bootcamp class on US',
          'price' => '£10',
          'category' => 'Bootcamp',
          'main_image'  => $base.'bootcamp_assets/bootcamp_landing_img.jpg',
          'blocks' => [
              'large' => [
                  [
                      'image' => $base.'bootcamp_assets/bootcamp_class_img.jpg',
                      'name' => 'BOOTCAMP',
                      'from' => '£7',
                      'link' => 'uk/london?search=bootcamp',
                      'total' => '50',
                  ],
                  [
                      'image' => $base.'bootcamp_assets/fitness_class_img.jpg',
                      'name' => 'FITNESS',
                      'from' => '£7',
                      'link' => 'uk/london?search=fitness',
                      'total' => '50',
                  ]
              ],
              'small' => [
                  [
                      'image' => $base.'bootcamp_assets/martial_arts_class_img.jpg',
                      'name' => 'MARTIAL ARTS',
                      'from' => '£7',
                      'link' => 'uk/london?search=martial+arts',
                      'total' => '50',
                  ],
                  [
                      'image' => $base.'bootcamp_assets/yoga_class_img.jpg',
                      'name' => 'YOGA',
                      'from' => '£7',
                      'link' => 'uk/london?search=yoga',
                      'total' => '50',
                  ],
                  [
                      'image' => $base.'bootcamp_assets/pilates_class_img.jpg',
                      'name' => 'PILATES',
                      'from' => '£7',
                      'link' => 'uk/london?search=pilates',
                      'total' => '50',
                  ],
                  [
                      'image' => $base.'bootcamp_assets/dance_class_img.jpg',
                      'name' => 'DANCE',
                      'from' => '£7',
                      'link' => 'uk/london?search=dance',
                      'total' => '50',
                  ],
              ]
          ]
      ]
];