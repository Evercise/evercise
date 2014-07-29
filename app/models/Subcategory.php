<?php

class Subcategory extends Eloquent {

	protected $fillable = array('id', 'name','description');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'subcategories';

	public function categories()
    {
        return $this->belongsToMany('Category', 'subcategory_categories', 'subcategory_id', 'category_id')->withTimestamps();
    }
}