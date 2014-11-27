<?php

/**
 * Class Milestone
 */
class Packages extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'description', 'price', 'bullets', 'classes', 'savings', 'max_class_price'];

    /**
     * @var string
     */
    protected $table = 'packages';

}