<?php

/**
 * This file is part of the GeocoderLaravel library.
 *
 * (c) Antoine Corcy <contact@sbin.dk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array(
    'providers' => array(
        'Geocoder\Provider\GoogleMapsProvider' => null,
        'Geocoder\Provider\IpInfoDbProvider'  => ['72d336b615cb2db814cc8c0f4beb4a38d3b0c94b915b61e5420252b2a169ac6c'], // or array()
        // ...
    ),
    'adapter'  => 'Geocoder\HttpAdapter\CurlHttpAdapter'
);
