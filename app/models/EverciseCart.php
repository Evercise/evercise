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
        switch ($type) {
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
        if (count($chunks = explode('S', $productCode)) > 1) {
            $type = 'session';
            if (count($chunks) < 2) {
                return false;
            }
            $id = $chunks[1];
        } else {
            if (count($chunks = explode('P', $productCode)) > 1) {
                $type = 'package';
                if (count($chunks) < 2) {
                    return false;
                }
                $id = $chunks[1];
            } else {
                if (count($chunks = explode('T', $productCode)) > 1) {

                    $type = 'topup';
                    $id = 'TOPUP';
                } else {
                    Log::error('Something is wrong here with product code ' . $productCode);

                    return false;
                }
            }
        }
        return ['id' => $id, 'type' => $type];
    }

    /**
     * @return $this
     *
     * Return Cart data formatted as an array
     */
    public static function getCart($coupon = false)
    {


        $cartRows = parent::instance('main')->content();
        $subTotal = parent::total();
        $discount = 0;
        $total = ($subTotal / 100) * (100 - $discount);

        $data = [
            'discount' => $discount,
            'subTotal' => $subTotal,
            'total' => $total,
            'cartRows' => $cartRows,
        ];


        return $data;


    }


    public static function getCartContents($coupon = false)
    {

        $cartRows = parent::instance('main')->content();
        $subTotal = parent::total();


        $user = Sentry::getUser();

        $packages = [];
        if (!empty($user->id)) {
            foreach ($user->packages as $p) {
                $package = $p->package->toArray();
                $package['available'] = ($p->package()->first()->classes - $p->classes()->count());

                $packages[] = $package;
            };
        }


        /** Get all packages that exist in Cart */

        $cart_packages = [];
        $sessions = [];
        foreach ($cartRows as $row) {

            $code = EverciseCart::fromProductCode($row['id']);

            switch ($code['type']) {
                case 'package':
                    for ($i = 0; $i < $row->qty; $i++) {
                        $package = Packages::find($code['id'])->toArray();
                        $package['available'] = $package['classes'];
                        $package['cart_id'] = $row['id'];
                        $cart_packages[] = $package;
                    }
                    break;

                case 'session':
                    for ($i = 0; $i < $row->qty; $i++) {
                        $sessions[] = Evercisesession::find($code['id'])->toArray();
                    }
                    break;
            }
        }

        /** run All the Classes and Deduct from Package */

        $s = 0;
        $package_deduct = 0;
        foreach ($sessions as $session) {
            $sessions[$s]['package'] = 0;

            $package_used = false;

            /** DB packages First  */
            $i = 0;
            foreach ($packages as $package) {
                if ($package['max_class_price'] >= $s['price'] && $package['available'] > 0 && !$package_used) {
                    $sessions[$s]['package'] = $package['id'];
                    $packages[$i]['available']--;
                    $package_deduct += $session['price'];
                    $package_used = true;
                }
                $i++;
            }

            /** Cart Packages  */
            $i = 0;
            foreach ($cart_packages as $package) {
                if ($package['max_class_price'] >= $s['price'] && $package['available'] > 0 && !$package_used) {
                    $sessions[$s]['package'] = $package['id'];
                    $cart_packages[$i]['available']--;
                    $package_deduct += $session['price'];
                    $package_used = true;
                }
                $i++;
            }

            $s++;
        }

        /** Combine Back the Cart and figure things out */
        $cart = [];

        $cart['packages'] = $cart_packages;
        $cart['sessions'] = $sessions;
        $cart['total']['subtotal'] = $subTotal;
        $cart['total']['package_deduct'] = $package_deduct;
        $cart['total']['final_cost'] = ($subTotal-$package_deduct);


        $cart['discount'] = [];

        /** Check Coupon */

        if($coupon) {

            $coupon = Coupons::where('coupon', $coupon)
                ->where('usage', '>', 0)
                ->where('expires_at', '>', date('Y-m-d H:i:s'))
                ->where('active_from', '<', date('Y-m-d H:i:s'))
                ->first();



            if(!empty($coupon->id)) {

                $cart['discount'] = [
                    'type' => $coupon->type,
                    'description' => $coupon->description
                ];

                switch($coupon->type) {
                    case 'percentage':
                        $cart['discount']['new_total'] = round(($cart['total']['final_cost'] / 100) * (100 - $coupon->percentage), 2);
                        $cart['discount']['amount'] = round(($cart['total']['final_cost'] / 100) * $coupon->percentage, 2);
                        break;
                    case 'amount':
                        $cart['discount']['new_total'] = round($cart['total']['final_cost'] - $coupon->amount, 2);
                        $cart['discount']['amount'] = round($coupon->amount, 2);
                        break;
                }

                if($cart['discount']['new_total'] < 0) {
                    $cart['discount']['new_total'] = 0;
                }
                if($cart['discount']['amount'] < 0) {
                    $cart['discount']['amount'] = 0;
                }


                $cart['total']['final'] = ($cart['discount']['new_total']);
            }

        }


        return $cart;

        /**
        $i = 0;
        foreach ($cart_packages as $p) {
            if (count($cart['packages']) == 0) {
                $p['qty'] = 1;
                $cart['packages'][] = $p;
            } else {
                //Update  QTY on this row
                $cp = 0;
                $added = false;
                foreach ($cart['packages'] as $pac) {
                    if ($pac['id'] == $p['id']) {
                        $cart['packages'][$cp]['qty']++;
                        $added = true;
                    }
                    $cp++;
                }

                if (!$added) {
                    $p['qty'] = 1;
                    $cart['packages'][] = $p;
                }
            }

        }
          $i */

    }

    public static function clearTopup()
    {
        $cartRowIds = EverciseCart::instance('topup')->search(['id' => 'TOPUP']);
        if ($cartRowIds) {
            foreach ($cartRowIds as $cartRowId) {
                EverciseCart::instance('topup')->remove($cartRowId);
            }
        }
    }

    public static function clearWalletPayment()
    {
        $cartRowIds = EverciseCart::instance('topup')->search(['id' => 'WALLET']);
        if ($cartRowIds) {
            foreach ($cartRowIds as $cartRowId) {
                EverciseCart::instance('topup')->remove($cartRowId);
            }
        }
    }

    public static function clearCart()
    {
        EverciseCart::instance('main')->destroy();
    }

    public static function getWalletPayment()
    {
        $walletPaymentIds = EverciseCart::instance('topup')->search(['id' => 'WALLET']);

        if (count($walletPaymentIds) > 0) {
            $cartRow = EverciseCart::instance('topup')->get($walletPaymentIds[0]);
            if ($cartRow) {
                return $cartRow->price;
            }
        }
        return 0;
    }

}