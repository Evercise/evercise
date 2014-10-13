<?php namespace widgets;

use Auth, BaseController, Input,  Sentry, View, Response, Validator, Image, Config, Trainer, Str;

class ImageController extends \BaseController {

    protected $layout = 'widgets.upload-form';

    public function getUploadForm() {
        return View::make('widgets/upload-form');
    }

    public function postUpload() {
        //return Response::json('woo');
        $file = Input::file('image');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );

        if (!isset($file))
            return Response::json(['success' => false, 'errors' => ['image'=>'Image exceeds the limit of 2Mb']]);

        if ($file->getSize() > Config::get('image')['max_size'])
            return Response::json(['success' => false, 'errors' => ['image'=>'Image exceeds the limit of 2Mb']]);

        if ($file->getMimeType() == 'image/x-ms-bmp')
            return Response::json(['success' => false, 'errors' => ['image'=>'The image format is not supported.']]);


        $validator = Validator::make($input, $rules);
        if ( $validator->fails() )
        {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        }
        else {

            $destinationPath = 'profiles/'.Sentry::getUser()->directory;

            // change file name
            $filename = $file->getClientOriginalName();
            $filename = Str::slug(' ', '_', $filename);
            $ext = $file->getClientOriginalExtension();
            $filename = pathinfo($filename, PATHINFO_FILENAME);
            $filename = substr($filename, 0, 20); // Truncate file name to 20 characters
            $filename = $filename.'.'.$ext;


            $file->move($destinationPath, $filename);

            $viewString = View::make('widgets/crop')->__toString();
            $imgSrc = url('/') .'/'. $destinationPath . '/' . $filename;
            $postCrop = url('/').'/widgets/crop';

            return Response::json(array('crop'=>$viewString, 'image_url' => $imgSrc , 'postCrop' => $postCrop));

        }
    }
    public function getCrop() {
        /******* ASPECT RATIO = (2.35 : 1) *******/

        //Don't forget to initialise the JS (initImage) from the containing controller
        return View::make('widgets/crop');

    }

    public function postCrop() {
        $pos_x = Input::get('pos_x');
        $pos_y = Input::get('pos_y');
        $width = Input::get('width');
        $height = Input::get('height');
        $img_url = Input::get('img_url');
        $img_height = Input::get('img_height');
        $label = Input::get('label');
        $fieldtext = Input::get('fieldtext');


        $user = Sentry::getUser();
        $save_location = $user->directory;

        $img_name = basename($img_url);
        $ext = pathinfo($img_url, PATHINFO_EXTENSION);
        // open file a image resource
        $img_path = public_path() . '/profiles/' . $save_location;

        $img = Image::make($img_path. '/' .$img_name);

        $true_height = $img->height();

        $factor = $true_height / $img_height;
        $scaledCoords = $this->scale($factor, array('width'=>$width, 'height'=>$height, 'pos_x'=>$pos_x, 'pos_y'=>$pos_y));

        // crop image
        $img->crop($scaledCoords['width'], $scaledCoords['height'], $scaledCoords['pos_x'], $scaledCoords['pos_y']);

        $increment = 0;

        while(file_exists($img_path.'/'.(Trainer::isTrainerLoggedIn() ? 'trainers' : 'users').'-'.Str::slug($user->display_name) .'-'. $increment . '.' . $ext)) {
            $increment++;
        }

        $thumbFilename = (Trainer::isTrainerLoggedIn() ? 'trainers' : 'users').'-'.Str::slug($user->display_name) .'-'. $increment . '.' . $ext;
        $fileNameWithPath = '/profiles/' . $save_location . '/'.$thumbFilename;
        $img->save(public_path() . $fileNameWithPath);

        $viewString = View::make('widgets/upload-form')->with('uploadImage',$fileNameWithPath )->with('label',$label )->with('fieldtext',$fieldtext )->__toString();
        $newImage = url('/') . $fileNameWithPath;
        return Response::json(array('uploadView'=>$viewString,'newImage' => $newImage, 'thumbFilename' => $thumbFilename ));
    }

    public function scale($factor, $params)
    {
        $scaledParams = array();
        foreach ($params as $key => $value)
        {
            $scaledParams[$key] = (int) round($value * $factor);
        }
        return $scaledParams;
    }
}