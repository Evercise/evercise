<?php

/**
 * Class Landing
 */
class Landing extends \Eloquent
{
    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'email', 'code', 'category_id', 'location'];

    /**
     * @var string
     */
    protected $table = 'landings';

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
            if (!is_null(Landing::where('code', $lc)->first())) {
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
        $landing = 0;
        if (Landing::checkLandingCode($lc)) {
            $landing = Landing::where('code', $lc)->first();
            $landing->update(['code' => '', 'user_id' => $user_id]);
        }
        return $landing;
    }
}