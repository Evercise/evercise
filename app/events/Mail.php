<?php  namespace events;


use App;
use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Events\Dispatcher;
use Illuminate\Mail\Mailer;
use Exception;


class Mail
{

    private $email;
    private $log;
    private $config;
    private $event;
    private $data;

    public function __construct(
        Writer $log,
        Repository $config,
        Dispatcher $event,
        Mailer $email
    ) {

        $this->log = $log;
        $this->config = $config;
        $this->event = $event;
        $this->email = $email;


        $this->data = [
            'config'      => $this->config->get('evercise'),
            'subject'     => 'Evercise',
            'view'        => 'v3.emails.default',
            'attachments' => []
        ];

    }

    /**
     * USER EMAIL's
     */

    public function userCartCompleted($user, $cart, $transaction)
    {
        $params = [
            'subject'     => 'Congratulations',
            'view'        => 'v3.emails.user.cart_completed',
            'user'        => $user,
            'cart'        => $cart,
            'transaction' => $transaction
        ];

        $this->send($user->email, $params);
    }

    /**
     * TRAINER EMAIL's
     */

    public function classCreated($class, $trainer)
    {
        $params = [
            'subject' => 'Class created',
            'view'    => 'v3.emails.trainer.class_created',
            'trainer' => $trainer,
            'class'   => $class
        ];

        $this->send($trainer->email, $params);

    }

    public function userJoinedTrainersSession($user, $trainer, $session)
    {
        $params = [
            'subject' => 'User Joined Your Class',
            'view'    => 'v3.emails.trainer.user_joined_session',
            'trainer' => $trainer,
            'session' => $session,
            'user'    => $user
        ];

        $this->send($trainer->email, $params);

    }








    /**  DEFAULT STUFF */


    /**
     * Default Email Send Class
     * @param $email
     * @param $subject
     * @param $view
     * @param array $params
     * @param array $attachments
     */

    public function send($email, $params = [])
    {

        /** This part will be needed when we assign Functions to Pardot API
         * example config would be:
         *
         * return [
         *      'mail.classcreated' => $pardot->campayn_id
         * ]
         *
         *
         * $trace = debug_backtrace();
         * $name = $this->formatName([get_called_class(), next($trace)['function']]);
         **/


        $this->data = array_merge($this->data, $params);

        $subject = $this->data['subject'];
        $attachments = $this->data['attachments'];


        try {
            $this->email->send($this->data['view'], $this->data,
                function ($message) use ($email, $subject, $attachments) {
                    $message->to($email)->subject($subject);
                    if (count($attachments) > 0) {
                        foreach ($attachments as $attachment) {
                            $message->attach($attachment);
                        }
                    }
                });
        } catch (Exception $e) {
            $this->log->error('Email could not be sent ' . $e->getMessage());
            /** ADD HERE SOME SORT OF NOTIFICATION TO ADMINS !!!*/

        }
    }

    /**
     * Format from: events\Mail, classCreated
     * To: mail.classcreated
     */
    private function formatName($class, $function)
    {

        return strtolower(str_replace('\\', '.', implode('.', [str_replace('events\\', '', $class), $function])));
    }

}

