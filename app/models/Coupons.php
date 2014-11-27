<?php

class Coupons extends Eloquent
{

    protected $table = 'coupons';
    protected $fillable = [
        'id',
        'usage',
        'coupon',
        'description',
        'type',
        'amount',
        'package_id',
        'expires_at',
        'active_from'
    ];


    public static function check($coupon = false)
    {

        if (!$coupon) {
            return false;
        }

        return static::where('coupon', $coupon)
            ->where('usage', '>', 0)
            ->where('expires_at', '>', date('Y-m-d H:i:s'))
            ->where('active_from', '<', date('Y-m-d H:i:s'))
            ->first();


    }

    public static function processCoupon($coupon, $user)
    {

        if($coupon = self::check($coupon)) {
            $coupon->decrement('usage');
            Event::fire('activity.user.coupon', [$coupon, $user]);

            return $coupon->id;
        }

        return false;

    }


}