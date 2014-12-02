<?php

    if (!function_exists('event')) {

        /*
         * Wrap event class
         *
         */

        function event($name, $params = [])
        {
            Event::fire($name, $params);
        }
    }


    if (!function_exists('d')) {

        /*
         * nice print of vardump without the xdebug
         *
         */

        function d($var, $die = true)
        {
            echo "<pre>";
            print_r($var);
            echo "</pre>";
            if ($die) {
                die();
            }
        }
    }

    if (!function_exists('returnPlural')) {

        /*
         * nice print of vardump without the xdebug
         *
         */

        function returnPlural($string, $count = 1)
        {
            if (is_array($count)) {
                $count = count($count);
            }
            if ($count == 1) {
                return str_singular($string);
            }

            return str_plural($string);
        }
    }


    if (!function_exists('image')) {

        /*
         * nice print of vardump without the xdebug
         *
         */

        function image($image, $alt = 'image', $params = [])
        {
            /*
             * return html image tag
             */
            return HTML::image($image, $alt, $params);
        }
    }


    if (!function_exists('generateImage')) {
        function generateImage($size = 200)
        {
            
            $hash = str_random();

            /* parse hash string */

            $csh = hexdec(substr($hash, 0, 1)); // corner sprite shape
            $ssh = hexdec(substr($hash, 1, 1)); // side sprite shape
            $xsh = hexdec(substr($hash, 2, 1)) & 7; // center sprite shape

            $cro = hexdec(substr($hash, 3, 1)) & 3; // corner sprite rotation
            $sro = hexdec(substr($hash, 4, 1)) & 3; // side sprite rotation
            $xbg = hexdec(substr($hash, 5, 1)) % 2; // center sprite background

            /* corner sprite foreground color */
            $cfr = hexdec(substr($hash, 6, 2));
            $cfg = hexdec(substr($hash, 8, 2));
            $cfb = hexdec(substr($hash, 10, 2));

            /* side sprite foreground color */
            $sfr = hexdec(substr($hash, 12, 2));
            $sfg = hexdec(substr($hash, 14, 2));
            $sfb = hexdec(substr($hash, 16, 2));

            /* final angle of rotation */
            $angle = hexdec(substr($hash, 18, 2));

            /* size of each sprite */
            $spriteZ = 128;

            /* start with blank 3x3 identicon */
            $identicon = imagecreatetruecolor($spriteZ * 3, $spriteZ * 3);
            imageantialias($identicon, TRUE);

            /* assign white as background */
            $bg = imagecolorallocate($identicon, 255, 255, 255);
            imagefilledrectangle($identicon, 0, 0, $spriteZ, $spriteZ, $bg);

            /* generate corner sprites */
            $corner = getsprite($csh, $cfr, $cfg, $cfb, $cro);
            imagecopy($identicon, $corner, 0, 0, 0, 0, $spriteZ, $spriteZ);
            $corner = imagerotate($corner, 90, $bg);
            imagecopy($identicon, $corner, 0, $spriteZ * 2, 0, 0, $spriteZ, $spriteZ);
            $corner = imagerotate($corner, 90, $bg);
            imagecopy($identicon, $corner, $spriteZ * 2, $spriteZ * 2, 0, 0, $spriteZ, $spriteZ);
            $corner = imagerotate($corner, 90, $bg);
            imagecopy($identicon, $corner, $spriteZ * 2, 0, 0, 0, $spriteZ, $spriteZ);

            /* generate side sprites */
            $side = getsprite($ssh, $sfr, $sfg, $sfb, $sro);
            imagecopy($identicon, $side, $spriteZ, 0, 0, 0, $spriteZ, $spriteZ);
            $side = imagerotate($side, 90, $bg);
            imagecopy($identicon, $side, 0, $spriteZ, 0, 0, $spriteZ, $spriteZ);
            $side = imagerotate($side, 90, $bg);
            imagecopy($identicon, $side, $spriteZ, $spriteZ * 2, 0, 0, $spriteZ, $spriteZ);
            $side = imagerotate($side, 90, $bg);
            imagecopy($identicon, $side, $spriteZ * 2, $spriteZ, 0, 0, $spriteZ, $spriteZ);

            /* generate center sprite */
            $center = getcenter($xsh, $cfr, $cfg, $cfb, $sfr, $sfg, $sfb, $xbg);
            imagecopy($identicon, $center, $spriteZ, $spriteZ, 0, 0, $spriteZ, $spriteZ);

            // $identicon=imagerotate($identicon,$angle,$bg);

            /* make white transparent */
            imagecolortransparent($identicon, $bg);

            /* create blank image according to specified dimensions */
            $resized = imagecreatetruecolor($size, $size);
            imageantialias($resized, TRUE);

            /* assign white as background */
            $bg = imagecolorallocate($resized, 255, 255, 255);
            imagefilledrectangle($resized, 0, 0, $size, $size, $bg);

            /* resize identicon according to specification */
            imagecopyresampled($resized, $identicon, 0, 0, (imagesx($identicon) - $spriteZ * 3) / 2,
                (imagesx($identicon) - $spriteZ * 3) / 2, $size, $size, $spriteZ * 3, $spriteZ * 3);

            /* make white transparent */
            imagecolortransparent($resized, $bg);

            return $resized;
        }


        /* generate sprite for corners and sides */
        function getsprite($shape, $R, $G, $B, $rotation)
        {
            global $spriteZ;
            $sprite = imagecreatetruecolor($spriteZ, $spriteZ);
            imageantialias($sprite, TRUE);
            $fg = imagecolorallocate($sprite, $R, $G, $B);
            $bg = imagecolorallocate($sprite, 255, 255, 255);
            imagefilledrectangle($sprite, 0, 0, $spriteZ, $spriteZ, $bg);
            switch ($shape) {
                case 0: // triangle
                    $shape = [
                        0.5,
                        1,
                        1,
                        0,
                        1,
                        1
                    ];
                    break;
                case 1: // parallelogram
                    $shape = [
                        0.5,
                        0,
                        1,
                        0,
                        0.5,
                        1,
                        0,
                        1
                    ];
                    break;
                case 2: // mouse ears
                    $shape = [
                        0.5,
                        0,
                        1,
                        0,
                        1,
                        1,
                        0.5,
                        1,
                        1,
                        0.5
                    ];
                    break;
                case 3: // ribbon
                    $shape = [
                        0,
                        0.5,
                        0.5,
                        0,
                        1,
                        0.5,
                        0.5,
                        1,
                        0.5,
                        0.5
                    ];
                    break;
                case 4: // sails
                    $shape = [
                        0,
                        0.5,
                        1,
                        0,
                        1,
                        1,
                        0,
                        1,
                        1,
                        0.5
                    ];
                    break;
                case 5: // fins
                    $shape = [
                        1,
                        0,
                        1,
                        1,
                        0.5,
                        1,
                        1,
                        0.5,
                        0.5,
                        0.5
                    ];
                    break;
                case 6: // beak
                    $shape = [
                        0,
                        0,
                        1,
                        0,
                        1,
                        0.5,
                        0,
                        0,
                        0.5,
                        1,
                        0,
                        1
                    ];
                    break;
                case 7: // chevron
                    $shape = [
                        0,
                        0,
                        0.5,
                        0,
                        1,
                        0.5,
                        0.5,
                        1,
                        0,
                        1,
                        0.5,
                        0.5
                    ];
                    break;
                case 8: // fish
                    $shape = [
                        0.5,
                        0,
                        0.5,
                        0.5,
                        1,
                        0.5,
                        1,
                        1,
                        0.5,
                        1,
                        0.5,
                        0.5,
                        0,
                        0.5
                    ];
                    break;
                case 9: // kite
                    $shape = [
                        0,
                        0,
                        1,
                        0,
                        0.5,
                        0.5,
                        1,
                        0.5,
                        0.5,
                        1,
                        0.5,
                        0.5,
                        0,
                        1
                    ];
                    break;
                case 10: // trough
                    $shape = [
                        0,
                        0.5,
                        0.5,
                        1,
                        1,
                        0.5,
                        0.5,
                        0,
                        1,
                        0,
                        1,
                        1,
                        0,
                        1
                    ];
                    break;
                case 11: // rays
                    $shape = [
                        0.5,
                        0,
                        1,
                        0,
                        1,
                        1,
                        0.5,
                        1,
                        1,
                        0.75,
                        0.5,
                        0.5,
                        1,
                        0.25
                    ];
                    break;
                case 12: // double rhombus
                    $shape = [
                        0,
                        0.5,
                        0.5,
                        0,
                        0.5,
                        0.5,
                        1,
                        0,
                        1,
                        0.5,
                        0.5,
                        1,
                        0.5,
                        0.5,
                        0,
                        1
                    ];
                    break;
                case 13: // crown
                    $shape = [
                        0,
                        0,
                        1,
                        0,
                        1,
                        1,
                        0,
                        1,
                        1,
                        0.5,
                        0.5,
                        0.25,
                        0.5,
                        0.75,
                        0,
                        0.5,
                        0.5,
                        0.25
                    ];
                    break;
                case 14: // radioactive
                    $shape = [
                        0,
                        0.5,
                        0.5,
                        0.5,
                        0.5,
                        0,
                        1,
                        0,
                        0.5,
                        0.5,
                        1,
                        0.5,
                        0.5,
                        1,
                        0.5,
                        0.5,
                        0,
                        1
                    ];
                    break;
                default: // tiles
                    $shape = [
                        0,
                        0,
                        1,
                        0,
                        0.5,
                        0.5,
                        0.5,
                        0,
                        0,
                        0.5,
                        1,
                        0.5,
                        0.5,
                        1,
                        0.5,
                        0.5,
                        0,
                        1
                    ];
                    break;
            }
            /* apply ratios */
            for ($i = 0; $i < count($shape); $i++)
                $shape[$i] = $shape[$i] * $spriteZ;
            imagefilledpolygon($sprite, $shape, count($shape) / 2, $fg);
            /* rotate the sprite */
            for ($i = 0; $i < $rotation; $i++)
                $sprite = imagerotate($sprite, 90, $bg);

            return $sprite;
        }

        /* generate sprite for center block */
        function getcenter($shape, $fR, $fG, $fB, $bR, $bG, $bB, $usebg)
        {
            global $spriteZ;
            $sprite = imagecreatetruecolor($spriteZ, $spriteZ);
            imageantialias($sprite, TRUE);
            $fg = imagecolorallocate($sprite, $fR, $fG, $fB);
            /* make sure there's enough contrast before we use background color of side sprite */
            if ($usebg > 0 && (abs($fR - $bR) > 127 || abs($fG - $bG) > 127 || abs($fB - $bB) > 127))
                $bg = imagecolorallocate($sprite, $bR, $bG, $bB);
            else
                $bg = imagecolorallocate($sprite, 255, 255, 255);
            imagefilledrectangle($sprite, 0, 0, $spriteZ, $spriteZ, $bg);
            switch ($shape) {
                case 0: // empty
                    $shape = [];
                    break;
                case 1: // fill
                    $shape = [
                        0,
                        0,
                        1,
                        0,
                        1,
                        1,
                        0,
                        1
                    ];
                    break;
                case 2: // diamond
                    $shape = [
                        0.5,
                        0,
                        1,
                        0.5,
                        0.5,
                        1,
                        0,
                        0.5
                    ];
                    break;
                case 3: // reverse diamond
                    $shape = [
                        0,
                        0,
                        1,
                        0,
                        1,
                        1,
                        0,
                        1,
                        0,
                        0.5,
                        0.5,
                        1,
                        1,
                        0.5,
                        0.5,
                        0,
                        0,
                        0.5
                    ];
                    break;
                case 4: // cross
                    $shape = [
                        0.25,
                        0,
                        0.75,
                        0,
                        0.5,
                        0.5,
                        1,
                        0.25,
                        1,
                        0.75,
                        0.5,
                        0.5,
                        0.75,
                        1,
                        0.25,
                        1,
                        0.5,
                        0.5,
                        0,
                        0.75,
                        0,
                        0.25,
                        0.5,
                        0.5
                    ];
                    break;
                case 5: // morning star
                    $shape = [
                        0,
                        0,
                        0.5,
                        0.25,
                        1,
                        0,
                        0.75,
                        0.5,
                        1,
                        1,
                        0.5,
                        0.75,
                        0,
                        1,
                        0.25,
                        0.5
                    ];
                    break;
                case 6: // small square
                    $shape = [
                        0.33,
                        0.33,
                        0.67,
                        0.33,
                        0.67,
                        0.67,
                        0.33,
                        0.67
                    ];
                    break;
                case 7: // checkerboard
                    $shape = [
                        0,
                        0,
                        0.33,
                        0,
                        0.33,
                        0.33,
                        0.66,
                        0.33,
                        0.67,
                        0,
                        1,
                        0,
                        1,
                        0.33,
                        0.67,
                        0.33,
                        0.67,
                        0.67,
                        1,
                        0.67,
                        1,
                        1,
                        0.67,
                        1,
                        0.67,
                        0.67,
                        0.33,
                        0.67,
                        0.33,
                        1,
                        0,
                        1,
                        0,
                        0.67,
                        0.33,
                        0.67,
                        0.33,
                        0.33,
                        0,
                        0.33
                    ];
                    break;
            }
            /* apply ratios */
            for ($i = 0; $i < count($shape); $i++)
                $shape[$i] = $shape[$i] * $spriteZ;
            if (count($shape) > 0)
                imagefilledpolygon($sprite, $shape, count($shape) / 2, $fg);

            return $sprite;
        }


    }

    if (!function_exists('slugIt')) {

        /*
         * Slug the string and convert all non latin characters into similar letters
         *
         * Example:
         *  ć  =>  c
         *  Ể  =>  E
         *
         */

        function slugIt($str, $slug = true, $separator = '-')
        {
            $foreign_chars = Config::get('foreign_chars');

            $array_from = array_keys($foreign_chars);
            $array_to   = array_values($foreign_chars);

            if (is_array($str) || is_object($str)) {
                $str = implode(' ', (array)$str);
            }

            $str = preg_replace($array_from, $array_to, $str);

            if ($slug) {
                return Str::slug($str, $separator);
            }

            return $str;
        }
    }

    if (!function_exists('hashDir')) {

        function hashDir($id, $folder = 'gallery')
        {

            $id = abs($id + 20000);

            $public = '';

            if (App::runningInConsole()) {
                $public = 'public/';
            }

            $path = 'files/' . $folder;

            if (!is_dir($public . $path)) {
                mkdir($public . $path);
            }


            $h       = $id % 4096;
            $maindir = floor($h / 64);
            $subdir  = $h % 64;


            if (!is_dir($public . $path)) {
                mkdir($public . $path);
            }


            if (!is_dir($public . $path . '/' . $maindir)) {
                mkdir($public . $path . '/' . $maindir);
            }
            if (!is_dir($public . $path . '/' . $maindir . '/' . $subdir)) {
                mkdir($public . $path . '/' . $maindir . '/' . $subdir);
            }

            return $path . '/' . $maindir . '/' . $subdir;


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
            $adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();

            $chain = new \Geocoder\Provider\ChainProvider([
                new \Geocoder\Provider\FreeGeoIpProvider($adapter),
                new \Geocoder\Provider\HostIpProvider($adapter),
                new \Geocoder\Provider\IpGeoBaseProvider($adapter),
                new \Geocoder\Provider\GoogleMapsProvider($adapter),
            ]);

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
            $coordA   = new \League\Geotools\Coordinate\Coordinate([$clientLat, $clientLng]);
            $coordB   = new \League\Geotools\Coordinate\Coordinate([$lat, $lng]);
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
            $alphabet    = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
            $pass        = []; //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < $charachters; $i++) {
                $n      = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }

            return implode($pass); //turn the array into a string
        }


        public static function arrayDate($array, $format = 'h:ia M-dS')
        {
            $dateTime = [];

            foreach ($array as $key => $value) {
                $dateTime[$key] = date($format, strtotime($value));
            }

            return $dateTime;
        }

    }