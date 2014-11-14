<?php

/**
 * Articles Models
 */
class Articles extends Eloquent
{

    /**
     * @var array
     */
    protected $fillable = array(
        'id',
        'category_id',
        'page',
        'title',
        'main_image',
        'description',
        'intro',
        'keywords',
        'content',
        'permalink',
        'status',
        'published_on'
    );


    protected $dates = ['published_on'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';






    public function category()
    {
        return $this->hasOne('ArticleCategories', 'id');
    }

    public static function createUrl($article, $full = false)
    {
        $url = '';

        if ($article->category_id > 0 && $article->page == 0) {
            $url .= $article->category->permalink . '/';
        }

        $url .= $article->permalink;

        if($full) {
            return URL::to($url);
        }

        return $url;
    }

}
