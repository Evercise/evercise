<?php

class FakeRating extends \Eloquent
{

    protected $fillable = array('id', 'user_id', 'evercisegroup_id', 'stars', 'comment');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fakeratings';

    /* the user that rated this class */
    public function rator()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function evercisegroup()
    {
        return $this->belongsTo('evercisegroup', 'evercisegroup_id');
    }

    public static function validateAndCreateRating()
    {
        $validator = Validator::make(
            Input::all(),
            array(
                'rator' => 'required|max:5|min:1',
                'evercisegroup_id' => 'required|max:5|min:1',
                'stars' => 'required|max:1|min:1|between:0,5',
                'comment' => 'required|max:255|min:4',
            )
        );
        if ($validator->fails()) {
            return array(
                'validation_failed' => 1,
                'errors' => $validator->errors()->toArray()
            );
        }
        else {

            $stars = Input::get('stars', 1);
            $comment = Input::get('comment', 1);
            $evercisegroup_id = Input::get('evercisegroup_id', 1);
            $rator = Input::get('rator', 0);

            Static::create([
                'user_id'=>$rator,
                'evercisegroup_id'=>$evercisegroup_id,
                'stars'=>$stars,
                'comment'=>$comment,
            ]);

            return array(
                'validation_failed' => 0,
            );
        }

    }
}