<?php
 
class Coupons extends Eloquent {

    protected $table = 'coupons';
    protected $fillable = ['id', 'usage','coupon','description','type','amount','package_id','expires_at','active_from'];


    public static function check($coupon) {



    }
    
}