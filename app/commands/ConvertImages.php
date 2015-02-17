<?php


ini_set('gd.jpeg_ignore_warning', true);

use Illuminate\Console\Command;

use Symfony\Component\Debug\Exception\FatalErrorException;


class ConvertImages extends Command
{

    protected $name = 'images:move';

    protected $description = 'Convert Class Images to the new format';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */


    public function fire()
    {


        $user_completed = [];
        $users = User::all();


        $sizes = Config::get('evercise.user_images');


        foreach($users as $user) {

            $dir = hashDir($user->id, 'u');
            $user_completed[$user->id] = $user->directory;




            $user->directory = $dir;
            $user->save();

            $user_file_name = slugIt(implode(' ', [$user->display_name, rand(1, 10)]));
            if (!empty($user->image) && strpos($user->image, '.') !== false) {
                $extension = explode('.', $user->image);
                $user_file_name .= '.' . end($extension);


                try {
                    $this->info('public/profiles/' . $user_completed[$user->id] . '/' . $user->image);
                    $file = Image::make('public/profiles/' . $user_completed[$user->id] . '/' . $user->image);
                } catch (Exception $e) {
                    $this->error('Crap ' . $e->getMessage());
                    $this->error('public/profiles/' . $user_completed[$user->id] . '/' . $user->image);
                    continue;
                }




                if ($file) {

                    /** Save the images */

                    foreach ($sizes as $s) {
                        $file_name = $s['prefix'] . '_' . $user_file_name;
                        try {
                            $this->info('public/profiles/' . $user_completed[$user->id] . '/' . $user->image);
                            $file->fit($s['width'], $s['height'])->save('public/' . $dir . '/' . $file_name);
                            $this->info('Success  public/' . $dir . '/' . $file_name);
                        } catch (Exception $e) {
                            $this->error('Crap ' . $e->getMessage());
                            $this->error('public/' . $dir . '/' . $file_name);
                            continue;
                        }
                    }
                    $user->image = $user_file_name;
                    $this->info('Success  public/' . $dir . '/' . $user_file_name);

                } else {
                    $this->error('Shit... Failed User Image');
                    $this->error('Copy From: public/profiles/' . $user_completed[$user->id] . '/' . $user->image);
                    $this->error('Copy To: public/' . $dir . '/' . $user_file_name);
                }
            }
        }




        $all = Evercisegroup::all();


        foreach ($all as $a) {


            $user = $a->user()->first();


            if (!isset($user->id)) {
                continue;
            }

            $dir = hashDir($user->id, 'u');



            /** Im Going TO Just copy the file to the new place.... just in case */

            $title = [
                $a->name,
                (!empty($user->display_name) ? $user->display_name : $user->first_name . ' ' . $user->last_name),
                rand(1, 100)
            ];

            $extension = explode('.', $a->image);


            $sizes = Config::get('evercise.class_images');

            $slug = slugIt(implode(',', $title)) . '.' . end($extension);


            try {
                $this->info('public/profiles/' . $user_completed[$user->id] . '/' . $a->image);
                $file = Image::make('public/profiles/' . $user_completed[$user->id] . '/' . $a->image);
            } catch (Exception $e) {
                $this->error('Crap ' . $e->getMessage());
                $this->error('public/profiles/' . $user_completed[$user->id] . '/' . $a->image);
                continue;
            }


            if ($file) {

                /** Save the images */
                foreach ($sizes as $s) {
                    $file_name = $s['prefix'] . '_' . $slug;
                    try {

                        $this->info('public/' . $dir . '/' . $file_name);
                        $file->fit($s['width'], $s['height'])->save('public/' . $dir . '/' . $file_name);
                        $this->info('Success  public/' . $dir . '/' . $file_name);

                    } catch (Exception $e) {
                        $this->error('Crap ' . $e->getMessage());
                        $this->error('public/' . $dir . '/' . $file_name);
                        continue;
                    }
                }

                $a->image = $slug;
                $a->save();

            } else {
                $this->error('Shit... Failed');
                $this->error('Copy From: public/profiles/' . $dir . '/' . $slug);
            }

        }
    }
}