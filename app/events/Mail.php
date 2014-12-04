<?php  namespace events;


use App;
use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Events\Dispatcher;
use Illuminate\Mail\Mailer;
use Exception;


/**
 * Class Mail
 * @package events
 */
class Mail
{

    /**
     * @var Mailer
     */
    private $email;
    /**
     * @var Writer
     */
    private $log;
    /**
     * @var Repository
     */
    private $config;
    /**
     * @var Dispatcher
     */
    private $event;
    /**
     * @var array
     */
    private $data;

    /**
     * @param Writer $log
     * @param Repository $config
     * @param Dispatcher $event
     * @param Mailer $email
     */
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
     * ########################################################################################
     * #####            USER EMAIL's          #################################################
     * ########################################################################################
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
     * @param $user
     */
    public function welcome($user)
    {


        $params = [
            'subject' => 'Welcome to Evercise',
            'view'    => 'v3.emails.user.welcome',
            'user'    => $user
        ];

        $this->send($user->email, $params);
    }


    /**
     * @param $user
     * @param string $link
     */
    public function welcomeGuest($user, $link = '')
    {


        $params = [
            'subject' => 'Welcome to Evercise',
            'view'    => 'v3.emails.user.welcome_guest',
            'user'    => $user,
            'link'    => $link
        ];

        $this->send($user->email, $params);
    }


    /**
     * @param $user
     * @param string $link
     */
    public function welcomeFacebook($user, $link = '')
    {


        $params = [
            'subject' => 'Welcome to Evercise',
            'view'    => 'v3.emails.user.welcome_facebook',
            'user'    => $user,
            'link'    => $link
        ];

        $this->send($user->email, $params);
    }

    /**
     * @param $user
     * @param string $link
     */
    public function userForgotPassword($user, $link = '')
    {


        $params = [
            'subject' => 'Reset Password',
            'view'    => 'v3.emails.user.forgot_password',
            'user'    => $user,
            'link'    => $link
        ];

        $this->send($user->email, $params);
    }

    /**
     * @param $user
     */
    public function userChangedPassword($user)
    {
        $params = [
            'subject' => 'Evercise password reset confirmation',
            'view'    => 'v3.emails.user.changed_password',
            'user'    => $user
        ];

        $this->send($user->email, $params);
    }

    /**
     * @param $user
     */
    public function userUpgrade($user)
    {


        $params = [
            'subject' => 'Welcome! Start selling classes on Evercise.',
            'view'    => 'v3.emails.user.upgrade',
            'user'    => $user
        ];

        $this->send($user->email, $params);

    }

    /**
     * @param $email
     * @param $referralCode
     * @param $referrerName
     */
    public function invite($email, $referralCode, $referrerName)
    {


        $params = [
            'subject'      => $referrerName . ' thinks you should join Evercise!',
            'view'         => 'v3.emails.user.invite',
            'email'        => $email,
            'referralCode' => $referralCode,
            'referrerName' => $referrerName
        ];

        $this->send($email, $params);

    }

    /**
     * @param $email
     * @param $categoryId
     * @param $ppcCode
     */
    public function ppc($email, $categoryId, $ppcCode)
    {


        $params = [
            'subject'    => 'Pay as you go fitness!',
            'view'       => 'v3.emails.user.ppc',
            'email'      => $email,
            'categoryId' => $categoryId,
            'ppcCode'    => $ppcCode
        ];

        $this->send($email, $params);

    }


    /**
     * ########################################################################################
     * #####          TRAINER EMAIL's         #################################################
     * ########################################################################################
     */



    /**
     * @param $trainer
     */
    public function trainerRegistered($trainer)
    {
        $params = [
            'subject' => 'Evercise trainer verification',
            'view'    => 'v3.emails.trainer.registered',
            'trainer' => $trainer
        ];

        $this->send($trainer->email, $params);


    }

    /**
     * @param $class
     * @param $trainer
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

    /**
     * @param $user
     * @param $trainer
     * @param $session
     */
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












    /**
     * ########################################################################################
     * #####          DEFAULT STUFF           #################################################
     * ########################################################################################
     */

    /**
     * @param $email
     * @param array $params
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

