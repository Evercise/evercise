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
		foreach (explode('-', $categoryChanges) as $change) {
			$ch = explode('=', $change);
			if (count($ch) > 1) {
				$subcat = $ch[0];

				$subcategory = Subcategory::find($subcat);
				$subcategory->categories()->detach();

				$catArray = [];
				foreach (explode('_', $ch[1]) as $cat) {
					if (!in_array($cat, $catArray))
						array_push($catArray, $cat);
				}
				$subcategory->categories()->attach($catArray);
			}
		}
		return true;
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
	public static function getRelatedFromSearch($searchTerm)
	{
		//$subcategories = Subcategory::where('name', 'LIKE', $searchTerm)->lists('name');
		//return $subcategories;

		$subcategory = Subcategory::where('name', 'LIKE', '%'.$searchTerm.'%')
			->first();

		if(! $subcategory) return 'No Subcategory found';

		$catIds = [];
		foreach ($subcategory->categories as $category) {
			$catIds[] = $category->id;
		}

		$subcategories = static::
			whereHas('categories', function($query) use($catIds) {
				$query->whereIn('categories.id', $catIds);
			})
			->whereHas('evercisegroups', function($query){
				$query->whereHas('futuresessions', function($query){

				});
			})
			->take(10)
			->get()
			->sortBy(function($groups){
				return $groups->futuresessions;
			});

		/** ---------- prepare output for testing --------- */
		/*$output = '<strong>Categories: '.count($subcategory->categories).'</strong>';
		foreach ($subcategory->categories as $cat) {
			$output .= '<br>'.$cat->name;
		}

		$output .= '<br><br><strong>Subcategories: '.count($subcategories).'</strong>';
		foreach ($subcategories as $subcat) {
			$output .= '<br>'.$subcat->name;
		}
		return $output;*/
		/** ------------------------------------------------ */

		return $subcategories;
	}

}