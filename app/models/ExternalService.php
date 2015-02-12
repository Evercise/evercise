<?php

class ExternalService extends Eloquent
{

    protected $table = 'external_services';

    protected $fillable = ['id', 'service', 'user_id', 'site_id', 'user_login', 'user_login', 'user_pass', 'information'];



    public function user() {
        $this->belongsTo('User');
    }

}