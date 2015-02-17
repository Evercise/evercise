<?php
use Carbon\Carbon;

/**
 * Class Milestone
 */
class Packages extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'description', 'price', 'bullets', 'classes', 'style', 'max_class_price'];

    /**
     * @var string
     */
    protected $table = 'packages';


    public function savings() {

        return round(100-($this->price / ($this->max_class_price * $this->classes) * 100), 0);
    }

    public function availableClasses() {

        return Evercisegroup::where('default_price', '<=', $this->max_class_price)->where('published', 1)->count();
    }

}