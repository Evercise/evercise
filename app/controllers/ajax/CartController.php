<?php namespace ajax;

use Coupons;
use Input, EverciseCart, Evercisesession, Response, View;
use Packages;
use Session;

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
        $productCode = Input::get('product-id', FALSE);
        $quantity = Input::get('quantity', 1);
        $force = Input::get('force', FALSE);
        $noCart = Input::get('noCart', FALSE);
        $refreshPage = Input::get('refresh-page', FALSE);

        $idArray = EverciseCart::fromProductCode($productCode);


        if ($idArray['type'] == 'session') {
            $sessionId = $idArray['id'];

            // needs fixing - this is grabbing the first class, couls of thought you need find in as the id is in a array
            $session = Evercisesession::find($sessionId);
            $evercisegroupId = $session->evercisegroup_id;

            $rowIds = EverciseCart::search(['id' => $productCode]);

            if ($rowIds[0]) // If product ID already exists in cart, then add to quantity.
            {
                $rowId = $rowIds[0];
                $row = EverciseCart::get($rowId);
                $currentQuantity = $row->qty;


                $newQuantity = (!$force ? $currentQuantity + $quantity : $quantity);

                if ($newQuantity > $session->remainingTickets()) {
                    return Response::json([
                        'validation_failed' => 1,
                        'errors'            => ['custom' => 'We only have ' . $session->remainingTickets() . ' ticket' . ($session->remainingTickets() > 1 ? 's' : '') . ' available for this class']
                    ]);
                }
                EverciseCart::update($rowId, $newQuantity);

            } else // Make a new entry in the cart, and link it to the session.
            {
                EverciseCart::associate('Evercisesession')->add($productCode, $session->evercisegroup->name, $quantity,
                    $session->price,
                    [
                        'evercisegroupId' => $evercisegroupId,
                        'sessionId'       => $sessionId,
                        'date_time'       => $session->date_time,
                        'available'       => $session->remainingTickets()
                    ]
                );
            }
        } else {
            if ($idArray['type'] == 'package') {
                // Package has been added
                $packageId = $idArray['id'];

                $package = Packages::find($packageId);

                $rowIds = EverciseCart::search(['id' => $productCode]);

                if ($rowIds[0]) // If product ID already exists in cart, then add to quantity.
                {
                    $rowId = $rowIds[0];
                    $row = EverciseCart::get($rowId);
                    $currentQuantity = $row->qty;
                    $newQuantity = $currentQuantity + $quantity;
                    EverciseCart::update($rowId, $newQuantity);
                } else // Make a new entry in the cart, and link it to the session.
                {
                    EverciseCart::associate('Packages')->add($productCode, $package->name, $quantity, $package->price,
                        ['style' => $package->style]);
                }


            } else {
                if ($idArray['type'] == 'topup') {
                    $amount = Input::get('amount', 0);

                    if ($amount < 1) {
                        return Response::json([
                            'validation_failed' => 1,
                            'errors'            => ['custom' => 'Amount too small']
                        ]);
                    }

                    EverciseCart::clearTopup();
                    EverciseCart::instance('topup')->add($idArray['id'], 'top up', 1, $amount, []);
                } else {
                    if ($idArray['type'] == 'wallet_payment') {
                        $amount = Input::get('amount', 0);

                        if ($amount > \Sentry::getUser()->wallet->balance) {
                            // Not enough credit in wallet.

                        }

                        EverciseCart::instance('topup')->add($idArray['id'], 'top up', 1, $amount, []);
                    } else {
                        return 'code does not exist :' . $productCode;
                        // Product code type does not exist
                    }
                }
            }
        }

        if ($refreshPage) {
            return Response::json(
                [
                    'refresh' => TRUE
                ]
            );
        } else {
            return $this->getCart();
        }

    }


    /**
     * @return $this
     *
     * Remove a specified quantity of a product from the Cart.  If quantity is not set, one will be removed
     * POST variables: product-id, [quantity]
     */
    public function remove()
    {
        $productCode = Input::get('product-id', FALSE);
        $rowId = EverciseCart::search(['id' => $productCode]);
        $refreshPage = Input::get('refresh-page', FALSE);
        if ($rowId) {
            $quantity = Input::get('quantity', 1);

            $currentQuantity = EverciseCart::get($rowId[0])->qty;
            $newQuantity = $currentQuantity - $quantity;
            if ($newQuantity > 0) {
                EverciseCart::update($rowId[0], $newQuantity);
            } else {
                EverciseCart::remove($rowId[0]);
            }
        }

        if ($refreshPage) {
            return Response::json(
                [
                    'refresh' => TRUE
                ]
            );
        } else {
            return $this->getCart();
        }
    }

    /**
     * @return $this
     *
     * Remove a product from the Cart, regardless of quantity
     * POST variables: product-id
     */
    public function delete()
    {
        $productCode = Input::get('product-id', FALSE);
        $rowId = EverciseCart::search(['id' => $productCode]);
        $refreshPage = Input::get('refresh-page', FALSE);
        $product = EverciseCart::fromProductCode($productCode);

        if ($rowId) {
            if ($product['type'] == 'package') {

                $currentQuantity = EverciseCart::get($rowId[0])->qty;
                $newQuantity = $currentQuantity - 1;
                if ($newQuantity > 0) {
                    EverciseCart::update($rowId[0], $newQuantity);
                } else {
                    EverciseCart::remove($rowId[0]);
                }
            } else {
                EverciseCart::remove($rowId[0]);
            }
        }


        if ($refreshPage) {
            return Response::json(
                [
                    'refresh' => TRUE
                ]
            );
        } else {
            return $this->getCart();
        }
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
        $coupon = Session::get('coupon', FALSE);

        $data = EverciseCart::getCart($coupon);

        return Response::json([
            'view'      => View::make('v3.cart.dropdown')->with($data)->render(),
            'remaining' => $this->setRemaining($data),
            'items'     => count($data['sessions_grouped'])+ count($data['packages'])
        ]);
    }

    public function cartData()
    {
        $coupon = Session::get('coupon', FALSE);

        $data = EverciseCart::getCart($coupon);


        return Response::json(
            [
                'data' => $data
            ]
        );
    }


    public function applyCoupon()
    {
        $coupon = Coupons::check(Input::get('coupon', FALSE));
        $res = ['cart' => EverciseCart::getCart(), 'success' => FALSE];
        if ($coupon) {
            Session::put('coupon', $coupon->coupon);
            $res['success'] = TRUE;
            $res['coupon'] = [
                'coupon'      => $coupon->coupon,
                'type'        => $coupon->type,
                'amount'      => $coupon->amount,
                'percentage'  => $coupon->percentage,
                'description' => $coupon->description
            ];
        }

        return Response::json($res);

    }

    private function setRemaining($data)
    {
        $remaining = [];

        foreach ($data['sessions_grouped'] as $id => $val) {
            $remaining[$id] = $val['tickets_left'];
        }

        return $remaining;

    }


}