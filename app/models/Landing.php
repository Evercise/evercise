<?php

class Landing extends \Eloquent {
  protected $fillable = array('id', 'user_id', 'email', 'code', 'category_id');

  protected $table = 'landings';

  public static function checkLandingCode($lc)
  {
    $landingCode = 0;
    if( ! is_null($lc))
    {
      if ( ! is_null(Landing::where('code', $lc)->first()))
      {
        $landingCode = $lc;
      }
    }
    return $landingCode;
  }
  public static function useLandingCode($lc, $user_id)
  {
    $landing = 0;
    if(Landing::checkLandingCode($lc))
    {
      $landing = Landing::where('code', $lc)->first();
      $landing->update(['code' => '', 'user_id' => $user_id]);
    }
    return $landing;
  }
}