<?php namespace widgets;

use Auth, BaseController, Form, Input, Redirect, Sentry, View, Request, Response, Validator, Image;
 
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

     //   return Response::json(['success' => false, 'errors' => 'ddd');


        //return Response::json(['success' => false, 'errors' => ['suck'=>$file]]);

        $validator = Validator::make($input, $rules);
        if ( $validator->fails() )
        {
            if(Request::ajax())
            { 
                return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
            }
        }
        else {

            $user = Sentry::getUser();
            $destinationPath = 'profiles/'.$user->directory;


            // INTERMITTENT BUG - $file is sometimes null, so the following line fails. No idea why. Please fix
            // for some reason adding a trace funcion to the javascript has seemed to solve this
            $filename = $file->getClientOriginalName();
            $filename = str_replace(' ', '_', $filename);
            $ext = '';
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $filename = pathinfo($filename, PATHINFO_FILENAME);
            $filename = substr($filename, 0, 20); // Truncate file name to 20 characters
            $filename = $filename.'.'.$ext;

            Input::file('image')->move($destinationPath, $filename);
            
            
            if(Request::ajax())
            { 
                $viewString = View::make('widgets/crop')->__toString();
                $imgSrc = url('/') .'/'. $destinationPath . '/' . $filename;
               // $postCrop = Response::json(route('image.crop.post'));
                $postCrop = url('/').'/widgets/crop';
                return Response::json(array('crop'=>$viewString, 'image_url' => $imgSrc , 'postCrop' => $postCrop));
            }
            else
            {
                return Response::json($file);
            }
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
        // open file a image resource
        $img_path = public_path() . '/profiles/' . $save_location . '/' .$img_name;
        
        $img = Image::make($img_path);
        $true_height = $img->height();

        $factor = $true_height / $img_height;
        $scaledCoords = $this->scale($factor, array('width'=>$width, 'height'=>$height, 'pos_x'=>$pos_x, 'pos_y'=>$pos_y));

        //return Response::json(array('uploadView'=>$scaledCoords['pos_x']));

        // crop image
        $img->crop($scaledCoords['width'], $scaledCoords['height'], $scaledCoords['pos_x'], $scaledCoords['pos_y']);
        //$img->crop(200, 200, 600, 600);

        $timestamp = date_create();

        $thumbFilename = date_timestamp_get($timestamp).'_'.$img_name;
        $fileNameWithPath = '/profiles/' . $save_location . '/'.$thumbFilename;
        $img->save(public_path() . $fileNameWithPath);

        if(Request::ajax())
        { 

            //return Response::json(array('imgName' => $thumbFilename ));
            $viewString = View::make('widgets/upload-form')->with('uploadImage',$fileNameWithPath )->with('label',$label )->with('fieldtext',$fieldtext )->__toString();
           // return Response::json(array('uploadView'=>$viewString));
            $newImage = url('/') . $fileNameWithPath;
            return Response::json(array('uploadView'=>$viewString,'newImage' => $newImage, 'thumbFilename' => $thumbFilename ));
        }
        //return View::make('widgets/crop');
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