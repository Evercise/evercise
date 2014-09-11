<?php

use Watson\Validating\ValidatingTrait;
/**
 * Class Trainer
 */
class Trainer extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array('user_id', 'bio', 'website', 'specialities_id', 'gender', 'profession');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trainers';

    use ValidatingTrait;

    protected $rulesets  =[];

    function __construct()
    {
        $this->rulesets  = [
            'store' => [
                'bio' => 'required|max:500|min:50',
                'website' => 'sometimes',
                'profession' => 'required|max:50|min:2',
            ],
            'updating'=> [
                'bio' => 'required|max:500|min:50',
                'profession' => 'required|max:50|min:5',
            ]

        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getConfirmedTrainers()
    {
        $trainers = Static::with('user')->where('confirmed', 0)->get();
        return $trainers;
    }

    /**
     * @param $user
     */
    public static function approve($user)
    {

        try
        {
            Event::fire('user.upgrade', array(
                'email' => $user->email,
                'display_name' => $user->display_name
            ));
        }
        catch(Exception $e)
        {
            return 'Cannot send email. Trainer NOT approved' . $e;
        }

        Static::where('user_id', $user->id)->update(['confirmed' => 1]);

    }



    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public static function createTrainerRecord($inputs)
    {
        $user = Sentry::getUser();

        $trainer = new Trainer;

        $trainer->user_id = $user->id;
        $trainer->bio = $inputs['bio'];
        $trainer->website = $inputs['website'];
        $trainer->profession = $inputs['profession'];


        if($trainer->isValid('store'))
        {
            $user_result = User::updateUser($user, Input::all() , 'trainer');

            if( $user_result  == 'saved' )
            {
                $trainer->save();

                $userGroup = Sentry::findGroupById(3);
                $user->addGroup($userGroup);

                Event::fire('user.confirm', array(
                    'email' => $user->email,
                    'display_name' => $user->display_name
                ));

                Wallet::firstOrCreate(['user_id'=>$user->id, 'balance'=>0, 'previous_balance'=>0]);

                Event::fire('trainer.registered', [$user]);

                $result =  'saved';
            }
            else
            {
                $result =  $user_result;
            }

        }
        else
        {
            $result = $trainer->getErrors();
        }


        return $result;

    }

    /**
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public static function updateTrainerDetails($user, $inputs, $validation_type = 'updating')
    {
        $trainer = Static::where('user_id', $user->id)->first();

        $trainer->bio = isset($inputs['bio']) ? $inputs['bio'] : $trainer->bio;
        $trainer->website = isset($inputs['website']) ? $inputs['website'] : $trainer->website;
        $trainer->profession = isset($inputs['profession']) ? $inputs['profession'] : $trainer->profession;

        if($trainer->isValid($validation_type))
        {
            $trainer->save();
            Event::fire('trainer.editTrainerDetails', [$user]);
            $result = 'saved';

        }
        else
        {
            $result = $trainer->getErrors();
        }

        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function fullTrainerAsUser($id)
    {
        $user = User::where('id', $id)
            ->has('hasUpcomingSessions')
            ->with('trainer')
            ->with('ratings')
            ->firstOrFail();
        return $user;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function speciality()
        //return $this;
    {
        return $this->hasOne('Speciality', 'id', 'specialities_id');
    }


    /**
     *
     *
     * @param $params
     * @return bool|\Illuminate\Database\Eloquent\Model|static
     */
    public static function createOrFail($params)
    {
        $user_id = $params['user_id'];

        if (count(Trainer::where('user_id', $user_id)->get()) < 1) {
            $newRecord = Trainer::create($params);
            return $newRecord;
        } else {
            return false;
        }
    }

    public Static function isTrainerLoggedIn()
    {
        if ( Sentry::check() ? (Sentry::getUser()->inGroup(Sentry::findGroupByName('trainer'))) : false )
            return true;
        else
            return false;
    }

}