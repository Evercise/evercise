<?php

class CartController extends \BaseController
{

    public function add()
    {
        $sessionId = Input::get('session-id', false);
        $evercisegroupId = Input::get('evercisegroup-id', false);
        $quantity = Input::get('quantity', 1);

        $session = Evercisesession::find($sessionId)->first();

        $productCode = Static::toProductCode('session', $sessionId);

        $rowId = Cart::search(['id' => $productCode]);
        if($rowId) // If product ID already exists in cart, then add to quantity.
        {
            $currentQuantity = Cart::get($rowId)->qty;
            $newQuantity = $currentQuantity + $quantity;
            Cart::update($rowId, $newQuantity);
        }
        else
        {
            Cart::associate('Evercisesession')->add( $productCode, $session->evercisegroup->name, $quantity, $session->price,
                [
                    'evercisegroupId' => $evercisegroupId,
                    'sessionId' => $sessionId,
                    'date_time' => $session->date_time
                ]
            );
        }

        return $this->getCart();

/*        return Response::json(
            [
                'callback' => 'adminPopupMessage',
                'message' => $sessionId,
            ]
        );*/
    }

    public function remove($rowId)
    {
        $quantity = Input::get('quantity', 1);

        $currentQuantity = Cart::get($rowId)->qty;
        $newQuantity = $currentQuantity - $quantity;
        if ($newQuantity > 0)
            Cart::update($rowId, $newQuantity);
        else
            Cart::remove($rowId);

        return $this->getCart();
    }

    public function delete($rowId)
    {
        Cart::remove($rowId);

        return $this->getCart();
    }

    public function emptyCart()
    {
        Cart::destroy();

        return true;
    }

    public function getCart()
    {
        $cartRows = Cart::content();
        $subTotal = Cart::total();
        $discount = 0;
        $total = ($subTotal / 100) * $discount;

        $data = [
            'discount'   => $discount,
            'subTotal'   => $subTotal,
            'total'      => $total,
            'cartRows'   => $cartRows,
        ];

        return View::make('sessions.checkout')
            ->with('data', $data);

    }


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