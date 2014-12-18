<?php


ini_set('gd.jpeg_ignore_warning', TRUE);

use Illuminate\Console\Command;

use Symfony\Component\Debug\Exception\FatalErrorException;


class GalleryImport extends Command
{

    protected $name = 'images:gallery';

    protected $description = 'Move All Gallery Images';


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

        Gallery::truncate();


        $files = File::allFiles(base_path() . '/public/files/gallery_defaults/');

        foreach ($files as $file) {
            @unlink($file);
        }

        $this->info('ALL files Deleted');

        $folders = ['Bootcamp', 'Dance', 'Martial Arts', 'Yoga', 'Pilates', 'Spin', 'Workout'];

        foreach ($folders as $folder) {

            $files = File::allFiles(base_path() . '/public/files/gallery_new/' . $folder);


            $sizes = Config::get('evercise.gallery.sizes');

            $this->info(count($files));
            foreach ($files as $file) {

                $name = slugIt($folder . '_' . rand(1000, 60000)) . '.' . $file->getExtension();
                /** Save the image name without the Prefix to the DB */

                $save = FALSE;
                foreach ($sizes as $img) {

                    try {
                        $image = Image::make($file)->fit(
                            $img['width'],
                            $img['height']
                        )->save(public_path() . '/files/gallery_defaults/' . $img['prefix'] . '_' . $name);

                        if ($image) {
                            $save = TRUE;

                            $this->line($img['prefix'] . '_' . $name);
                        }
                    } catch (Exception $e) {
                        $this->error(base_path() . '/public/files/gallery_new/' . $folder . '/' . $file);
                        $this->error($e->getMessage());
                    }

                }

                if ($save) {
                    Gallery::create(['image'    => $name,
                                     'counter'  => Config::get('evercise.gallery.image_counter', 3),
                                     'keywords' => $folder
                        ]);

                    $this->info('/files/gallery_defaults/thumb_' . $name);
                }
            }
        }


    }
}