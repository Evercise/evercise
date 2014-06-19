<?php

class Wallet extends \Eloquent {
	protected $fillable = ['id', 'user_id', 'amount', 'previous_amount'];
}