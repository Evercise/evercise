<?php

class Token extends \Eloquent {

	protected $fillable = array('id', 'user_id', 'facebook', 'twitter');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tokens';

	public function addToken($name, $token)
	{
		$tokenJSON = json_encode($token);
		if (! $this->attributes[$name])
		{
			$milestone = Milestone::where('user_id', $this->attributes['id'])->first();
			$milestone->add($name);
		}
		$this->update([$name => $tokenJSON]);


	}
	public static function makeFacebookToken($getUser)
	{
		$facebookTokenArray = [
			'id' => $getUser['user_profile']['id'],
			'access_token' => $getUser['access_token']
		];
		return $facebookTokenArray;
	}
}