<?php

/**
 * Articles Models
 */
class ArticleCategories extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array('id', 'parent_id', 'title', 'main_image', 'description', 'keywords', 'permalink');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'article_categories';

    public function subcategories()
    {
        return $this->belongsTo('ArticleCategories', 'parent_id');
    }

}