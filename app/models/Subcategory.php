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

	public static function getRelated($type){
		return static::where('type', $type)->lists('name');
	}

}