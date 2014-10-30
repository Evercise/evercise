<?php namespace ajax;
use Input, EverciseCart, Evercisesession, Response, View;

class CartController extends AjaxBaseController
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

        $idArray = EverciseCart::fromProductCode($productCode);

        if( $idArray['type'] == 'session')
        {
            $sessionId = $idArray['id'];

            // needs fixing - this is grabbing the first class, couls of thought you need find in as the id is in a array
            $session = Evercisesession::find($sessionId);
            $evercisegroupId = $session->evercisegroup_id;

            $rowIds = EverciseCart::search(['id' => $productCode]);

            if($rowIds[0]) // If product ID already exists in cart, then add to quantity.
            {
                $rowId = $rowIds[0];
                $row = EverciseCart::get($rowId);
                $currentQuantity = $row->qty;
                $newQuantity = $currentQuantity + $quantity;
                EverciseCart::update($rowId, $newQuantity);
            }
            else // Make a new entry in the cart, and link it to the session.
            {
                EverciseCart::associate('Evercisesession')->add( $productCode, $session->evercisegroup->name, $quantity, $session->price,
                    [
                        'evercisegroupId' => $evercisegroupId,
                        'sessionId' => $sessionId,
                        'date_time' => $session->date_time,
                        'available' => $session->remainingTickets()
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
        $rowId = EverciseCart::search(['id' => $productCode]);
        if ($rowId)
        {
            $quantity = Input::get('quantity', 1);

            $currentQuantity = EverciseCart::get($rowId[0])->qty;
            $newQuantity = $currentQuantity - $quantity;
            if ($newQuantity > 0)
                EverciseCart::update($rowId[0], $newQuantity);
            else
                EverciseCart::remove($rowId[0]);
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
        $rowId = EverciseCart::search(['id' => $productCode]);

        if ($rowId)
            EverciseCart::remove($rowId[0]);

        return $this->getCart();
    }

    /**
     * @return $this
     *
     * Empty everything from Cart
     */
    public function emptyCart()
    {
        EverciseCart::destroy();

        return $this->getCart();
    }

    /**
     * @return $this
     *
     * Return Cart data formatted as an array
     */
    public function getCart()
    {
        $data = EverciseCart::getCart();

        return Response::json([ 'view' => View::make('v3.cart.dropdown')->with($data)->render() ]);
    }



}