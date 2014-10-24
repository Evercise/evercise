<?php


/**
 * Class PagesController
 */
class PagesController extends \BaseController
{


    /**
     * @var string
     */
    protected $route_prefix_category = 'articles.category.';
    /**
     * @var string
     */
    protected $route_prefix_article = 'articles.article.';

    private $articles;
    private $articleCategories;
    private $route;
    private $request;
    private $log;
    private $app;
    private $view;


    /**
     * @param Articles $articles
     * @param ArticleCategories $articleCategories
     * @param \Illuminate\Routing\Router $route
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Log\Writer $log
     * @param \Illuminate\View\Factory $view
     * @param App $app
     */
    public function __construct(
        Articles $articles,
        ArticleCategories $articleCategories,
        \Illuminate\Routing\Router $route,
        \Illuminate\Http\Request $request,
        \Illuminate\Log\Writer $log,
        \Illuminate\View\Factory $view,
        App $app
    ) {

        parent::__construct();

        $this->articles = $articles;
        $this->articleCategories = $articleCategories;

        $this->route = $route;
        $this->request = $request;
        $this->log = $log;
        $this->app = $app;
        $this->view = $view;
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
            if ($a->page == 1 && !empty($a->category_id) && !empty($cat[$a->category_id]->permalink)) {
                $url .= $cat[$a->category_id]->permalink . '/';
            }

            $url .= $a->permalink;

            $this->route->get($url,
                ['as' => $this->route_prefix_article . $a->id, 'uses' => 'PagesController@showPage']);
        }
    }


    /**
     * @param $object
     * @return bool
     */
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


    /**
     * @param string $type
     * @return bool|\Illuminate\Support\Collection|static
     */
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

    /**
     *
     */
    public function index()
    {
        $this->showBlog();
    }


    /**
     * @return string
     */
    public function showBlog() {

        return 'blog';
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function showCategory()
    {
        $category = $this->getObject('category');

        if (!$this->hasAccess($category)) {
            /** Redirect Temporary to blog.. until we figure out what to do here */
            return Redirect::route('blog', 307)->with('message', 'You don\'t have access to that page!');
        }


        return 'category';
    }

    /**
     * @return \Illuminate\View\View
     */
    public function showPage()
    {
        $article = $this->getObject('article');

        if (!$this->hasAccess($article)) {
            /** Redirect Temporary to blog.. until we figure out what to do here */
            return Redirect::route('blog', 307)->with('message', 'You don\'t have access to that page!');
        }


        $article->content = Shortcode::compile($article->content);



        /** Categories */
        $categories = $this->articleCategories->where('status', 1)->get();

        $view = 'v3.pages.single';

        if(!empty($article->template)) {
            $view = $article->template;
        }


        $metaDescription = $article->description;
        $title = $article->title;
        $keywords = $article->keywords;


        return $this->view->make($view, compact('article', 'categories', 'metaDescription', 'title', 'keywords'));
    }
}