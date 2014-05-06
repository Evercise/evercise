<?php
 
class ImageController extends \BaseController {
 
    public function getUploadForm() {
        return View::make('image/upload-form');
    }
 
    public function postUpload() {
        $file = Input::file('image');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
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

            $filename = $file->getClientOriginalName();
            Input::file('image')->move($destinationPath, $filename);
            
            
            if(Request::ajax())
            { 
                //return Response::json($destinationPath.$filename);
                //return View::make('image/crop');
                //return Response::route('image.crop');
                //return \Response::json(route('image.crop', $destinationPath.$filename));
                return \Response::json(View::make('image/crop')); //WHAT THE DICK? I just want to return a view
            }
            else
            {
                return Response::json($file);
            }
        }
    }
    public function crop() {
    }
    public function postCrop() {
    }
}