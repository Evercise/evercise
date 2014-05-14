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
		
	}
}