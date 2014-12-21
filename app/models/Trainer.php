<?php

/**
 * Class Trainer
 */
class Trainer extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'bio', 'website', 'specialities_id', 'gender', 'profession'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trainers';

    public static $validationRules = [ // validation for these fields upon update lies in User/validateUserEdit
        'bio'        => 'required|max:500|min:50',
        'image'      => 'required',
        'website'    => 'sometimes',
        'profession' => 'required|max:50|min:2',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getUnconfirmedTrainers()
    {
        $trainers = static::with('user')->where('confirmed', 0)->get();

        return $trainers;
    }

    /**
     * @param $user
     */
    public static function approve($user)
    {
        try {
            event('user.upgrade', [$user]);
        } catch (Exception $e) {
            return 'Cannot send email. Trainer NOT approved' . $e;
        }

        static::where('user_id', $user->id)->update(['confirmed' => 1]);

    }

    /**
     * @param $user
     */
    public static function unapprove($user)
    {

        static::where('user_id', $user->id)->update(['confirmed' => 0]);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
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
            return FALSE;
        }
    }

    public Static function isTrainerLoggedIn()
    {
        if (Sentry::check() ? (Sentry::getUser()->inGroup(Sentry::findGroupByName('trainer'))) : FALSE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * @return \Illuminate\Validation\Validator
     */
    public static function validTrainerSignup($inputs)
    {
        $validator = self::validateTrainerSignup($inputs);

        return self::handleTrainerValidation($validator);
    }

    /**
     * @param $inputs
     * @return \Illuminate\Validation\Validator
     */
    public static function validateTrainerSignup($inputs)
    {
        // validation rules for input field on register form
        $validator = Validator::make(
            $inputs,
            static::$validationRules
        );

        return $validator;
    }

    public static function handleTrainerValidation($validator)
    {
        if ($validator->fails()) {
            $result = [
                'validation_failed' => 1,
                'errors'            => $validator->errors()->toArray()
            ];
        } else {
            // if validation passes return validation_failed false
            $result = [
                'validation_failed' => 0
            ];
        }

        return $result;
    }

    public function updateTrainer($params)
    {
        $this->update(array_filter($params));
    }

}