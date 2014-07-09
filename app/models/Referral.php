<?php

class Referral extends \Eloquent {

	protected $fillable = array('id', 'user_id', 'email', 'code', 'referee_id');

	protected $table = 'referrals';
}