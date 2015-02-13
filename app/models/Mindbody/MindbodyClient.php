<?php namespace MindbodyAPI;

use MindbodyAPI\structures\SourceCredentials;
use MindbodyAPI\structures\UserCredentials;
use UnexpectedValueException;

class MindbodyClient extends \SoapClient {
	public static $classmap = [];

	public static function service($name) {
		$class = "MindbodyAPI\\services\\{$name}";
		
		return new $class;
	}

	public static function request(
		$type,
		SourceCredentials $sourceCredentials = NULL,
		UserCredentials $userCredentials = NULL,
		$params = [],
		$unset = []
	) {

		$requestName = "MindbodyAPI\\structures\\{$type}";
		$requestRequestName = "{$requestName}Request";

		if (!class_exists($requestName) || !class_exists($requestRequestName)) {
			return FALSE;
		}
		$request = new $requestName;
		$request->Request = new $requestRequestName;
		if ($sourceCredentials) {
			$request->Request->SourceCredentials = $sourceCredentials;
		} else {
			$request->Request->SourceCredentials = new SourceCredentials();
		}

		if ($userCredentials) {
			$request->Request->UserCredentials = $userCredentials;
		}


		foreach ($params as $key => $val) {
			$request->Request->{$key} = $val;
		}

		foreach ($unset as $key) {
			unset($request->Request->$key);
		}


		return $request;
	}
	
	public static function credentials($sourcename = null, $password = null, Array $siteids = null) {
		$credentials = new structures\SourceCredentials;
		$credentials->SourceName = $sourcename;
		$credentials->Password = $password;
		$credentials->SiteIDs = $siteids;
		
		return $credentials;
	}
	
	public static function userCredentials($username, $password, Array $siteids = null) {
		$credentials = new structures\UserCredentials;
		$credentials->Username = $username;
		$credentials->Password = $password;
		$credentials->SiteIDs = $siteids;
		
		return $credentials;
	}
	
	public static function structure($type, $propMap = null) {
		if($propMap && !(is_array($propMap) || is_object($propMap)))
			throw new UnexpectedValueException("\$propMap must be an array or an object");
	
		if(isset(static::$classmap[$type])) {
			$structure = new static::$classmap[$type]();
			if(!empty($propMap))
				foreach($propMap as $name => $value) {
					if(property_exists($structure, $name))
						$structure->$name = $value;
				}
			return $structure;
		} else
			throw new UnexpectedValueException("{$type} is not a valid type associated with ".get_called_class());
	}
	
	public function __soapCall($function_name, $arguments, $options = [], $input_headers = [], &$output_headers = []) {

		$result = parent::__soapCall($function_name, $arguments, $options, $input_headers, $output_headers);

		$expectedResultType = "{$function_name}Result";
		
		if(isset($result->$expectedResultType))
			return $result->$expectedResultType;
		
		return $result;
	}
}
