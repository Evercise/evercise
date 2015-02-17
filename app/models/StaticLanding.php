<?php

/**
 * Class Landing
 */
class StaticLanding extends \Eloquent
{
    /**
     * @var array
     *
     * email can be removed
     */
    protected $fillable = ['id', 'user_id', 'email', 'code', 'category_id', 'location', 'amount'];

    /**
     * @var string
     */
    protected $table = 'static_landings';

    /**
     * Check if the Landing code is correct
     *
     * @param $lc
     * @return int
     */
    public static function checkLandingCode($lc)
    {
        $landingCode = 0;
        if (!is_null($lc)) {
            if (!is_null(static::where('code', $lc)->first())) {
                $landingCode = $lc;
            }
        }
        return $landingCode;
    }

    /**
     * Use Provided Landing Code
     *
     * @param $lc
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Model|int|null|static
     */
    public static function useLandingCode($lc, $user_id)
    {
        $staticLanding = 0;
        if (static::checkLandingCode($lc)) {
            $staticLanding = static::where('code', $lc)->first();
            //$landing->update(['code' => '', 'user_id' => $user_id]);
        }
        return $staticLanding;
    }
}