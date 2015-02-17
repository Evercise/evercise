<?php


class EmailOut extends Eloquent
{

    /**
     * @var array
     */
    public $fillable = [
        'id',
        'user_id',
        'type',
        'message_id',
        'email',
    ];

    protected $table = 'email_out';

    public static function addRecord($user, $type, $message_id = '')
    {
        if(is_numeric($user)) {
            static::create(['user_id' => $user, 'type' => $type, 'message_id' => $message_id]);
        } else {

            static::create(['user_id' => 0, 'email' => $user, 'type' => $type, 'message_id' => $message_id]);
        }
    }

    public static function checkRecord($user_id, $type)
    {
        $record = static::where('user_id', $user_id)
              ->where('type', $type)
              ->first();

        return $record;
    }


}