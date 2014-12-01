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


    public function amountUsed($userpackage_id = 0) {
        return static::where('package_id', $userpackage_id)->where('status', 1)->count();
    }


    /**
     * Check if there is a User Package that can be used for the $session
     * @param $class
     * @param $user
     */
    public static function check(Evercisesession $session, $user)
    {



       $res = DB::table('packages')
            ->select(DB::raw('count(user_packages.id) as classes_count, user_packages.id as up_id, *'))
            ->join('user_packages', 'packages.id', '=', 'user_packages.package_id')
            ->join('user_package_classes', 'user_packages.id', '=', 'user_package_classes.package_id')
            ->where('user_packages.user_id', '=', $user->id)
            ->where('packages.max_class_price', '>=', $session->price)
            ->groupBy('user_packages.id')
            ->orderBy('packages.max_class_price', 'asc')
            ->get();

        foreach($res as $row) {
            if($row->classes_count > $row->classes) {
                return UserPackages::find($row->up_id);
            }
        }


        throw new \Exception('No Packages Found for User');

    }

}