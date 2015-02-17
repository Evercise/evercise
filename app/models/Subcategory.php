<?php

/**
 * Class Subcategory
 */
class Subcategory extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'name', 'description', 'associations', 'type'];

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

	/**
	 * @param $categoryChanges
	 * @return bool
     */
	public static function editSubcategoryCategories($categoryChanges)
	{
		foreach ($categoryChanges as $subcategoryId => $change) {

			$subcategory = Subcategory::find($subcategoryId);
			if($subcategory && is_array($change)) {
				$subcategory->categories()->detach();

				$catArray = [];
				foreach ($change as $cat) {
					if (!in_array($cat, $catArray))
						array_push($catArray, $cat);
				}
				$subcategory->categories()->attach($catArray);
			}
		}
		return 1;
	}

	public static function editAssociations($associationChanges)
	{
		foreach($associationChanges as $ass)
		{
			foreach($ass as $key => $assData) {
				if ($subcategory = Subcategory::find($key))
					$subcategory->update(['associations' => $assData]);
			}
		}
		
		return true;
	}

	public static function editTypes($changes)
	{
		foreach($changes as $sub_id => $type)
		{
				if ($subcategory = Subcategory::find($sub_id))
					$subcategory->update(['type' => $type]);

		}

		return true;
	}


	public static function namesToIds($names)
	{
		return static::whereIn('name', $names)->lists('id');
    }

	public static function getRelated($type)
	{
		return static::where('type', $type)->lists('name');
	}

	public function evercisegroups()
	{
		return $this->belongsToMany('Evercisegroup', 'evercisegroup_subcategories', 'subcategory_id', 'evercisegroup_id');
	}

	/**
	 * Takes the search term and returns a collection of up to 10 classes which:
	 * 		- share a category
	 * 		- Have future sessions
	 * 	- Ordered by number of future sessions
	 *
	 * @param $searchTerm
	 * @return $this|string
     */
	public static function getRelatedFromSearch($searchTerm = false)
	{

		$cacheId = 'category_' . ($searchTerm ?: 'nosearch');
		if(Cache::has($cacheId))
		{
			$subcategoryNames = Cache::get($cacheId);
		}
		else
		{


			$subcategory = static::where('name', 'LIKE', '%' . $searchTerm . '%')
				->first();
			//return $subcategory->name;


			if ($subcategory) {
				$catIds = [];
				foreach ($subcategory->categories as $category) {
					$catIds[] = $category->id;
				}
			}
			else
			{
				$catIds = Category::lists('id');
			}

			$subcategories = static::
			whereHas('categories', function ($query) use ($catIds) {
					$query->whereIn('categories.id', $catIds);
				})
				->whereHas('evercisegroups', function ($query) {
					$query->whereHas('futuresessions', function ($query) {

					});
				})
				->take(10)
				->get()
				->sortBy(function ($subcats) {
					return $subcats->evercisegroups->count();
				});

			$subcategoryNames = [];
			foreach($subcategories as $subcat){
				$subcategoryNames[] = $subcat->name;
			}

			Cache::put($cacheId, $subcategoryNames, 180);

			/** ---------- prepare output for testing --------- */
/*			$subcategoryName = $subcategory ? $subcategory->name : 'no Subcategory. Categories: ' . implode(',', $catIds);
			$subcategoryCategories = $subcategory ? $subcategory->categories : [];

			$output = '<strong>Subcategory: '.$subcategoryName.'</strong>';
			$output .= '<br><br><strong>Categories: '.count($subcategoryCategories).'</strong>';
			foreach ($subcategoryCategories as $cat) {
				$output .= '<br>'.$cat->name;
			}

			$output .= '<br><br><strong>Subcategories: '.count($subcategories).'</strong>';
			foreach ($subcategories as $subcat) {
				$output .= '<br>'.$subcat->id.' - '.$subcat->name;
			}
			return $output;*/
			/** ------------------------------------------------ */

		}




		return $subcategoryNames;
	}

	public function getCategoriesString()
	{
		$output = '';
		foreach ($this->categories as $cat) {
			$output .= $cat->name . ', ';
		}
		return $output;
	}

}