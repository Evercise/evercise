<?php  namespace events;


use App;
use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Events\Dispatcher;
use Illuminate\Mail\Mailer;
use Illuminate\View\Factory as View;
use Illuminate\Routing\UrlGenerator;
use Exception;

use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;


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
     * @var View
     */
    private $view;

    /**
     * @param Writer $log
     * @param Repository $config
     * @param Dispatcher $event
     * @param Mailer $email
     * @param View $view
     */
    public function __construct(
        Writer $log,
        Repository $config,
        Dispatcher $event,
        Mailer $email,
        View $view,
        UrlGenerator $url
    ) {

        $this->log = $log;
        $this->config = $config;
        $this->event = $event;
        $this->email = $email;
        $this->view = $view;
        $this->url = $url;

        $this->banner_types = [
            'upsell_signup' => [
                'image' => $this->url->to('assets/img/email/user_upsell_signup_today.png'),
                'url'   => $this->url->to('/'),
                'title' => 'SignUp Today and Receive £5'
            ],

        ];

        $this->data = [
            'config'       => $this->config->get('evercise'),
            'subject'      => 'Evercise',
            'title'        => FALSE,
            'view'         => 'v3.emails.default',
            'attachments'  => [],
            'unsubscribe'  => '%%unsubscribe%%',
            'link_url'     => $this->url->to('/'),
            'image'        => 'http://evertest.evercise.com/assets/img/default_email.jpg',
            'banner'       => FALSE,
            'banner_types' => $this->banner_types,
            'css' => file_get_contents('./assets/css/mail.css')
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
            'subject'  => 'Welcome to Evercise',
            'title'    => 'Welcome to Evercise!',
            'view'     => 'v3.emails.user.welcome',
            'user'     => $user,
            'banner'   => 'upsell_signup',
            'image'    => 'http://evercise.com/some_image.jpg',
            'link_url' => $this->url->to('/')
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
     * @param $userList
     * @param $group
     * @param $location
     * @param $dateTime
     * @param $trainerName
     * @param $trainerEmail
     * @param $classId
     */
    public function usersSessionRemind($userList, $group, $location, $dateTime, $trainerName, $trainerEmail, $classId)
    {
        foreach ($userList as $name => $email) {

            $params = [
                'subject'      => 'Evercise class reminder',
                'view'         => 'v3.emails.user.session_remind',
                'userList'     => $userList,
                'group'        => $group,
                'location'     => $location,
                'name'         => $name,
                'email'        => $email,
                'dateTime'     => $dateTime,
                'trainerName'  => $trainerName,
                'trainerEmail' => $trainerEmail,
                'classId'      => $classId
            ];

            $this->send($email, $params);
        }
    }


    /**
     * @param $user
     * @param $trainer
     * @param $everciseGroup
     * @param $sessionDate
     */
    public function userLeaveSession($user, $trainer, $everciseGroup, $sessionDate)
    {
        $params = [
            'subject'       => 'Sorry to see you leave',
            'view'          => 'v3.emails.user.session_left',
            'user'          => $user,
            'trainer'       => $trainer,
            'everciseGroup' => $everciseGroup,
            'sessionDate'   => $sessionDate,
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
     * @param $email
     * @param $userName
     * @param $userEmail
     * @param $group
     * @param $messageSubject
     * @param $messageBody
     */
    public function userRequestRefund($email, $userName, $userEmail, $group, $messageSubject, $messageBody)
    {
        $params = [
            'subject'        => 'Evercise refund request',
            'view'           => 'v3.emails.user.request_refund',
            'email'          => $email,
            'userName'       => $userName,
            'userEmail'      => $userEmail,
            'group'          => $group,
            'messageSubject' => $messageSubject,
            'messageBody'    => $messageBody
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
     * @param $evercisegroup
     * @internal param $session
     */
    public function userJoinedTrainersSession($user, $trainer, $evercisegroup)
    {
        $params = [
            'subject'       => 'User Joined Your Class',
            'view'          => 'v3.emails.trainer.user_joined_session',
            'trainer'       => $trainer,
            'evercisegroup' => $evercisegroup,
            'user'          => $user
        ];

        $this->send($trainer->email, $params);

    }


    /**
     * @param $userList
     * @param $group
     * @param $location
     * @param $dateTime
     * @param $trainerName
     * @param $trainerEmail
     * @param $classId
     */
    public function trainerSessionRemind($userList, $group, $location, $dateTime, $trainerName, $trainerEmail, $classId)
    {
        $params = [
            'subject'      => 'Class reminder & participant list',
            'view'         => 'v3.emails.trainer.session_remind',
            'userList'     => $userList,
            'group'        => $group,
            'location'     => $location,
            'dateTime'     => $dateTime,
            'trainerName'  => $trainerName,
            'trainerEmail' => $trainerEmail,
            'classId'      => $classId
        ];

        $this->send($trainerEmail, $params);
    }

    /**
     * @param $trainer
     * @param $userList
     * @param $group
     * @param $messageSubject
     * @param $messageBody
     */
    public function trainerMailAll($trainer, $userList, $group, $messageSubject, $messageBody)
    {

        foreach ($userList as $name => $email) {
            $params = [
                'subject'        => 'You have a new message',
                'view'           => 'v3.emails.trainer.mail_all',
                'trainer'        => $trainer,
                'name'           => $name,
                'email'          => $email,
                'userList'       => $userList,
                'group'          => $group,
                'messageSubject' => $messageSubject,
                'messageBody'    => $messageBody
            ];

            $this->send($email, $params);
        }

    }


    /**
     * @param $user
     * @param $trainer
     * @param $everciseGroup
     * @param $sessionDate
     */
    public function trainerLeaveSession($user, $trainer, $everciseGroup, $sessionDate)
    {
        $params = [
            'subject'       => 'Someone has left your class',
            'view'          => 'v3.emails.trainer.session_left',
            'user'          => $user,
            'trainer'       => $trainer,
            'everciseGroup' => $everciseGroup,
            'sessionDate'   => $sessionDate,
        ];

        $this->send($user->email, $params);

    }


    /**
     * @param $user
     * @param $trainer
     * @param $evercisegroup
     */
    public function trainerJoinSession($user, $trainer, $evercisegroup)
    {

        $params = [
            'subject'       => 'A User just Joined your Class',
            'view'          => 'v3.emails.trainer.user_joined_class',
            'user'          => $user,
            'trainer'       => $trainer,
            'evercisegroup' => $evercisegroup
        ];

        $this->send($user->email, $params);

    }


    /**
     * @param $trainer
     * @param $user
     * @param $group
     * @param $dateTime
     * @param $messageSubject
     * @param $messageBody
     */
    public function mailTrainer($trainer, $user, $group, $dateTime, $messageSubject, $messageBody)
    {
        Log::error("TO DO");

        return;
        $params = [
            'subject'        => 'You have a new message',
            'view'           => 'v3.emails.trainer.mail_trainer',
            'trainer'        => $trainer,
            'user'           => $user,
            'dateTime'       => $dateTime,
            'name'           => $name,
            'email'          => $email,
            'group'          => $group,
            'messageSubject' => $messageSubject,
            'messageBody'    => $messageBody
        ];

        $this->send($email, $params);
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
         *  'campayns' = [
         *      'mail.mailwelcome' =>3598
         * ]
         * ]
         *
         *
         **/

        $this->data = array_merge($this->data, $params);

        $subject = $this->data['subject'];
        $attachments = $this->data['attachments'];

        $view = $this->view->make($this->data['view'], $this->data)->render();

        // Parse it all Inline
        $parse = new CssToInlineStyles($view, $this->data['css']);

        $content = $parse->convert();



        if ($this->config->get('pardot.active')) {

            $trace = debug_backtrace();
            $name = $this->formatName(get_called_class(), next($trace)['function']);

            $campayn_id = $this->config->get('pardot.campayns.' . $name);
        }

        if (!empty($campayn_id) && FALSE) {
            $pardotEmail = new \PardotEmail([
                'subject' => $subject,
                'content' => $content
            ]);

            $pardot = new \Pardot();

            try {
                $pardot->send($email, $campayn_id, $pardotEmail);
            } catch (Exception $e) {
                $this->log->error('Pardot Email could not be sent ' . $e->getMessage());
                /** ADD HERE SOME SORT OF NOTIFICATION TO ADMINS !!!*/

            }

        } else {
            try {
                $this->email->send('v3.emails.blank', ['content' => $content],
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

    }

    /**
     * Format from: events\Mail, classCreated
     * To: mail.classcreated
     * @param $class
     * @param $function
     * @return string
     */
    private function formatName($class, $function)
    {
        return strtolower(str_replace('\\', '.', implode('.', [str_replace('events\\', '', $class), $function])));
    }
}

