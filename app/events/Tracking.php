<?php  namespace events;

use Mixpanel;
use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Http\Request;


/**
 * Class Tracking
 * @package events
 */
class Tracking
{

    /**
     * @var bool|Mixpanel
     */
    protected $mixpanel = false;
    /**
     * @var Repository
     */
    protected $config;
    /**
     * @var Writer
     */
    protected $log;

    /**
     * @param Writer $log
     * @param Repository $config
     */
    public function __construct(Writer $log, Repository $config, Request $request)
    {
        $this->config = $config;
        $this->log = $log;
        $this->request = $request;
        $this->mixpanel = Mixpanel::getInstance($this->config->get('mixpanel.token'));

    }

    /**
     * @param $user
     */
    public function userRegistered($user)
    {
        $this->registerTracking($user, 'USER');
    }


    /**
     * @param $user
     */
    public function trainerRegistered($user)
    {
        $this->registerTracking($user, 'TRAINER');
    }

    /**
     * @param $user
     */
    public function userFacebookRegistered($user)
    {
        $this->registerTracking($user, 'FACEBOOK');
    }


    /**
     * @param $user
     */
    public function userLogin($user)
    {
        $this->registerTracking($user, 'USER');
    }

    /**
     * @param $user
     */
    public function userFacebookLogin($user)
    {
        $this->registerTracking($user, 'FACEBOOK');
    }

    /**
     * @param $user
     */
    public function userEdit($user)
    {
        $this->registerTracking($user, 'USER', 'EDIT');
    }

    /**
     * @param $user
     */
    public function trainerEdit($user)
    {
        $this->registerTracking($user, 'TRAINER', 'EDIT');
    }

    /**
     * @param $user
     */
    public function userChangePassword($user)
    {
        $this->mixpanel->identify($user->id);
        $this->mixpanel->track('PASSWORD CHANGE');
    }

    /**
     * @param $user
     */
    public function userLogout($user)
    {
        $this->mixpanel->identify($user->id);
        $this->mixpanel->track('LOGOUT');
    }


    /**
     * @param $user
     * @param string $type
     */
    protected function loginTracking($user, $type = 'USER')
    {
        $this->mixpanel->people->increment($user->id, "login count", 1);
        $this->mixpanel->identify($user->id);
        $this->mixpanel->track('LOGGED IN', ['type' => $type]);
    }


    /**
     * @param $user
     * @param string $type
     * @param string $func
     */
    protected function registerTracking($user, $type = 'USER', $func = 'REGISTER')
    {

        $user_arr = $user->toArray();

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


        $user_arr['$type'] = $type;
        $user_arr['$evercoins'] = (is_null($user->evecoin) ? '0' : $user->evecoin->balance);
        $user_arr['$ip'] = $this->request->getClientIp();


        $this->mixpanel->people->set($user->id, $user_arr);
        $this->mixpanel->identify($user->id);
        $this->mixpanel->track($func, ['type' => $type]);

        $this->log->info($type . ' ' . $user->id . ' ' . $func . ' in MixPanel');
    }
}