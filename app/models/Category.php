<?php

/**
 * Class Category
 */
class Category extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array(
        'id',
        'name',
        'image',
        'order',
        'visible',
        'description',
        'popular'
    );

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

    public static function editOrder($newOrder)
    {
        foreach ($newOrder as $id => $place)
        {
            $cat = static::where('id', $id);
            if($cat) {
                $cat->update(['order' => $place]);
            }
        }
    }

    public function getPopularClasses()
    {
        $groups = Evercisegroup::whereIn('id', explode(',', $this->popular))->lists('name');

        return implode(',', $groups);
    }
}