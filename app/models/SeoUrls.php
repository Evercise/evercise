<?php

/**
 * Class SeoUrls
 */
class SeoUrls extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'area_id', 'search', 'title', 'description'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seo_urls';

    public static function match($search, $area)
    {
        //return ['title' => $search.' : '.$area->id, 'desc' => ''];

        $seoUrl = SeoUrls::where('search', $search)->where('area_id', $area->id)->first();

        $defaultTitle = 'Fitness Classes, Events & Gyms in London | Evercise';
        $defaultDescription = 'Evercise is an online platform that connects everyone wanting to exercise in a class with a wide array of Fitness Trainers and fitness classes all over London.';

        if ($seoUrl)
        {
            return ['title' => $seoUrl->title, 'desc' => $seoUrl->description];
        }

        return ['title' => $defaultTitle, 'desc' => $defaultDescription];
    }

    public function locationName()
    {
        $location = Place::find($this->area_id);

        if (! $location ) return '';

        return $location->name;
    }


}