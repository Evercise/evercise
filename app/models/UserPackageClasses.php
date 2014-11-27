<?php

/**
 * Class UserPackageClasses
 */
class UserPackageClasses extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'user_package_id', 'status'];

    /**
     * @var string
     */
    protected $table = 'user_package_classes';



    public function user() {

        return $this->belongsTo('User', 'user_id');
    }

    public function package() {

        return $this->belongsTo('UserPackage', 'user_package_id');
    }


}