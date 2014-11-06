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
            $type = 'session';
            if (count($chunks) < 2) return false;
            $id = $chunks[1];
        }
        else if (count( $chunks = explode('P', $productCode) ) > 1){
            $type = 'package';
            if (count($chunks) < 2) return false;
            $id = $chunks[1];
        }
        else if (count( $chunks = explode('T', $productCode) ) > 1){

            $type = 'topup';
            $id = 'TOPUP';
        }

        return ['id' => $id, 'type' => $type];
    }

    /**
     * @return $this
     *
     * Return Cart data formatted as an array
     */
    public static function getCart()
    {

        $cartRows = parent::content();
        $subTotal = parent::total();
        $discount = 0;
        $total = ($subTotal / 100) * (100 - $discount);

        $data = [
            'discount'   => $discount,
            'subTotal'   => $subTotal,
            'total'      => $total,
            'cartRows'   => $cartRows,
        ];

        return $data;

    }

    public static function clearTopup()
    {
        $cartRowIds = EverciseCart::search(['id' => 'TOPUP']);
        if($cartRowIds)
            foreach($cartRowIds as $cartRowId)
                EverciseCart::remove($cartRowId);
    }
} 