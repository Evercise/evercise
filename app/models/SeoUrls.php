<?php

/**
 * Class SeoUrls
 */
class SeoUrls extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = ['id', 'location', 'search', 'title', 'description'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seo_urls';


}