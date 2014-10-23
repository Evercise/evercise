<?php


class PagesController extends \BaseController
{


    protected $route_prefix_category = 'articles.category.';
    protected $route_prefix_article = 'articles.article.';

    private $articles;
    private $articleCategories;
    private $route;
    private $request;
    private $log;
    private $app;


    public function __construct(
        Articles $articles,
        ArticleCategories $articleCategories,
        \Illuminate\Routing\Router $route,
        \Illuminate\Http\Request $request,
        \Illuminate\Log\Writer $log,
        App $app
    ) {

        parent::__construct();

        $this->articles = $articles;
        $this->articleCategories = $articleCategories;

        $this->route = $route;
        $this->request = $request;
        $this->log = $log;
        $this->app = $app;
    }


    /** CACHE THIS SUCKER */

    public function generateRoutes()
    {

        /** Category Routes */
        $categories = $this->articleCategories->all();
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


    private function hasAccess($object)
    {

        if ($object instanceof Articles) {
            if ($object->status == 1) {
                return true;
            }

            if ($this->user && $this->user->hasAccess('admin')) {
                return true;
            }

        }
        if ($object instanceof ArticleCategories) {
            if ($object->status == 1) {
                return true;
            }

            if ($this->user && $this->user->hasAccess('admin')) {
                return true;
            }

        }

        return false;


    }


    public function getObject($type = 'article')
    {

        $name = $this->route->currentRouteName();
        $object = false;


        switch ($type) {
            case 'article':
                $article_id = str_replace($this->route_prefix_article, '', $name);
                $object = $this->articles->find($article_id);
                break;

            case 'category':
                $category_id = str_replace($this->route_prefix_category, '', $name);
                $object = $this->articleCategories->find($category_id);
                break;

        }

        if (!$object) {
            $this->log->error('NO URL FOUND ' . $this->request->url());
            $this->app->abort(404);
        }


        return $object;

    }

    public function index()
    {
        return 'page';
    }

    public function showCategory()
    {
        $category = $this->getObject('category');

        if (!$this->hasAccess($category)) {
            //FIGURE OUT SOMETHING HERE!!!

            die('HEEYY');
        }

        return 'category';
    }

    public function showPage()
    {
        $article = $this->getObject('article');

        if (!$this->hasAccess($article)) {
            //FIGURE OUT SOMETHING HERE!!!

            die('HEEYYaaaaaa');
        }
        return 'page';
    }
}