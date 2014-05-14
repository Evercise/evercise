<?php namespace widgets;

use Auth, BaseController, Form, Input, Redirect, Sentry, View, Request, Response, Validator, Image, Calendar;
 
class CalendarController extends \BaseController {

    protected $layout = 'widgets.calendar';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getCalendar()
	{
		// Look in CalendarComposer

	}

	public function postCalendar()
	{

		$calendarData = array();

		$template = '
		   {table_open}<table border="0" cellpadding="0" cellspacing="0" id="calendar">{/table_open}

		   {heading_row_start}<tr>{/heading_row_start}

		   {heading_previous_cell}<th><a href="#" id="month_{previous_url}">&#171;</a></th>{/heading_previous_cell}
		   {heading_title_cell}<th colspan="{colspan}"><h6>{heading}</h6></th>{/heading_title_cell}
		   {heading_next_cell}<th><a href="#" id="month_{next_url}">&#0187;</a></th>{/heading_next_cell}

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
		//\Calendar::initialize(array('template' => $template, 'show_next_prev' => true));

		$monthyear = explode("_", Input::get('monthyear'));
		$month = explode("-", $monthyear[1])[0];
		$year = explode("-", $monthyear[1])[1];

		//$month = date("m") - 1;
		//$year = date("Y");

		//$view->with('calendarData', $calendarData);
		return View::make('widgets.calendar')->with('calendarData', $calendarData)->with('year', $year)->with('month', $month);
	}
}