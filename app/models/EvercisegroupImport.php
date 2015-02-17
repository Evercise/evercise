<?php
use Carbon\Carbon;

/**
 * Class Evercisegroup
 */
class EvercisegroupImport extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'evercisegroup_id',
        'external_id',
        'external_venue_id',
        'source',
        'slug',
        'name',
        'description',
        'image'
    ];

    protected $editable = [
        'name',
        'venue_id',
        'description',
        'image',
        'category1',
        'category2',
        'category3',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evercisegroup_import';


}