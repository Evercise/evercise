<?php

View::composer('form.password', function($view)
{
    $view->with('confirmation', (isset($view->confirmation) ? $view->confirmation : false));
});

View::composer(array('widgets.calendar'), function($view)
{
	$calendarData = array();

	$template = '
	   {table_open}<table border="0" cellpadding="0" cellspacing="0" id="calendar">{/table_open}

	   {heading_row_start}<tr>{/heading_row_start}

	   {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
	   {heading_title_cell}<th colspan="{colspan}"><h6>{heading}</h6></th>{/heading_title_cell}
	   {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

	   {heading_row_end}</tr>{/heading_row_end}

	   {week_row_start}<tr class="calendar-days">{/week_row_start}
	   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
	   {week_row_end}</tr>{/week_row_end}

	   {cal_row_start}<tr>{/cal_row_start}
	   {cal_cell_start}<td>{/cal_cell_start}

	   {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
	   {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

	   {cal_cell_no_content}<a href="#" id="day_{day}">{day}</a>{/cal_cell_no_content}
	   {cal_cell_no_content_today}<a href="#" id="day_{day}"><div class="highlight">{day}</a></div>{/cal_cell_no_content_today}

	   {cal_cell_blank}&nbsp;{/cal_cell_blank}

	   {cal_cell_end}</td>{/cal_cell_end}
	   {cal_row_end}</tr>{/cal_row_end}

	   {table_close}</table>{/table_close}
	';

	JavaScript::put(array('sliderParams' => json_encode(array('min'=>0, 'max'=>99, 'step'=>0.50, 'value'=>1))));

	Calendar::initialize(array('template' => $template));

	$view->with('calendarData', $calendarData);
});

View::composer('widgets.mapForm', function($view)
{
    $query = Request::getClientIp();

    if ($query = '127.0.0.1' || $query = null) {
        $query = '151.237.238.126';
    }

    $geocoder = new \Geocoder\Geocoder();
    $adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();
    $provider = new \Geocoder\Provider\GoogleMapsProvider($adapter);

    $chain    = new \Geocoder\Provider\ChainProvider(array(
                new \Geocoder\Provider\FreeGeoIpProvider($adapter),
                new \Geocoder\Provider\HostIpProvider($adapter),
                new \Geocoder\Provider\GoogleMapsProvider($adapter),
    ));

    $geocoder->registerProvider($chain);
    
    try {
        $geocode = $geocoder->geocode($query);
    } catch (Exception $e) {
        echo $e->getMessage();
    }   

    JavaScript::put(array('latitude' => json_encode( $geocode->getLatitude()) , 'longitude' => json_encode( $geocode->getLongitude()) )  );

	$view->with('houseNumber', $geocode->getStreetNumber())->with('streetName', $geocode->getStreetName())->with('city', $geocode->getCity())->with('postCode', $geocode->getZipcode());
});

View::composer('widgets.time', function($view)
{
	$hours = array();
	for ($i=0; $i<24; $i++)
	{
		$hours[$i] = $i;
	}

	$minute_intervals = 15;
	$minutes = array();
	for ($i=0; $i<60; $i+=$minute_intervals)
	{
		$minutes[$i] = $i;
	}

	$view->with('hours', $hours)->with('minutes', $minutes);
});