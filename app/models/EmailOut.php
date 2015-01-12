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
    ];

    protected $table = 'email_out';

    public static function addRecord($user_id, $type)
    {
        static::create(['user_id' => $user_id, 'type' => $type]);
    }

    public static function checkRecord($user_id, $type)
    {
        $record = static::where('user_id', $user_id)
              ->where('type', $type)
              ->first();

        return $record;
    }


}