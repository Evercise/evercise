<?php

/**
 * Class Subcategory
 */
class Subcategory extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'description'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subcategories';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            'Category',
            'subcategory_categories',
            'subcategory_id',
            'category_id'
        )->withTimestamps();
    }
}