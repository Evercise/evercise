<?php  namespace events;

use Mixpanel;
use Illuminate\Config\Repository;
use Illuminate\Log\Writer;


class Tracking
{

    protected $mixpanel = false;
    protected $config;
    protected $log;

    public function __construct(Writer $log, Repository $config)
    {
        $this->config = $config;
        $this->log = $log;
        $this->mixpanel = Mixpanel::getInstance($this->config->get('mixpanel.token'));

    }

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


    public function userLogin($user)
    {
        $this->registerTracking($user, 'USER');
    }

    public function userFacebookLogin($user)
    {
        $this->registerTracking($user, 'FACEBOOK');
    }


    protected function loginTracking($user, $type = 'USER')
    {
        $this->mixpanel->people->increment($user->id, "login count", 1);
        $this->mixpanel->identify($user->id);
        $this->mixpanel->track('LOGGED IN', ['type' => $type]);
    }


    protected function registerTracking($user, $type = 'USER')
    {

        $user_arr = $user->toArray();

        $this->log->info($user_arr);

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

        foreach ($user_arr as $key => $val) {
            $user_arr['$' . $key] = $val;
            unset($user_arr[$key]);
        }


        $user_arr['type'] = $type;
        $user_arr['evercoins'] = (is_null($user->evecoin) ? '0' : $user->evecoin->balance);


        $this->mixpanel->people->set($user->id, $user_arr);
        $this->mixpanel->identify($user->id);
        $this->mixpanel->track('REGISTERED', ['type' => $type]);

        $this->log->info($type . ' ' . $user->id . ' created in MixPanel');
        $this->log->info($user_arr);
    }
}