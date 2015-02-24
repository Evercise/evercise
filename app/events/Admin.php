<?php  namespace events;


use Log;

class Admin
{

    public function hasCreatedTrainer($user, $trainer)
    {
        Log::info('Admin Created a Trainer with id '.$user->id);

        $resetCode = $user->getResetPasswordCode();

        \Mail::send('emails.admin.createTrainer', compact('user', 'trainer', 'resetCode'), function($message) use($user)
        {
            $message->to($user->email)
                ->subject('Welcome to Evercise');
        });


    }
}