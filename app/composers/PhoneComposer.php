<?php
 
class PhoneComposer {

	 public function compose($view)
  	{
      
      $country_codes = [''=>'-- Select country code --'];
      foreach(Config::get('countrycodes') as $c)
      {
        $country_codes['+'.$c['code']] = $c['name'];
      }
      natsort($country_codes);

      
      $country_codes = [ '+1' => $country_codes['+1']] + $country_codes;
      $country_codes = [ '+44' => $country_codes['+44']] + $country_codes;

      Javascript::put(['updateCountryCode'=>1]);
      $view->with('country_codes', $country_codes);
  	}
}