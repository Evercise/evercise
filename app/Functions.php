<?php


if (!function_exists('hashDir')) {

    function hashDir($id, $folder = 'gallery')
    {

        $id = abs($id + 20000);

        $path = 'files/' . $folder;

        if (!is_dir($path)) {
            mkdir($path);
        }


        $h = $id % 4096;
        $maindir = floor($h / 64);
        $subdir = $h % 64;
        if (!is_dir($path . '/' .  $maindir)) {
            mkdir($path . '/' .  $maindir);
        }
        if (!is_dir($path .  '/' .  $maindir . '/' . $subdir)) {
            mkdir($path . '/' .  $maindir . '/' . $subdir);
        }

        return $path . '/' .  $maindir . '/' . $subdir;


    }
}


if (!function_exists('isTesting')) {

    function isTesting()
    {

        if (isset($_GET['test'])) {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            $allowed_ips = Config::get('evercise.testing_ips');


            foreach ($allowed_ips as $i) {
                if (strpos($ip, $i) !== false) {
                    return true;
                }

            }

        }

        return false;
    }
}


class Functions
{

    public static function getPosition($address = null)
    {
        if (is_null($address)) {
            $query = Request::getClientIp();

            if ($query == '127.0.0.1' || $query == null) {
                $query = '151.237.238.126'; /* london office? */
            }
        } else {
            $query = $address;
        }


        $geocoder = new \Geocoder\Geocoder();
        $adapter = new \Geocoder\HttpAdapter\CurlHttpAdapter();

        $chain = new \Geocoder\Provider\ChainProvider(array(
            new \Geocoder\Provider\FreeGeoIpProvider($adapter),
            new \Geocoder\Provider\HostIpProvider($adapter),
            new \Geocoder\Provider\IpGeoBaseProvider($adapter),
            new \Geocoder\Provider\GoogleMapsProvider($adapter),
        ));

        $geocoder->registerProvider($chain);

        try {
            $geocode = $geocoder->geocode($query);
        } catch (Exception $e) {
            $geocode = $geocoder->geocode('london');
        }

        /* catch should pick this up
        if ($geocode->getLatitude() == 0 && $geocode->getLongitude() == 0) {
           $geocode = $geocoder->geocode('london');
        }*/

        return $geocode;
    }

    public static function getDistance($clientLat, $clientLng, $lat, $lng)
    {
        $geotools = new \League\Geotools\Geotools();
        $coordA = new \League\Geotools\Coordinate\Coordinate(array($clientLat, $clientLng));
        $coordB = new \League\Geotools\Coordinate\Coordinate(array($lat, $lng));
        $distance = $geotools->distance()->setFrom($coordA)->setTo($coordB);

        return $distance;
    }

    public static function getCalendarTemplate()
    {
        $template = '
            {table_open}<table border="0" cellpadding="0" cellspacing="0" id="calendar" class="calendar">{/table_open}

            {heading_row_start}<tr class="calendar-head">{/heading_row_start}

            {heading_previous_cell}<th><a href="#" id="month_{previous_url}" class="text-left"><span class="icon icon-grey-left-arrow hover"></span></a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan="{colspan}"><strong class="text-center">{heading}</strong></th>{/heading_title_cell}
            {heading_next_cell}<th><a href="#" id="month_{next_url}" class="text-right"><span class="icon icon-grey-right-arrow hover"></span></a></th>{/heading_next_cell}

            {heading_row_end}</tr>{/heading_row_end}

            {week_row_start}<tr class="calendar-days">{/week_row_start}
            {week_day_cell}<td><a class="active" href="{week_day}">{week_day}</a></td>{/week_day_cell}
            {week_row_end}</tr>{/week_row_end}

            {cal_row_start}<tr class="calendar-row">{/cal_row_start}
            {cal_cell_start}<td>{/cal_cell_start}

            {cal_cell_content}<a class="active" href="{content}">{day}</a>{/cal_cell_content}
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

    public static function randomPassword($charachters)
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $charachters; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }


    public static function arrayDate($array, $format = 'h:ia M-dS')
    {
        $dateTime = array();

        foreach ($array as $key => $value) {
            $dateTime[$key] = date($format, strtotime($value));
        }
        return $dateTime;
    }

}