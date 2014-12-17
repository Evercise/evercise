<?php

class LandingPages extends Eloquent
{

    protected $table = 'landing_pages';
    protected $fillable = ['id', 'slug', 'main_image', 'params'];


}