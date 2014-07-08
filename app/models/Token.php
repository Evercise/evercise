<?php

class Token extends \Eloquent {

	protected $fillable = array('id', 'user_id', 'facebook', 'twitter');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tokens';

	public function addToken($name, $value)
	{
		if (! $this->attributes[$name])
		{
			Milestone::where('user_id', Sentry::getUser()->id)->first()->add($name);
		}
		$this->update([$name => $value]);


	}
}