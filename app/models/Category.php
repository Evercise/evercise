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

    public static function assignVisible($visibleSettings)
    {
        foreach ($visibleSettings as $id => $v)
        {
            $cat = static::where('id', $id);
            if($cat) {
                $cat->update(['order' => $v]);
            }
        }

    }
    public function getPopularClassesArray()
    {
        $groups = Evercisegroup::whereIn('id', explode(',', $this->popular))->get();

        $output = [];
        foreach ($groups as $group) {
            $output[$group->id] = [
                'name' => $group->name,
                'slug' => $group->slug,
            ];
        }

        return $output;
    }

    public function getPopularSubcategories()
    {
        $subcategories = Subcategory::take(15)->lists('name', 'id');

        return $subcategories;
    }

    /** return all categorys
     *      - description
     *      - popular classes (the chosen ones)
     *      - subcategories (order by num classes, limit 15)
     *
     */
    public static function browse()
    {
        $categories = static::with('subcategories')->get();

        $output = [];
        foreach ($categories as $category) {
            $output[] = [
                'name' => $category->name,
                'description' => $category->description,
                'popular' => $category->getPopularClassesArray(),
                'subcategories' => $category->getPopularSubcategories(),
            ];
        }


        return $output;
    }
}















