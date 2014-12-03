<?php

/**
 * Class Areacodes
 */
class Activities extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array('id', 'type', 'type_id', 'description', 'user_id', 'link', 'link_title', 'image', 'title');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activity';


    public static function getAll($user_id, $limit = 100){
        return static::select(DB::raw('*, DATE_FORMAT(created_at,"%M %D %Y") as format_date'))->where('user_id', $user_id)->orderBy('created_at', 'desc')->limit($limit)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction()
    {
        return $this->hasOne('Transactions', 'id', 'type_id');
    }

}