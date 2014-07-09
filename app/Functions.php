<?php
 
class Functions {
 
    public static function getPosition()
    {
        $query = Request::getClientIp();

        if ($query = '127.0.0.1' || $query = null) {
            $query = '151.237.238.126';
           // $query = '10 rue Gambetta, Paris, France';
        }

        $geocoder = new \Geocoder\Geocoder();
        $adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();

        $chain    = new \Geocoder\Provider\ChainProvider(array(
                    new \Geocoder\Provider\FreeGeoIpProvider($adapter),
                    new \Geocoder\Provider\HostIpProvider($adapter),
                    new \Geocoder\Provider\IpGeoBaseProvider($adapter),
                    
                    new \Geocoder\Provider\GoogleMapsProvider($adapter),
        ));

        $geocoder->registerProvider($chain);

        try {
            $geocode = $geocoder->geocode($query);
        } catch (Exception $e) {
            //return $query;
        }   

        if ($geocode->getLatitude() == 0 && $geocode->getLongitude() == 0) {
           $geocode = $geocoder->geocode('london');
        }

        return $geocode;
    }

    public static function getDistance($clientLat, $clientLng, $lat, $lng)
    {
    $geotools = new \League\Geotools\Geotools();
    $coordA   = new \League\Geotools\Coordinate\Coordinate(array($clientLat, $clientLng));
    $coordB   = new \League\Geotools\Coordinate\Coordinate(array($lat, $lng));
    $distance = $geotools->distance()->setFrom($coordA)->setTo($coordB);

    return $distance;
    }

    public static function getCalendarTemplate()
    {
        $template = '
            {table_open}<table border="0" cellpadding="0" cellspacing="0" id="calendar">{/table_open}

            {heading_row_start}<tr class="calendar-head">{/heading_row_start}

            {heading_previous_cell}<th><a href="#" id="month_{previous_url}">&#171;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan="{colspan}"><h6>{heading}</h6></th>{/heading_title_cell}
            {heading_next_cell}<th><a href="#" id="month_{next_url}">&#0187;</a></th>{/heading_next_cell}

            {heading_row_end}</tr>{/heading_row_end}

            {week_row_start}<tr class="calendar-days">{/week_row_start}
            {week_day_cell}<td>{week_day}</td>{/week_day_cell}
            {week_row_end}</tr>{/week_row_end}

            {cal_row_start}<tr class="calendar-row">{/cal_row_start}
            {cal_cell_start}<td>{/cal_cell_start}

            {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
            {cal_cell_content_today}<div class="calendarHighlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

            {cal_cell_no_content}{day}{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class="calendarHighlight">{day}</div>{/cal_cell_no_content_today}

            {cal_cell_blank}&nbsp;{/cal_cell_blank}

            {cal_cell_end}</td>{/cal_cell_end}
            {cal_row_end}</tr>{/cal_row_end}

            {table_close}</table>{/table_close}
        ';

        return $template;
    }

    public static function randomPassword($charachters) {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $charachters; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }



    public static function arrayDate($array, $format='h:ia M-dS')
    {
        $dateTime = array();

        foreach ($array as $key => $value) {
            $dateTime[$key] = date($format, strtotime($value));
        }
        return $dateTime;
    }
 
}