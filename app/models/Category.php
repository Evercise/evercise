<?php

/**
 * Class Category
 */
class Category extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array('id', 'name', 'image');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subcategories()
    {
        return $this->belongsToMany(
            'Subcategory',
            'subcategory_categories',
            'category_id',
            'subcategory_id'
        )->withTimestamps();
    }

}