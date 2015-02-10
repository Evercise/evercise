<?php namespace ajax;

use Sentry;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Illuminate\Validation\Factory as Validator;
use Intervention;
use VenueImages;
use Venue;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManager;


class UploadController extends AjaxBaseController
{


    private $config;
    private $file;
    private $request;
    private $string;
    private $response;
    private $validator;

    private $image;

    private $venue;
    private $venueImages;
    private $sentry;

    private $data = [];
    private $user;

    public function __construct(
        Filesystem $file,
        Request $request,
        VenueImages $venueImages,
        Venue $venue,
        Repository $config,
        Str $string,
        Response $response,
        Validator $validator,
        ImageManager $image
    ) {

        $this->file = $file;
        $this->request = $request;
        $this->venue = $venue;
        $this->venueImages = $venueImages;
        $this->image = $image;
        $this->config = $config;
        $this->string = $string;
        $this->response = $response;
        $this->validator = $validator;

        $this->user = Sentry::getUser();
    }


    /** TO DO */
    public function hasPermissions($object, $type = 'venue')
    {

        if ($this->user->hasAccess('admin')) {
            return true;
        }

        switch ($type) {
            case 'venue':
                if ($object->user_id == $this->user->id) {
                    return true;
                }
                break;


        }
        return false;
    }

    /**
     * Upload Images for Venues
     *
     * @return string
     */
    public function uploadVenueImage()
    {
        $id = $this->request->get('venue_id');
        $venue = $this->venue->find($id);

        $user = $venue->user()->first();

        if (!$this->hasPermissions($venue)) {
            $this->data = [
                'error' => true,
                'messages' => 'You don\'t have permissions to upload photos for this venue'
            ];
            return $this->response->json($this->data);
        }

        $file = $this->request->file('file');

        $validator = $this->validator->make(
            $this->request->except('_token'),
            [
                'venue_id' => 'required|numeric',
                'file' => 'mimes:jpeg,gif,png,bmp,tiff'
            ]);


        if ($validator->fails()) {
            $this->data = [
                'error' => true,
                'messages' => $validator->messages()
            ];

            /** Send back the Errors */

            return $this->response->json($this->data);

        } else {

            /** Required Image Sizes */
            $sizes = $this->config->get('evercise.venue_images');


            /** HashDirectory of the new gallery */
            $folder = $user->directory;

            /** New Slug for the Image */
            $slug = $this->string->slug(implode(' ', [$venue->name, $venue->town, $venue->postcode, rand(1, 300)]));

            $file_name = $slug . '.' . $file->getClientOriginalExtension();
            $thumb_file_name = $slug . '.' . 'thumb_' . $slug . '.' . $file->getClientOriginalExtension();

            /** Save the files to the server */
            $this->file->put($folder . '/' . $file_name,
                $this->image->make($file)->fit($sizes['regular']['width'], $sizes['regular']['height']));
            $this->file->put($folder . '/' . $thumb_file_name,
                $this->image->make($file)->fit($sizes['thumb']['width'], $sizes['thumb']['height']));

            $data = [
                'venue_id' => $venue->id,
                'file' => $folder . '/' . $file_name,
                'thumb' => $folder . '/' . $thumb_file_name
            ];
            $image = $this->venueImages->create($data);

            return $image->toJson();
        }

    }


    public function deleteVenueImage()
    {
        $image_id = $this->request->get('image_id');

        $validator = $this->validator->make(
            $this->request->except('_token'),
            [
                'image_id' => 'required|numeric'
            ]
        );


        if ($validator->fails()) {
            $this->data = [
                'error' => true,
                'messages' => 'We need a Image ID'
            ];
            return $this->response->json($this->data);
        }

        $venueImage = $this->venueImages->find($image_id);
        $venue = $this->venue->find($venueImage->venue_id);

        if (!$this->hasPermissions($venue)) {
            $this->data = [
                'error' => true,
                'messages' => 'You don\'t have permissions to upload photos for this venue'
            ];
            return $this->response->json($this->data);
        }


        if ($this->file->delete($venueImage->file)) {
            $this->file->delete($venueImage->thumb);

            $venueImage->delete();


            return $this->response->json(['message' => 'Image deleted', 'id' => $image_id]);
        }

        $this->data = [
            'error' => true,
            'messages' => 'We could not delete the image ' . $venueImage->file
        ];

        return $this->response->json($this->data);
    }



