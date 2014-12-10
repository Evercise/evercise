<?php


return [
    'active'   => getenv('PARDOT_ACTIVE') ?: FALSE,
    'campayns' => [
        'mail' => [
            'welcome' => 3598,
            'userupgrade' => 3600
        ]
    ]
];