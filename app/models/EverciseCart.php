<?php

class EverciseCart extends Cart
{

    /**
     * @param $type
     * @param $id
     * @return string
     *
     * Convert session-id or package-id into a unique product code
     */
    public static function toProductCode($type, $id)
    {
        $productCode = '';
        switch($type)
        {
            case 'session':
                $productCode = 'S' . $id;
                break;
            case 'package':
                $productCode = 'P' . $id;
                break;
        }
        return $productCode;
    }

    /**
     * @param $productCode
     * @return array|bool
     *
     * Convert product code back to session-id or package-id
     */
    public static function fromProductCode($productCode)
    {
        if (count( $chunks = explode('S', $productCode) ) > 1) {
            $id = $chunks[1];
            $type = 'session';
        }
        else if (count( $chunks = explode('P', $productCode) ) > 1){
            $id = $chunks[1];
            $type = 'package';
        }
        else return false;

        return ['id' => $id, 'type' => $type];
    }
} 