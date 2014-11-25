<?php

class Slider extends Eloquent {

    protected $table = 'slider';
    protected $fillable = ['image', 'evercise_id','date_end','active'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['date_end'];

}