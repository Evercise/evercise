<?php

use Illuminate\View\Factory as View;
use Illuminate\Http\Request as Request;
use Illuminate\Config\Repository as Config;

/**
 * Class ArticlesController
 */
class ArticlesController extends \BaseController
{

    private $articlecategories;
    private $articles;
    private $view;
    private $config;
    private $request;

    public function __construct(
        Articles $articles,
        ArticleCategories $articlecategories,
        View $view,
        Request $request,
        Config $config
    ) {

        $this->articlecategories = $articlecategories;
        $this->articles = $articles;
        $this->view = $view;
        $this->config = $config;
        $this->request = $request;
    }


    public function articles()
    {

        $articles = Articles::orderBy('created_at', 'desc')->get();
        return $this->view->make('admin.cms.articles', compact('articles'))->render();
    }

    /**
     * Manage Article
     *
     * @return Response
     */
    public function manage($id = 0)
    {

        if (!empty($_POST)) {
            $save = $this->saveArticle($id);

            if (!empty($save['validation_failed'])) {
                return Redirect::back()->withInput()->withErrors(
                    $save['validator']
                );
            }
            if(!empty($save['new'])) {
                if ($save['new']) {
                    return Redirect::route('admin.article.manage', ['id' => $save['article']->id]);
                }
            }
        }
        $article = $this->articles->find($id);
        $categories = $this->articlecategories->all();
        $templates = $this->getTemplates();

        $cookie = Cookie::make('allowFinder', true,  60);
        $view = $this->view->make('admin.cms.manage', compact('article', 'categories', 'templates'))->render();

        return Response::make($view)->withCookie($cookie);


    }


    private function saveArticle($id = 0)
    {
        $data = $this->request->except('_token');


        $validator = Validator::make(
            $data,
            [
                'title'       => 'required|max:160|min:5',
                'description' => 'required|max:5000|min:100',
                'category_id' => 'required|numeric',
                'page'        => 'required|numeric|between:0,1',
                'main_image'  => 'image|mimes:jpeg,jpg,png,gif',
                'intro'       => 'required|max:500',
                'keywords'    => 'required|max:160',
                'content'     => 'required|min:300',
                'permalink'   => 'required',
                'status'      => 'required'
            ]
        );

        if ($validator->fails()) {

            return [
                'validation_failed' => 1,
                'validator'         => $validator,
                'errors'            => $validator->errors()->toArray()
            ];
        } else {

            if(!empty($data['id']) && $data['id'] > 0) {
                $id = $data['id'];
                unset($data['id']);
            }


            $dir = public_path() . '/img/pages/' . date('Y');
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            $dir .= '/' . date('m');
            if (!is_dir($dir)) {
                mkdir($dir);
            }

            if ($this->request->file('main_image')) {
                $file = $dir . '/' . Str::slug($data['title']).'.'.$this->request->file('main_image')->getClientOriginalExtension();
                $image = Image::make($this->request->file('main_image')->getRealPath())->fit(
                    $this->config->get('evercise.article_main_image.width'),
                    $this->config->get('evercise.article_main_image.height')
                )->save($file);

                $data['main_image'] = str_replace(public_path() . '/', '', $file);
            }


            if (!isset($data['published_on'])) {
                $data['published_on'] = date('Y-m-d H:i:s');
            } else {
                $data['published_on'] = date('Y-m-d H:i:s', strtotime($data['published_on']));
            }

            $url = '';
            if ($data['page'] > 0) {
                $category = ArticleCategories::find($data['category_id']);
                $url .= $category->permalink . '/';
            }
            $url .= $data['permalink'];

            unset($data['save']);

            if ($id == 0) {
                $new = true;
                $article = Articles::create($data);
            } else {
                $new = false;
                $article = Articles::find($id);

                foreach ($data as $key => $val) {
                    $article->{$key} = $val;
                }

                $article->save();

            }

            return [
                'new'     => $new,
                'article' => $article,
                'url'     => url($url, ['preview' => 'true'])
            ];

        }
    }

    protected function getTemplates()
    {

        $templates = array();

        //Get from the main template directory first:
        foreach (glob(app_path() . '/views/articles/template_*') as $filename) {
            $filename = basename($filename);
            $name = str_replace(array('template_', '_', '.blade.php'), array('', ' ', ''), $filename);
            $templates[str_replace('.php', '', $filename)] = ucfirt($name);
        }

        return $templates;

    }
}