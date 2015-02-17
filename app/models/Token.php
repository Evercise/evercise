<?php

/**
 * Class Token
 */
class Token extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array('id', 'user_id', 'facebook', 'twitter');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tokens';

    /**
     * Add Token
     *
     * @param $name
     * @param $token
     */
    public function addToken($name, $token)
    {
        $tokenJSON = json_encode($token);
        if (!$this->attributes[$name]) {
            $milestone = Milestone::where('user_id', $this->attributes['user_id'])->first();
            $milestone->add($name);
        }
        $this->update([$name => $tokenJSON]);


    }

    /**
     * Create Facebook Token
     *
     * @param $getUser
     * @return array
     */
    public static function makeFacebookToken($getUser)
    {
        $profileId = $getUser['user_profile']['id'];
        $accessToken = $getUser['access_token'];

        if (! Token::where('facebook', 'LIKE', '%'.$profileId.'%')->get()->isEmpty())
        {
            // Facebook user has already been registered with Evercise
            return false;
        }

        $facebookTokenArray = [
            'id'           => $profileId,
            'access_token' => $accessToken
        ];
        return $facebookTokenArray;
    }

    public function hasValidFacebookToken()
    {
        return (!empty($this->facebook) ? true : false);
    }

    public function hasValidTwitterToken()
    {
        return (!empty($this->twitter) ? true : false);
    }

    public static function createIfDoesntExist($user_id)
    {
        if (static::where('user_id', $user_id)->first())
            return false;

        $token = static::firstOrCreate([
            'user_id'=>$user_id,
        ]);

        return $token;
    }
}