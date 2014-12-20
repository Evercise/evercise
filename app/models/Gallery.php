<?php

class Gallery extends Eloquent
{

    protected $table = 'gallery_defaults';
    protected $fillable = ['counter', 'keywords', 'image'];
    protected $hidden = ['created_at', 'updated_at'];


    public static function selectImage($image_id = 0, $user, $class_name)
    {
        $item = static::find($image_id);
        $item->decrement('counter');
        $item->save();


        $extension = explode('.', $item->image);
        $extension = end($extension);

        $name = slugIt($class_name);



        foreach (Config::get('evercise.class_images') as $img) {

            $file_name = uniqueFile(public_path() . '/' . $user->directory . '/', $img['prefix'] . '_' . $name, $extension);
            $image = Image::make('files/gallery_defaults/' . 'main_' . $item->image)->fit(
                $img['width'],
                $img['height']
            )->save(public_path() . '/' . $user->directory . '/'.$file_name);

            $real_name = str_replace($img['prefix'] . '_', '', $file_name);

        }

        return $real_name;

    }


}