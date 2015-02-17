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

        $articles = $this->articles->orderBy('created_at', 'desc')->get();
        return $this->view->make('admin.cms.articles', compact('articles'))->render();
    }

    /**
     * Manage Article
     *
     * @return Response
     */
    public function manage($id = 0)
    {
        //$data = $this->request->except(['_token', 'row_single']);
        //return $data['published_on'];

        if (!empty($_POST)) {
            $save = $this->saveArticle($id);

            if (!empty($save['validation_failed'])) {
                return Redirect::back()->withInput()->withErrors(
                    $save['validator']
                );
            }

            Session::flash('notification', 'Article Saved');

            if(!empty($save['new'])) {
                if ($save['new']) {
                    return Redirect::route('admin.article.manage', ['id' => $save['article']->id]);
                }
            }


        }
        $article = $this->articles->find($id);
        $categories = $this->articlecategories->all();

        $cat_drop = [];
        foreach($categories as $c) {
            $cat_drop[$c->id] = $c->title;
        }
        $templates = $this->getTemplates();


        $evercisegroup = Evercisegroup::has('futuresessions')
            ->has('confirmed')
            ->with('venue')
            ->with('user')
            ->with('ratings')
            ->with('futuresessions')
            ->get();

        $cookie = Cookie::make('allowFinder', true,  60);
        $view = $this->view->make('admin.cms.manage', compact('article', 'categories', 'evercisegroup', 'templates', 'cat_drop'))->render();

        return Response::make($view)->withCookie($cookie);


    }


    private function saveArticle($id = 0)
    {
        $data = $this->request->except(['_token', 'row_single']);



        $validator = Validator::make(
            $data,
            [
                'title'       => 'required|max:160|min:5',
                'meta_title'  => 'required|max:160|min:5',
                'description' => 'required|max:5000|min:100',
                'category_id' => 'required|numeric',
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

            if($data['template'] == '0') {
                $data['template'] = '';
            }

            $dir = public_path() . '/files/pages';
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            $dir .= '/' . date('Y');
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            $dir .= '/' . date('m');
            if (!is_dir($dir)) {
                mkdir($dir);
            }

            if ($this->request->file('main_image')) {

                $file = $dir . '/' . slugIt($data['title']).'.'.$this->request->file('main_image')->getClientOriginalExtension();
                $image = Image::make($this->request->file('main_image')->getRealPath())->fit(
                    $this->config->get('evercise.article_main_image.regular.width'),
                    $this->config->get('evercise.article_main_image.regular.height')
                )->save($file);
                $data['main_image'] = str_replace(public_path() . '/', '', $file);

                $file = $dir . '/thumb_' . slugIt($data['title']).'.'.$this->request->file('main_image')->getClientOriginalExtension();
                $image = Image::make($this->request->file('main_image')->getRealPath())->resize(
                    $this->config->get('evercise.article_main_image.thumb.width'),
                    $this->config->get('evercise.article_main_image.thumb.height')
                )->save($file);

                $data['thumb_image'] = str_replace(public_path() . '/', '', $file);
            }

            if(is_null($data['main_image'])) {
                unset($data['main_image']);
            }

            if (!isset($data['published_on'])) {
                $data['published_on'] = new \Carbon\Carbon();
            } else {
                $data['published_on'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['published_on']);
            }

            $url = '';
            if (!empty($data['page']) && $data['page'] > 0) {
                $category = $this->articlecategories->find($data['category_id']);
                $url .= $category->permalink . '/';
            }
            $url .= $data['permalink'];


            /** Fix Image Path */
            $data['content'] = str_replace(getcwd(), '', $data['content']);


            unset($data['save']);


            if ($id == 0) {
                $new = true;
                $article = $this->articles->create($data);
            } else {
                $new = false;
                $article = $this->articles->find($id);

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
        $templates[] = 'Default';

        //Get from the main template directory first:
        foreach (glob(app_path() . '/views/v3/pages/template_*') as $filename) {
            $filename = basename($filename);
            $name = str_replace(array('template_', '_','.blade.php'), array('', ' ', ''), $filename);
            $templates[str_replace('.blade.php', '', $filename)] = ucfirst($name);
        }

        return $templates;

    }


    public function deleteArticle($id = 0) {
        $article = $this->articles->find($id);


        if($article) {

            $article->delete();

            return Redirect::route('admin.articles')->with('notification', 'Article Deleted');
        }



    }



    public function categories(){

        $categories = $this->articlecategories->all();

        return $this->view->make('admin.cms.categories', compact('categories'))->render();
    }

    public function categoriesManage($id = 0){

        if (!empty($_POST)) {
            $save = $this->saveCategory($id);

            if (!empty($save['validation_failed'])) {
                return Redirect::back()->withInput()->withErrors(
                    $save['validator']
                );
            }
            if(!empty($save['new'])) {
                if ($save['new']) {
                    return Redirect::route('admin.article.category.manage', ['id' => $save['category']->id]);
                }
            }
        }

        $category = $this->articlecategories->find($id);

        return $this->view->make('admin.cms.manage_categories', compact('category'))->render();
    }





    private function saveCategory($id = 0)
    {
        $data = $this->request->except('_token');


        $validator = Validator::make(
            $data,
            [
                'title'       => 'required|max:160|min:5',
                'description' => 'required|max:5000|min:100',
                'main_image'  => 'image|mimes:jpeg,jpg,png,gif',
                'keywords'    => 'required|max:160',
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


            $dir = public_path() . '/files/pages';
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            $dir .= '/' . date('Y');
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
                    $this->config->get('evercise.article_category_main_image.width'),
                    $this->config->get('evercise.article_category_main_image.height')
                )->save($file);

                $data['main_image'] = str_replace(public_path() . '/', '', $file);
            }

            if(is_null($data['main_image'])) {
                unset($data['main_image']);
            }



            unset($data['save']);

            if ($id == 0) {
                $new = true;
                $category = $this->articlecategories->create($data);
            } else {
                $new = false;
                $category = $this->articlecategories->find($id);

                foreach ($data as $key => $val) {
                    $category->{$key} = $val;
                }

                $category->save();

            }

            return [
                'new'     => $new,
                'category' => $category
            ];

        }
    }
}