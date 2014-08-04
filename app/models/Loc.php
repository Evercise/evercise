<?php

class Loc {


	public static function text($page, $section)
	{
		return Config::get('localisations/'.$page)[$section];
	}
}