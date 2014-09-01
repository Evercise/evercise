<?php  namespace events;

use Config;
use Mixpanel;
use Log;


class Tracking
{

    public function userRegistered($user)
    {
        $this->registerTracking($user, 'USER');
    }


    public function trainerRegistered($user)
    {
        $this->registerTracking($user, 'TRAINER');
    }

    public function userFacebookRegistered($user)
    {
        $this->registerTracking($user, 'FACEBOOK');
    }




    protected function registerTracking($user, $type = 'USER')
    {
        $mp = Mixpanel::getInstance(Config::get('mixpanel.token'));

        $user_arr = $user->toArray();

        Log::info($user_arr);

        $exclude = [
            'id',
            'password',
            'permissions',
            'activated',
            'activation_code',
            'created_at',
            'updated_at',
            'directory',
            'image',
            'remember_token',
            'categories'
        ];

        foreach ($exclude as $e) {
            if (isset($user_arr[$e])) {
                unset($user_arr[$e]);
            }
        }

        foreach($user_arr as $key => $val) {
            $user_arr['$'.$key] = $val;
            unset($user_arr[$key]);
        }

        $user_arr['type'] = $type;

        $mp->people->set($user->id, $user_arr);
        $mp->identify($user->id);
        $mp->track($type . " Registered");

        Log::info($type . ' ' . $user->id . ' created in MixPanel');
        Log::info($user_arr);
    }
}