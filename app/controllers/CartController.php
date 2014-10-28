<?php

class CartController extends \BaseController
{

    /**
     * @return $this
     *
     * Add a product to the Cart.
     * POST variables: product-id, [quantity]
     *
     * product-id is currently the session-id with a capital 'S' slapped on the front. (to be replaced with a hash)
     */
    public function add()
    {
        $productCode = Input::get('product-id', false);
        $quantity = Input::get('quantity', 1);

        $idArray = Static::fromProductCode($productCode);
        if( $idArray['type'] == 'session')
        {
            $sessionId = $idArray['id'];

            $session = Evercisesession::find($sessionId)->first();
            $evercisegroupId = $session->evercisegroup_id;

            $rowIds = Cart::search(['id' => $productCode]);

            if(count($rowIds)) // If product ID already exists in cart, then add to quantity.
            {
                $rowId = $rowIds[0];
                $row = Cart::get($rowId);
                $currentQuantity = $row->qty;
                $newQuantity = $currentQuantity + $quantity;
                Cart::update($rowId, $newQuantity);
            }
            else // Make a new entry in the cart, and link it to the session.
            {
                Cart::associate('Evercisesession')->add( $productCode, $session->evercisegroup->name, $quantity, $session->price,
                    [
                        'evercisegroupId' => $evercisegroupId,
                        'sessionId' => $sessionId,
                        'date_time' => $session->date_time
                    ]
                );

            }

        }
        else if( $idArray['type'] == 'package')
        {
            // Package has been added
        }
        else
        {
            return 'code does not exist :'.$productCode;
            // Product code type does not exist
        }
        return $this->getCart();
    }

    /**
     * @return $this
     *
     * Remove a specified quantity of a product from the Cart.  If quantity is not set, one will be removed
     * POST variables: product-id, [quantity]
     */
    public function remove()
    {
        $productCode = Input::get('product-id', false);
        $rowId = Cart::search(['id' => $productCode]);
        if ($rowId)
        {
            $quantity = Input::get('quantity', 1);

            $currentQuantity = Cart::get($rowId)->qty;
            $newQuantity = $currentQuantity - $quantity;
            if ($newQuantity > 0)
                Cart::update($rowId, $newQuantity);
            else
                Cart::remove($rowId);
        }

        return $this->getCart();
    }

    /**
     * @return $this
     *
     * Remove a product from the Cart, regardless of quantity
     * POST variables: product-id
     */
    public function delete()
    {
        $productCode = Input::get('product-id', false);
        $rowId = Cart::search(['id' => $productCode]);

        if ($rowId)
            Cart::remove($rowId);

        return $this->getCart();
    }

    /**
     * @return $this
     *
     * Empty everything from Cart
     */
    public function emptyCart()
    {
        Cart::destroy();

        return $this->getCart();
    }

    /**
     * @return $this
     *
     * Return Cart data formatted as an array
     */
    public function getCart()
    {
        $cartRows = Cart::content();
        $subTotal = Cart::total();
        $discount = 0;
        $total = ($subTotal / 100) * (100 - $discount);

        $data = [
            'discount'   => $discount,
            'subTotal'   => $subTotal,
            'total'      => $total,
            'cartRows'   => $cartRows,
        ];

        return 'nope';

        return $data;

        return View::make('sessions.checkout')
            ->with('data', $data);

    }


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