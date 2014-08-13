<?php

class Landing extends \Eloquent {
  protected $fillable = array('id', 'user_id', 'email', 'code', 'category_id');

  protected $table = 'landings';
}