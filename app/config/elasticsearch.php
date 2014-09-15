<?php

use Monolog\Logger;

return [
    'hosts' => [
        (getenv('ELASTIC_HOST') ?: 'ec2-54-72-203-163.eu-west-1.compute.amazonaws.com:9200')
    ],
    'logPath' => storage_path().'/logs/elasticsaerch.log',
    'logLevel' => Logger::INFO
];