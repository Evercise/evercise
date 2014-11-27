<?php

/**
 * Class UserPackages
 */
class UserPackages extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'package_id', 'user_id'];

    /**
     * @var string
     */
    protected $table = 'user_packages';


    public function user()
    {

        return $this->belongsTo('User', 'user_id');
    }

    public function package()
    {

        return $this->belongsTo('Packages');
    }

    public function classes()
    {

        return $this->hasMany('UserPackageClasses', 'id', 'user_package_id');
    }

    public static function addTemp($package_id, $user_id)
    {
        return static::create(['package_id' => $package_id, 'user_id' => $user_id]);
    }


    /**
     * Check if there is a User Package that can be used for the $session
     * @param $class
     * @param $user
     */
    public static function check(Evercisesession $session, $user)
    {
        /** OLD NOT USED */
        return DB::table('user_packages')
            ->join('packages', 'packages.id', '=', 'user_packages.package_id')
            ->where('packages.max_class_price', '>=', $session->price)
            ->orderBy('packages.max_class_price', 'asc')
            ->first();

    }

}