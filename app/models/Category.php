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
        'popular_classes',
        'popular_subcategories',
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
    public function getPopularClassesString()
    {
        $groups = Evercisegroup::whereIn('id', explode(',', $this->popular_classes))->lists('name');

        return implode(',', $groups);
    }

    public function getPopularClasses()
    {
        $groups = Evercisegroup::whereIn('id', explode(',', $this->popular_classes))->get();

        $output = [];
        foreach ($groups as $group) {
            $output[$group->id] = [
                'name' => $group->name,
                'slug' => $group->slug,
            ];
        }

        return $output;
    }

    public function getPopularSubcategoriesString()
    {
        if ($this->popular_subcategories)
        {
            $subcats = Subcategory::whereIn('id', explode(',', $this->popular_subcategories))->lists('name');

            //return $this->popular_subcategories
            return implode(',', $subcats);
        }
        else
        {
            return '';
        }
    }
    public function getPopularSubcategories()
    {
        //$subcategories = Subcategory::take(15)->lists('name', 'id');

        //return $this->popular_subcategories;

        if ($this->popular_subcategories)
        {
            $subcats = Subcategory::whereIn('id', explode(',', $this->popular_subcategories))->get();

            $output = [];
            foreach ($subcats as $subcat) {
                $output[] = [
                    'name' => $subcat->name,
                ];
            }

            return $output;
        }
        else
        {
            return [];
        }
    }
    public function getPopularClassSubcatMix()
    {
        $subcats = $this->getPopularSubcategories();
        $mix = $this->getPopularClasses();

        $i = 0;
        while (count($mix) < 3)
        {
            if( isset( $subcats[$i] ) )
                array_push( $mix, $subcats[$i] );
            else
                break;
            $i++;
        }

        return $mix;
    }

    /**
     * Returns an array of subcategories
     *     - up to 15 results
     *     - linked to category instance
     *     - ordered by num of classes in that category
     */
    public function generatePopularSubcategories()
    {

        $categoryId = $this->id;

        $subcategories = Subcategory::
            whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            })
            ->whereHas('evercisegroups', function($query){})
            ->take(15)
            ->get()
            ->sortByDesc(function ($subcats) {
                return $subcats->evercisegroups->count();
        });

        $output = [];
        foreach ($subcategories as $subcat) {
            $output[] = [
                'name' => $subcat->name,
                'classes' => $subcat->evercisegroups->count(),
            ];
        }


        return $output;
    }

    /** return all categorys
     *      - description
     *      - popular subcategories (the chosen ones)
     *      - subcategories (order by num classes, limit 15)
     *
     */
    public static function browse()
    {
        $categories = static::
              with('subcategories')
            ->get()
            ->sortBy(function ($subcats) {
                return $subcats->order;
            });

        $output = [];
        foreach ($categories as $category) {
            $output[] = [
                'name' => $category->name,
                'description' => $category->description,
                'popular_subcategories' => $category->getPopularClassSubcatMix(),
                'generated_subcategories' => $category->generatePopularSubcategories(),
            ];
        }


        return $output;
    }
}















