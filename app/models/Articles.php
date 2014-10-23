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



    /** CACHE THIS SUCKER */

    public function generateRoutes()
    {

        /** Category Routes */
        $categories = ArticleCategories::all();
        $cat = [];
        foreach ($categories as $c) {
            $cat[$c->id] = $c;
            $this->route->get($c->permalink,
                ['as' => $this->route_prefix_category . $c->id, 'uses' => 'PagesController@showCategory']);
        }

        /** Articles Routes */
        $articles = $this->articles->all();
        foreach ($articles as $a) {
            $url = '';
            if ($a->page == 1 && !empty($a->category_id)) {
                $url .= $cat[$a->category_id]->permalink . '/';
            }

            $url .= $a->permalink;

            $this->route->get($url,
                ['as' => $this->route_prefix_article . $a->id, 'uses' => 'PagesController@showPage']);
        }
    }





    public function category()
    {
        return $this->hasOne('ArticleCategories', 'id');
    }

    public static function createUrl($article)
    {
        $url = '';

        if ($article->category_id > 0) {
            $url .= $article->category->permalink . '/';
        }

        $url .= $article->permalink;


        return $url;
    }

}
