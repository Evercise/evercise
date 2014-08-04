<?php

class Loc {


	public static function text($page, $section, $uc=false)
	{
    try
    {
      $text = Config::get('localisations/'.$page)[$section];
      if ($uc)
        $text = ucfirst($text);
    }
    catch(Exception $e)
    {
      return 'ERROR: '.$section;
    }

		return $text;
	}
}