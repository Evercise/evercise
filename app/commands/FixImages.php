<?php


ini_set('gd.jpeg_ignore_warning', TRUE);

use Illuminate\Console\Command;

use Symfony\Component\Debug\Exception\FatalErrorException;


class FixImages extends Command
{

    protected $name = 'images:fix';

    protected $description = 'Fix Missing Images';


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


        $users = User::all();


        $sizes = Config::get('evercise.user_images');


        foreach ($users as $user) {

            $this->line('Starting user '.$user->display_name);
            $done = FALSE;

            foreach ($sizes as $s) {
                if ($done) {
                    break;
                }
                foreach(range(1, 10) as $num) {
                    $file_name = slugIt(implode(' ', [$user->display_name, $num]));
                    $name = $s['prefix'] . '_' . $file_name;
                    $full = 'public/' . $user->directory . '/' . $name;

                    if (file_exists($full.'.jpg')) {
                        $user->image = $file_name.'.jpg';

                        $this->line('Fixed '.$user->directory . '/' . $name);
                        $user->save();
                        $done = TRUE;
                        break;
                    }
                    if (file_exists($full.'.png')) {
                        $user->image = $file_name.'.png';

                        $this->line('Fixed '.$user->directory . '/' . $name);
                        $user->save();
                        $done = TRUE;
                        break;
                    }
                }
            }

        }

    }
}