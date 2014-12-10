<?php namespace ajax;

use Illuminate\Http\Request;
use Gallery;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;


class GalleryController extends AjaxBaseController
{

    private $gallery;

    private $request;
    private $response;

    private $view;

    public function __construct(
        Gallery $gallery,
        Request $request,
        Response $response,
        View $view
    ) {

        $this->gallery = $gallery;
        $this->request = $request;
        $this->response = $response;
        $this->view = $view;
    }


    public function getDefaults()
    {
        $gallery = 0;

        $find = $this->request->get('keywords', FALSE);
        if ($find) {
            $find = explode(',', $find);

            $gallery = $this->gallery->where('counter', '>', 0)
            ->where(function($query) use ($find)
            {
                foreach ($find as $key) {
                    $query->orWhere('keywords', 'like', '%' . $key . '%');
                }
            })
            ->limit(20)->get();
        }

        if (count($gallery) == 0) {
            $gallery = $this->gallery->where('counter', '>', 0)->limit(20)->get();
        }

        //return $this->response->json($gallery->toArray());
        return $this->response->json([
            'view' => View::make('v3.widgets.class_gallery_row')->with('gallery', $gallery->toArray())->render()
        ]);
    }


}