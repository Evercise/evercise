<?php

use InvalidArgumentException;


/**
 * Class ValidationHelper
 * @package App\Models
 */
class ValidationHelper
{

    /**
     * Forward to doRegex
     *
     * @param $attr
     * @param $value
     * @param $params
     * @return bool
     */
    public static function hasRegex($attr, $value, $params)
    {
        return self::doRegex($attr, $value, $params, true);
    }

    /**
     * Forward to doRegex
     *
     * @param $attr
     * @param $value
     * @param $params
     * @return bool
     */
    public static function hasNotRegex($attr, $value, $params)
    {
        return self::doRegex($attr, $value, $params, false);
    }


    /**
     * Check the Regex for the validation class
     * @param $attr
     * @param $value
     * @param $params
     * @param bool $has
     * @return bool
     * @throws InvalidArgumentException
     */
    private function doRegex($attr, $value, $params, $has = true)
    {

        if (!count($params)) {
            throw new InvalidArgumentException('The has validation rule expects at least one parameter, 0 given.');
        }
        foreach ($params as $param) {
            switch ($param) {
                case 'num':
                    $regex = '/\pN/';
                    break;
                case 'letter':
                    $regex = '/\pL/';
                    break;
                case 'lower':
                    $regex = '/\p{Ll}/';
                    break;
                case 'upper':
                    $regex = '/\p{Lu}/';
                    break;
                case 'special':
                    $regex = '/[\pP\pS]/';
                    break;
                default:
                    $regex = $param;
            }

            if($has && !preg_match($regex, $value)) {
                return false;
            }

            if(!$has && preg_match($regex, $value)) {
                return false;
            }
        }
        return true;
    }
}