<?php  namespace events;


class User
{

    public function hasRegistered($user)
    {
        Log::info('User '.$user->id.' has registered');
    }
} 