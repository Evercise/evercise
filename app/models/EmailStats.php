<?php


class EmailStats extends Eloquent
{

    /**
     * @var array
     */
    public $fillable = [
        'uid',
        'status',
        'sg_event_id',
        'reason',
        'event',
        'purchase',
        'email',
        'timestamp',
        'smtp-id',
        'type',
        'category'
    ];

    protected $table = 'email_stats';


}