    public function uploadCover() {
        return $this->upload('class_images');
    }

    public function uploadProfilePicture() {
        return $this->upload('user_images');
    }


    private function upload($type)
    {

        $validator = $this->validator->make(
            $this->request->except('_token'),
            [
                'x' => 'required|numeric',
                'y' => 'required|numeric',
                'width' => 'required|numeric',
                'height' => 'required|numeric',
                'box_width' => 'required|numeric',
                'box_height' => 'required|numeric',
                'file' => 'required|mimes:jpeg,gif,png'
            ]
        );


        /** Did it faiL? */
        if ($validator->fails()) {
            $this->data = [
                'error' => true,
                'messages' => $validator->messages()
            ];
            return $this->response->json($this->data);
        }

        $upload_file = $this->request->file('file');

        $user_id = $this->request->get('user_id', $this->user->id);

        $user = Sentry::findUserById($user_id);

        $file = $this->image->make($upload_file->getRealPath());

        $sizes = $this->config->get('evercise.'.$type);


        $folder = $user->directory;



        /**Calculate the crop ration based on the original image */
        $crop_width = $this->request->get('width');
        $crop_height = $this->request->get('height');


        /**Crop locations calculate */
        $crop_x = $this->request->get('x');
        $crop_y = $this->request->get('y');


        $image = $file->crop((int)$crop_width, (int)$crop_height, (int)$crop_x, (int)$crop_y);

        /** New Slug for the Image */
        $slug = slugIt($user->display_name);


        $file_name = false;

        foreach($sizes as $s) {


            if(!$file_name) {
                $file_name = uniqueFile(public_path() . '/' . $folder . '/', $s['prefix'] . '_' . $slug,
                    $upload_file->getClientOriginalExtension());

                $real_name = str_replace($s['prefix'] . '_', '', $file_name);
            }

            $file_name = $s['prefix'].'_'.$real_name;
            $image->fit($s['width'], $s['height'])->save(public_path() . '/' . $folder . '/'.$file_name);


        }

        return $this->response->json(['file' => $folder . '/' . $real_name, 'filename' => $real_name, 'folder' => $folder]);


    }
    private function uploadWithoutCrop()
    {

        $validator = $this->validator->make(
            $this->request->except('_token'),
            [
                'file' => 'required|mimes:jpeg,gif,png'
            ]
        );


        /** Did it faiL? */
        if ($validator->fails()) {
            $this->data = [
                'error' => true,
                'messages' => $validator->messages()
            ];
            return $this->response->json($this->data);
        }

        $upload_file = $this->request->file('file');

        $user_id = $this->request->get('user_id', $this->user->id);

        $user = Sentry::findUserById($user_id);

        $file = $this->image->make($upload_file->getRealPath());

        $folder = $user->directory;

        $file_name = 'temp';

        return $this->response->json(['file' => $folder . '/' . $file_name, 'filename' => $file_name, 'folder' => $folder]);


    }

    /**
     * @param string $file
     * @param array $params
     * @return bool|string
     *
     *
            $ajax = App::make('ajax\UploadController');

            die($ajax->renameFile('files/gallery/61/35/thumb_igor-matkovic-72.JPG', ['some'=> 'param', 'name' => 'what is this lololo', 'car'=>'tetstet']));
     */

    public function renameFile($file = '', array $params = [])
    {
        if (!empty($file) && count($params) > 0) {
            $new_file = substr(Str::slug(implode(' ', array_values($params))), 0, 40);

            $ext = pathinfo($file);

            if (!empty($ext['extension'])) {

                $new_file = $ext['dirname'] . '/' . $new_file . '.' . $ext['extension'];

                try {
                    rename($file, $new_file);
                    return $new_file;
                } catch (\Exception $e) {
                    return false;
                }
            }
        }

        return false;
    }

}