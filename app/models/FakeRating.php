<?php

class FakeRating extends \Eloquent {
	
  protected $fillable = array('id', 'user_id', 'evercisegroup_id', 'stars', 'comment');

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'fakeratings';

  /* the user that rated this class */
  public function rator()
  {
      return $this->belongsTo('User' , 'user_id');
  }    

  public function evercisegroup()
  {
      return $this->belongsTo('evercisegroup' , 'evercisegroup_id');
  }
}