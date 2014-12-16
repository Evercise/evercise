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
                return FALSE;
            }
            $id = $chunks[1];
        } else {
            if (count($chunks = explode('P', $productCode)) > 1) {
                $type = 'package';
                if (count($chunks) < 2) {
                    return FALSE;
                }
                $id = $chunks[1];
            } else {
                if (count($chunks = explode('T', $productCode)) > 1) {

                    $type = 'topup';
                    $id = 'TOPUP';
                } else {
                    Log::error('Something is wrong here with product code ' . $productCode);

                    return FALSE;
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
    public static function getCartOLD($coupon = FALSE)
    {


        $cartRows = parent::instance('main')->content();
        $subTotal = parent::total();
        $discount = 0;
        $total = ($subTotal / 100) * (100 - $discount);

        $data = [
            'discount' => $discount,
            'subTotal' => $subTotal,
            'total'    => $total,
            'cartRows' => $cartRows,
        ];


        return $data;


    }


    public static function getCart($coupon = FALSE)
    {

        $cart = [];

        $cart['wallet'] = 0;


        $cartRows = parent::instance('main')->content();

        $subTotal = parent::total();

        $user = Sentry::getUser();

        $packages = [];

        if (!empty($user->id)) {
            foreach ($user->packages as $p) {
                if(count($p->package)) {
                    $package = $p->package->toArray();
                    $package['available'] = ($p->package()->first()->classes - $p->classes()->count());
                    $package['package_id'] = $package['id'];
                    $package['id'] = $p->id;
                    $packages[] = $package;
                }
            };

            $cart['wallet'] = $user->getWallet()->getBalance();
        }

        /** Get all packages that exist in Cart */

        $cart_packages = [];
        $sessions = [];

        $objects = [];
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

                        if(!empty($objects['sessions'][$code['id']])) {
                            $session = $objects['sessions'][$code['id']];
                        } else {
                            $session = Evercisesession::find($code['id']);
                            $objects['sessions'][$code['id']] = $session;
                        }


                        if(!empty($session->id)) {
                            $remaining_tickets = $session->remainingTickets();
                            $slug = $session->evercisegroup->slug;
                            $session = $session->toArray();
                            $session['tickets'] = $remaining_tickets;
                            $session['slug'] = $slug;

                            unset($session['sessionmembers']);
                            $sessions[] = $session;
                        }
                    }
                    break;
            }
        }


        /** run All the Classes and Deduct from Package */

        $s = 0;
        $package_deduct = 0;
        foreach ($sessions as $session) {
            $sessions[$s]['package'] = 0;
            $sessions[$s]['cart_id'] = $session['id'];

            if(!empty($objects['groups'][$session['evercisegroup_id']])) {
                $evercisegroup = $objects['groups'][$session['evercisegroup_id']];
            } else {
                $evercisegroup = Evercisegroup::find($session['evercisegroup_id']);
                $objects['groups'][$session['evercisegroup_id']] = $evercisegroup;
            }

            $sessions[$s]['name'] = $evercisegroup->name;

            $package_used = FALSE;

            /** DB packages First  */
            $i = 0;


            foreach ($packages as $package) {

                if ($package['max_class_price'] >= $session['price'] && $packages[$i]['available'] > 0 && !$package_used) {
                    $sessions[$s]['package'] = $package['id'];
                    $packages[$i]['available']--;
                    $package_deduct += $session['price'];
                    $package_used = TRUE;
                }
                $i++;
            }


            /** Cart Packages  */
            $i = 0;

            foreach ($cart_packages as $package) {

                if ($package['max_class_price'] >= $session['price'] && $cart_packages[$i]['available'] > 0 && $sessions[$s]['package'] == 0) {

                    $sessions[$s]['package'] = $package['id'];
                    $cart_packages[$i]['available']--;
                    $package_deduct += $session['price'];
                    $package_used = TRUE;
                }
                $i++;
            }


            $s++;
        }

        /** Group Session IDs to display Quantities */
        $cart['sessions_grouped'] = [];
        foreach ($sessions as $s) {
            if (!empty($cart['sessions_grouped'][$s['id']]['qty'])) {
                $cart['sessions_grouped'][$s['id']]['qty']++;
             //   $cart['sessions_grouped'][$s['id']]['tickets_left']--;
                $cart['sessions_grouped'][$s['id']]['grouped_price'] += $s['price'];
                if ($s['package'] == 0) {
                    $cart['sessions_grouped'][$s['id']]['grouped_price_discount'] += $s['price'];
                }
            } else {
                $cart['sessions_grouped'][$s['id']] = $s;
                $cart['sessions_grouped'][$s['id']]['qty'] = 1;
             //   $cart['sessions_grouped'][$s['id']]['tickets_left'] = $s['tickets'] - 1;
                $cart['sessions_grouped'][$s['id']]['tickets_left'] = $s['tickets'];
                $cart['sessions_grouped'][$s['id']]['grouped_price'] = $s['price'];
                $cart['sessions_grouped'][$s['id']]['grouped_price_discount'] = 0;
                if ($s['package'] == 0) {
                    $cart['sessions_grouped'][$s['id']]['grouped_price_discount'] = $s['price'];
                }
            }
        }

        /** Combine Back the Cart and figure things out */

        $cart['packages'] = $cart_packages;
        $cart['sessions'] = $sessions;
        $cart['total']['subtotal'] = $subTotal;
        $cart['total']['package_deduct'] = $package_deduct;
        $cart['total']['from_wallet'] = 0;
        $cart['total']['final_cost'] = ($subTotal - $package_deduct);

        if ($cart['wallet'] > 0) {
            if ($cart['wallet'] > $cart['total']['final_cost']) {
                $cart['total']['from_wallet'] = $cart['total']['final_cost'];
                $cart['total']['final_cost'] = 0;
            } else {
                $cart['total']['from_wallet'] = $cart['wallet'];
                $cart['total']['final_cost'] = ($cart['total']['final_cost'] - $cart['wallet']);
            }
        }

        $cart['discount'] = [];

        /** Check Coupon */

        if ($coupon) {

            $coupon = Coupons::check($coupon);


            if (!empty($coupon->id)) {

                $cart['discount'] = [
                    'type'        => $coupon->type,
                    'percentage'  => $coupon->percentage,
                    'amount'      => $coupon->amount,
                    'description' => $coupon->description
                ];

                switch ($coupon->type) {
                    case 'percentage':
                        $cart['discount']['new_total'] = round(($cart['total']['final_cost'] / 100) * (100 - $coupon->percentage),
                            2);
                        $cart['discount']['amount'] = round(($cart['total']['final_cost'] / 100) * $coupon->percentage,
                            2);
                        break;
                    case 'amount':
                        $cart['discount']['new_total'] = round($cart['total']['final_cost'] - $coupon->amount, 2);
                        $cart['discount']['amount'] = round($coupon->amount, 2);
                        break;
                }

                if ($cart['discount']['new_total'] < 0) {
                    $cart['discount']['new_total'] = 0;
                }
                if ($cart['discount']['amount'] < 0) {
                    $cart['discount']['amount'] = 0;
                }


                $cart['total']['final_cost'] = ($cart['discount']['new_total']);
            }

        }

        return $cart;


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

    public static function clearCart()
    {
        EverciseCart::instance('main')->destroy();
    }


}