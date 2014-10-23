<?php  namespace events;

use Davispeixoto\LaravelSalesforce\Facades\Salesforce;
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

    }

    /**
     * @param $user
     */
    public function userRegistered($user)
    {
        $this->registerUserTracking($user, 'USER');
    }


    /**
     * @param $user
     */
    public function trainerRegistered($user)
    {
        $this->registerUserTracking($user, 'TRAINER');
    }

    /**
     * @param $user
     */
    public function userFacebookRegistered($user)
    {
        $this->registerUserTracking($user, 'FACEBOOK');
    }


    /**
     * @param $user
     */
    public function userLogin($user)
    {
        $this->registerUserTracking($user, 'USER', 'LOGIN');
    }

    /**
     * @param $user
     */
    public function userFacebookLogin($user)
    {
        $this->registerUserTracking($user, 'FACEBOOK', 'LOGIN');
    }

    /**
     * @param $user
     */
    public function userEdit($user)
    {
        $this->registerUserTracking($user, 'USER', 'EDIT');
    }

    /**
     * @param $user
     */
    public function trainerEdit($user)
    {
        $this->registerUserTracking($user, 'TRAINER', 'EDIT');
    }

    /**
     * @param $user
     */
    public function userChangePassword($user)
    {

    }

    /**
     * @param $user
     */
    public function userLogout($user)
    {

    }


    public function userClassSignup($user, $session)
    {
        return $this->registerUserSessionTracking($user, $session);
    }


    /**
     * @param $user
     * @param string $type
     * @param string $func
     */
    public function registerUserTracking($user, $type = 'USER', $func = 'REGISTER')
    {

        $user_arr = $user->toArray();

        $user_object = $this->formatUser($user, $type);


        if ($func != 'REGISTER') {
            if (empty($user->salesforce_id)) {
                $func = 'REGISTER';
            }
        }


        switch ($func) {
            case "REGISTER":
                $res = Salesforce::create([$user_object], 'Contact');
                $user->salesforce_id = $res[0]->id;
                $user->save();
            case "EDIT":
                $user_object->id = $user->salesforce_id;
                $res = Salesforce::update([$user_object], 'Contact');

                $this->log->info($res);
                break;
            case "LOGIN":
                $obj = new \stdClass();
                $obj->id = $user->salesforce_id;
                $obj->Last_Login__c = gmdate("Y-m-d\TH:i:s\Z", time());
                $res = Salesforce::update([$obj], 'Contact');
                break;
        }

        $this->log->info($type . ' ' . $user->id . ' ' . $user->salesforce_id . ' ' . $func . ' in SalesForce');

        return $user;
    }


    /**
     * @param $user
     * @param string $type
     * @param string $func
     */
    public function registerUserSessionTracking($user, $session)
    {

        $relation = new \stdClass();

        /** Check if we dont have them in the DB and create them */
        if (empty($session->salesforce_id)) {
            $session = $this->registerSessionTracking($session);
        }

        if (empty($user->salesforce_id)) {
            $user = $this->registerUserTracking($user, 'USER', 'REGISTER');
        }

        $relation->Class__c = $session->salesforce_id;
        $relation->Registrant__c = $user->salesforce_id;

        $res = Salesforce::create([$relation], 'Class_Registrant__c');

        $this->log->info('Relation Created in SalesForce ' . (implode(',', array_values((array)$relation))));
    }

    /**
     * @param $user
     * @param string $type
     * @param string $func
     */
    public function registerSessionTracking($session)
    {
        $class_obj = $this->formatSessionClass($session);

        $res = Salesforce::create([$class_obj], 'Class__c');
        $session->salesforce_id = $res[0]->id;
        $session->save();

        $this->log->info('New Session ' . $session->id . '  in SalesForce');

        return $session;
    }


    /**
     * @param $user
     * @param string $type
     * @param string $func
     */
    public function registerTrackingOld($user, $type = 'USER', $func = 'REGISTER')
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

    /**
     * @param $user
     * @param $type
     * @param $user_arr
     */
    public function formatUser($user, $type)
    {
        $user_arr = $user->toArray();
        $user_data = [];

        $user_data['RecordTypeId'] = '01220000000As0T';

        $trainer = $user->trainer;
        if (!is_null($trainer)) {
            $user_data['RecordTypeId'] = '01220000000As0O';
            $user_data['Profession__c'] = $trainer->profession;
            $user_data['Bio__c'] = substr($trainer->bio, 0, 499);
            $user_data['Website__c'] = $trainer->website;
        }

        $user_data['Gender__c'] = ($user_arr['gender'] == 1 ? 'Male' : 'Female');


        $map = [
            'email' => 'Email',
            'first_name' => 'FirstName',
            'last_name' => 'LastName',
            'phone' => 'Phone'
        ];

        foreach ($map as $key => $val) {
            $user_data[$val] = $user_arr[$key];
        }

        if (!empty($user_arr['dob']) && strtotime($user_arr['dob']) > 1000) {
            $user_data['Birthdate'] = gmdate("Y-m-d\TH:i:s\Z", strtotime($user_arr['dob']));
        }
        if (!empty($user_arr['last_login']) && strtotime($user_arr['last_login']) > 1000) {
            $user_data['Last_Login__c'] = gmdate("Y-m-d\TH:i:s\Z", strtotime($user_arr['last_login']));
        }


        $user_data['MailingCountry']    = 'United Kingdom';


        return (object)$user_data;
    }

    public static function formatSessionClass($session)
    {

        $class = $session->evercisegroup;
        $user = $class->user;

        $venue = $class->venue;

        $categories = $class->subcategories;


        $categories_arr = [];
        foreach ($categories as $cat) {
            $categories_arr[] = $cat->name;
        }

        $class_obj = new \stdClass();

        switch ($class->gender) {
            case "0":
                $target_gender = '';
                break;
            case "1":
                $target_gender = 'Male';
                break;
            case "2":
                $target_gender = 'Female';
                break;
        }


        $class_obj->Name = $class->name . ' | ' . $session->id;
        $class_obj->Trainer__c = $user->salesforce_id;
        $class_obj->Description__c = $user->description;
        $class_obj->Category_1__c = (!empty($categories_arr[0]) ? $categories_arr[0] : '');
        $class_obj->Category_2__c = (!empty($categories_arr[1]) ? $categories_arr[1] : '');
        $class_obj->Category_3__c = (!empty($categories_arr[2]) ? $categories_arr[2] : '');

        $class_obj->Venue_Name__c = $venue->name;
        $class_obj->Street_name_and_number__c = $venue->address;
        $class_obj->City__c = $venue->town;
        $class_obj->Postcode__c = $venue->postcode;

        $class_obj->Duration_mins__c = $session->duration;
        $class_obj->Maximum_Class_Size__c = $class->capacity;
        $class_obj->Price__c = $session->price;
        $class_obj->Target_Gender__c = $target_gender;


        $class_obj->Date_Time__c = gmdate("Y-m-d\TH:i:s\Z", strtotime($session->date_time));


        return $class_obj;
    }


}