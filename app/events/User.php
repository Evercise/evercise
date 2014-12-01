<?php  namespace events;


use Log;

class User
{

    public function hasRegistered($user)
    {
        Log::info('User '.$user->id.' has registered');
    }


    public function trainerClassJoined($user, $trainer, $evercisesession){

        Log::info('User '.$user->id.' has registered a class with trainer '.$trainer->id.' for class '.$evercisesession->id);
    }


    public function cartCompleted($user, $cart, $transaction){


        Log::info('User '.$user->id.' cart completed');

        /** SEND EMAIL */



    }
} 