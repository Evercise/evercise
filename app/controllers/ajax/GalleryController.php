<?php namespace ajax;

use Illuminate\Http\Request;
use Gallery;
use Illuminate\Support\Facades\Response;


class GalleryController extends AjaxBaseController
{

    private $gallery;

    private $request;
    private $response;

    public function __construct(
        Gallery $gallery,
        Request $request,
        Response $response
    ) {

        $this->gallery = $gallery;
        $this->request = $request;
        $this->response = $response;
    }


    public function selectImage($image_id)
    {

        $image = $this->gallery->find($image_id);

        $image->update(['counter' => ($image->counter - 1)]);

        return $image->image;

    }

    public function getDefaults()
    {
        $gallery = 0;

        $find = $this->request->get('keywords', false);
        if ($find) {
            $find = explode(',',$find);
            $first = array_pull($find, 0);

            $gal = $this->gallery->where('keywords', 'like', '%'.$first.'%');

            foreach($find as $key) {
                $gal->orWhere('keywords', 'like', '%'.$key.'%');
            }

            $gallery = $gal->limit(20)->get();

        }

        if(count($gallery) == 0) {
            $gallery = $this->gallery->limit(20)->get();
        }

        return $this->response->json($gallery->toArray());
    }


}