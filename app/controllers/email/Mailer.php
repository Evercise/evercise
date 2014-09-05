<?php namespace email;

use Mail, HTML;

abstract class Mailer {

	public function sendTo($email, $subject, $view, $data = array())
	{
		Mail::queue($view, $data, function($message) use($email, $subject)
		{
			$message->to($email)
					->subject($subject);
		});
	}

    public function sendToAttachment($email, $subject, $view, $data = array(),$attachment)
    {
        Mail::queue($view, $data, function($message) use($email, $subject, $attachment)
        {
            $message->to($email)
                ->subject($subject);
            $message->attach($attachment);
        });
    }

}