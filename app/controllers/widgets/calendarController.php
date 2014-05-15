<?php namespace widgets;

use Auth, BaseController, Form, Input, Redirect, Sentry, View, Request, Response, Validator, Image, Calendar, Functions;
 
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
		$month = Input::get('month');
		$year = Input::get('year');

		return View::make('widgets.calendar')->with('year', $year)->with('month', $month);
	}
}