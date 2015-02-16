<?php namespace events;


use App;
use Cartalyst\Sentry\Sentry;
use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Events\Dispatcher;
use Illuminate\Mail\Mailer;
use Illuminate\View\Factory as View;
use Illuminate\Routing\UrlGenerator;
use Exception;
use EmailOut;
use Evercisegroup;

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
                'title' => 'Sign Up Today and Receive £5'
            ],
            'welcome'       => [
                'image' => $this->url->to('assets/img/email/user_upsell_signup_today.png'),
                'url'   => $this->url->to('/'),
                'title' => 'Sign Up Today and Receive £5'
            ],
            'refer_someone' => [
                'image' => $this->url->to('assets/img/email/referal_banner_blue.png'),
                'url'   => $this->url->to('/uk/london'),
                'title' => 'refer someone Today and Receive £5'
            ],
            'packages'      => [
                'image' => $this->url->to('assets/img/email/user_upsell_package.png'),
                'url'   => $this->url->to('/packages'),
                'title' => 'save money by purchasing a 5 or 10 class package'
            ]
        ];


        $this->data = [
            'config'       => $this->config->get('evercise'),
            'subject'      => 'Evercise',
            'title'        => FALSE,
            'view'         => 'v3.emails.default',
            'attachments'  => [],
            'unsubscribe'  => '%%unsubscribe%%',
            'link_url'     => $this->url->to('/'),
            'image'        => image('assets/img/email/user_default.jpg', 'Evercise'),
            'banner'       => FALSE,
            'banner_types' => $this->banner_types,
            'style'        => 'pink',
            'css'          => file_get_contents((php_sapi_name() === 'cli' ? './public/' : './') . 'assets/css/mail.css')
        ];

    }


    /*
     * ########################################################################################
     * #####            USER EMAIL's          #################################################
     * ########################################################################################
     */

    /**
     * @param $user
     * @param $cart
     * @param $transaction
     *
     * Event user.cart.completed
     */
    public function userCartCompleted($user, $cart, $transaction)
    {
        $params = [
            'subject'     => 'Confirmation of booking',
            'user'        => $user,
            'cart'        => $cart,
            'transaction' => $transaction,
            'banner'      => NULL,
            'image'       => image('/assets/img/email/user_booking_confirmation.jpg', 'booking confirmation'),
            'link_url'    => $this->url->to('/uk/london')
        ];


        $params['search'] = App::make('SearchController');


        if ($cart['packages']) {
            /** Pick 3 classes which are priced appropriately for the package purchased. NEEDS WORK!!! */
            $upperPrice = round($cart['packages'][0]['max_class_price'], 2) + 0.01;

            $searchController = App::make('SearchController');
            $everciseGroups = $searchController->getClasses([
                'sort'  => 'price_desc',
                'price' => ['under' => round($upperPrice, 2), 'over' => round(($upperPrice - 10))],
                'size'  => '3'
            ]);

            $params['everciseGroups'] = $everciseGroups->hits;

            if ($cart['sessions']) {
                $params['view'] = 'v3.emails.user.cart_completed_both';
            } else {
                $params['view'] = 'v3.emails.user.cart_completed_package';
            }
        } else {
            $params['view'] = 'v3.emails.user.cart_completed_class';
        }

        $this->send($user->email, $params);
    }

    /**
     * @param $user
     * @param $transaction
     * @param $balance
     *
     * Event user.topup.completed
     */
    public function topupCompleted($user, $transaction, $balance)
    {
        $params = [
            'subject'     => 'Funds have been added to your wallet',
            'view'        => 'v3.emails.user.topup_completed',
            'user'        => $user,
            'transaction' => $transaction,
            'balance'     => $balance,
            'banner'      => NULL,
            'image'       => image('/assets/img/email/user_default.jpg', 'Topup Confirmation'),
            'link_url'    => $this->url->to('/uk/london')
        ];

        $this->send($user->email, $params);
    }

    /**
     * @param $user
     * @param $transaction
     * @param $balance
     *
     * Event user.topup.completed
     */
    public function withdrawCompleted($user, $transaction, $balance)
    {
        $params = [
            'subject'     => 'Confirmation of Withdrawal',
            'view'        => 'v3.emails.user.withdraw_completed',
            'user'        => $user,
            'transaction' => $transaction,
            'balance'     => $balance,
            'banner'      => NULL,
            'image'       => image('/assets/img/email/user_default.jpg', 'topup confirmation'),
            'link_url'    => $this->url->to('/uk/london')
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
            'banner'   => FALSE,
            'image'    => image('/assets/img/email/evercise-welcome.jpg', 'welcome to evercise'),
            'link_url' => $this->url->to('/uk/london')
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
            'subject'  => 'Welcome to Evercise',
            'title'    => 'Welcome to Evercise!',
            'view'     => 'v3.emails.user.welcome_guest',
            'user'     => $user,
            'banner'   => FALSE,
            'image'    => image('/assets/img/email/evercise-welcome.jpg', 'welcome to evercise'),
            'link_url' => $this->url->to('/uk/'),
            'link'     => $link
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
            'subject'  => 'Welcome to Evercise',
            'title'    => 'Welcome to Evercise!',
            'view'     => 'v3.emails.user.welcome_facebook',
            'user'     => $user,
            'banner'   => FALSE,
            'image'    => image('/assets/img/email/evercise-welcome.jpg', 'welcome to evercise'),
            'link_url' => $this->url->to('/uk/'),
            'link'     => $link
        ];

        $this->send($user->email, $params);
    }

    /**
     * @param $user
     * @param string $resetCode
     */
    public function userForgotPassword($user, $resetCode = '')
    {


        $params = [
            'subject'   => 'Reset Password',
            'title'     => 'Evercise password reset',
            'view'      => 'v3.emails.user.forgot_password',
            'user'      => $user,
            'banner'    => FALSE,
            'image'     => image('/assets/img/email/user_default.jpg', 'reset your password'),
            'resetCode' => $resetCode
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
     *
     * Event session.upcoming_session
     * Single event fires emails to all users and the trainer involved in the session.
     */
    public function usersSessionRemind(
        $userList,
        $group,
        $location,
        $dateTime,
        $trainerName,
        $trainerEmail,
        $classId,
        $sessionId
    ) {
        foreach ($userList as $name => $details) {
            $email = $details['email'];

            $transaction = \Transactions::find($details['transactionId']);
            $bookingCodes = $transaction->makeBookingHashBySession($sessionId);

            $params = [
                'subject'       => 'Evercise class reminder',
                'view'          => 'v3.emails.user.session_remind',
                'userList'      => $userList,
                'group'         => $group,
                'location'      => $location,
                'name'          => $name,
                'email'         => $email,
                'dateTime'      => $dateTime,
                'trainerName'   => $trainerName,
                'trainerEmail'  => $trainerEmail,
                'classId'       => $classId,
                'style'         => 'blue',
                'transactionId' => $details['transactionId'],
                'bookingCodes'  => $bookingCodes,
                'image'         => image('/assets/img/email/user_class_reminder.jpg', 'reminder of upcoming class'),
                'link_url'      => $this->url->to('/profile/' . $group->slug)
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
            'subject'      => 'Join your friends on Evercise',
            'view'         => 'v3.emails.user.invite',
            'email'        => $email,
            'referralCode' => $referralCode,
            'referrerName' => $referrerName,
            'image'        => image('/assets/img/email/welcome_from_referral.png', 'Join your friends on Evercise'),
            'link_url'     => $this->url->to('/refer_a_friend/' . $referralCode),
            'banner'       => [
                'image' => $this->url->to('assets/img/email/user_upsell_signup_today.png'),
                'url'   => $this->url->to('/refer_a_friend/' . $referralCode),
                'title' => 'SignUp Today and Receive £5'
            ],
        ];

        $this->send($email, $params);

    }

    /**
     * @param $email
     * @param $referralCode
     * @param $referrerName
     */
    public function thanksForInviting($email, $referrerName, $referreeEmail, $balanceWithBonus)
    {
        $params = [
            'subject'          => 'Thanks for sharing!',
            'title'            => 'Thanks for sharing!',
            'view'             => 'v3.emails.user.thanks_inviting',
            'email'            => $email,
            'refereeEmail'     => $referreeEmail,
            'referrerName'     => $referrerName,
            'balanceWithBonus' => $balanceWithBonus,
            'image'            => image('/assets/img/email/evercise-welcome.jpg', 'Thanks for sharing!'),
            'link_url'         => $this->url->to('/uk/'),
            'banner'           => FALSE
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


    public function userLanding($email, $categoryId, $ppcCode, $location)
    {


        $params = [
            'subject'    => 'GET ACTIVE, GET SOCIAL, GET FIT',
            'title'      => 'GET ACTIVE, GET SOCIAL, GET FIT!',
            'view'       => 'v3.emails.user.landing_email',
            'email'      => $email,
            'categoryId' => $categoryId,
            'ppcCode'    => $ppcCode,
            'image'      => image('/assets/img/email/evercise-welcome.jpg', 'welcome to evercise'),
            'link_url'   => $this->url->to('/uk/'),
            'banner'     => FALSE
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

    public function notReturned($user, $everciseGroups)
    {
        $params = [
            'subject'        => 'You have not used your £5 Evercise Balance',
            'title'          => 'You haven&apos;t used your £5 Evercise Balance',
            'view'           => 'v3.emails.user.why_not_coming_back',
            'user'           => $user,
            'everciseGroups' => $everciseGroups,
            'banner'         => FALSE,
            'image'          => image('/assets/img/email/user_default.jpg',
                'You have not used your £5 Evercise Balance'),
            'link_url'       => $this->url->to('/uk/london')
        ];

        $this->send($user->email, $params);

    }

    public function whyNotRefer($user)
    {
        $params = [
            'subject'  => 'Share Evercise with your friends and get £5',
            'title'    => 'Share Evercise with your friends and get £5',
            'view'     => 'v3.emails.user.why_not_refer',
            'user'     => $user,
            'banner'   => $this->banner_types['refer_someone'],
            'image'    => image('/assets/img/email/user_reffer_friend.jpg', 'Why not refer a friend'),
            'link_url' => $this->url->to('/uk/london'),
            'style'    => 'blue',
        ];

        $this->send($user->email, $params);

    }

    public function rateClass($user)
    {
        $params = [
            'subject'  => 'How was the class?',
            'title'    => 'How was the class?',
            'view'     => 'v3.emails.user.rate_class',
            'user'     => $user,
            'image'    => image('/assets/img/email/user_how_was_the_class.jpg', 'rate class'),
            'link_url' => $this->url->to('/profile/' . $user->display_name . '/attended'),
            'style'    => 'pink',
            'banner'   => $this->banner_types['packages'],
        ];

        $this->send($user->email, $params);

    }

    public function rateClassHasPackage($user)
    {
        // Send the rate class email, for users that have already have an active package
        // (the standard email recommends buying a package)

        $params = [
            'subject'  => 'How was the class?',
            'title'    => 'How was the class?',
            'view'     => 'v3.emails.user.rate_class',
            'user'     => $user,
            'image'    => image('/assets/img/email/user_how_was_the_class.jpg', 'rate class'),
            'link_url' => $this->url->to('/profile/' . $user->display_name . '/attended'),
            'style'    => 'pink',
        ];

        $this->send($user->email, $params);
    }

    public function messageReply($sender, $recipient, $body)
    {
        $params = [
            'subject'     => 'You have a new message',
            'view'        => 'v3.emails.user.mail_reply',
            'sender'      => $sender,
            'recipient'   => $recipient,
            'messageBody' => $body
        ];

        $this->send($recipient->email, $params);
    }


    /**
     * ########################################################################################
     * #####          TRAINER EMAIL's         #################################################
     * ########################################################################################
     */


    /**
     * @param $trainer
     */
    public function trainerRegisteredPpc($trainer)
    {
        $params = [
            'subject'  => 'Welcome to Evercise!',
            'title'    => 'Welcome to Evercise!',
            'view'     => 'v3.emails.trainer.registered_ppc',
            'trainer'  => $trainer,
            'banner'   => NULL,
            'image'    => image('/assets/img/email/evercise-welcome.jpg', 'welcome to evercise'),
            'link_url' => $this->url->to('/profile/' . $trainer->display_name)
        ];

        $this->send($trainer->email, $params);
    }


    /**
     * @param $trainer
     */
    public function trainerRegistered($trainer)
    {
        $params = [
            'subject'  => 'Welcome to Evercise!',
            'title'    => 'Welcome to Evercise!',
            'view'     => 'v3.emails.trainer.registered',
            'trainer'  => $trainer,
            'banner'   => NULL,
            'image'    => image('/assets/img/email/evercise-welcome.jpg', 'welcome to evercise'),
            'link_url' => $this->url->to('/profile/' . $trainer->display_name)
        ];

        $this->send($trainer->email, $params);
    }

    /**
     * @param $trainer
     *
     * Event: trainer.complete_profile
     */
    public function trainerWhyNotCompleteProfile($trainer)
    {
        $params = [
            'subject'  => 'BOOST YOUR EVERCISE SALES BY 50%',
            'title'    => 'BOOST YOUR EVERCISE SALES BY 50%',
            'view'     => 'v3.emails.trainer.complete_profile',
            'trainer'  => $trainer,
            'banner'   => NULL,
            'image'    => image('/assets/img/email/trainer_finish_profile.png', 'finish profile'),
            'link_url' => $this->url->to('/profile/' . $trainer->display_name)
        ];

        $this->send($trainer->email, $params);
    }

    public function trainerWhyNotCreateFirstClass($trainer)
    {
        $params = [
            'subject'  => 'Why not create your first class',
            'title'    => 'Why not create your first class',
            'view'     => 'v3.emails.trainer.create_first_class',
            'trainer'  => $trainer,
            'banner'   => NULL,
            'image'    => image('/assets/img/email/trainer_create_first.png', 'why not create your first class'),
            'link_url' => $this->url->to('/evercisegroups/create')
        ];

        $this->send($trainer->email, $params);
    }

    /**
     * @param $class
     * @param $trainer
     */
    public function classCreatedFirstTime($class, $trainer)
    {
        $params = [
            'subject' => 'Class created',
            'title'   => 'Class created',
            'view'    => 'v3.emails.trainer.class_created',
            'trainer' => $trainer,
            'class'   => $class
        ];

        $this->send($trainer->email, $params);

    }


    /**
     * @param $class
     * @param $trainer
     */
    public function sendEmailAgain()
    {


        die('LETS NOT TRIGGER THIS AGAIN');
        $users = [
            'ZL249@cam.ac.uk',
            'xinsheng.zhang@kcl.ac.uk',
            'md@alanday.co.uk',
            'leadavies@btinternet.com',
            'chelsea@chelseahayes.co.uk',
            'natalija.bogdanovic666@gmail.com',
            'jokelly86@googlemail.com',
            'jelena.miholjac@yahoo.co.uk',
            'cinilak@yahoo.com',
            'Anishauk79@hotmail.com',
            'Aislingnutley@hotmail.com',
            'yardley4@hotmail.com',
            'stephen@dubishere.com',
            'szilvia.uri@gmail.com',
            'horvat.arpad@gmail.com',
            'tchitava@gmail.com',
            'ruska_dd@yahoo.com',
            'ed@dubishere.com',
            'accounts@dubishere.com',
            'sboudoux@gmail.com',
            'mlatko@gmail.com'
        ];

        foreach($users as $email) {

            $params = [
                'subject' => 'Evercise Invitation',
                'title'   => 'Invitation',
                'view'    => 'v3.emails.user.testers'
            ];


            $this->send($email, $params);
        }


    }


    /**
     * @param $userList
     * @param $group
     * @param $location
     * @param $dateTime
     * @param $trainerName
     * @param $trainerEmail
     * @param $classId
     *
     * Event: session.upcoming_session
     * Single event fires emails to all users and the trainer involved in the session.
     */
    public function trainerSessionRemind(
        $userList,
        $group,
        $location,
        $dateTime,
        $trainerName,
        $trainerEmail,
        $classId,
        $sessionId
    ) {
        $params = [
            'subject'      => 'Class reminder & participant list',
            'view'         => 'v3.emails.trainer.session_remind',
            'userList'     => $userList,
            'group'        => $group,
            'location'     => $location,
            'dateTime'     => $dateTime,
            'trainerName'  => $trainerName,
            'trainerEmail' => $trainerEmail,
            'classId'      => $classId,
            'sessionId'    => $sessionId,
            'style'        => 'blue',
            'image'        => image('/assets/img/email/user_class_reminder.jpg', 'reminder of upcoming class'),
            'link_url'     => $this->url->to('/download_user_list/' . $sessionId)
        ];

        $this->send($trainerEmail, $params);
    }

    /**
     * @param $userList
     * @param $evercisegroup
     * @param $session
     * @param $messageSubject
     * @param $messageBody
     * @internal param $group
     */
    public function trainerMailAll($userList, $evercisegroup, $session, $messageSubject, $messageBody)
    {

        foreach ($userList as $id => $user) {
            $params = [
                'subject'        => 'You have a new message',
                'view'           => 'v3.emails.trainer.mail_all',
                'user'           => $user,
                'evercisegroup'  => $evercisegroup,
                'session'        => $session,
                'messageSubject' => $messageSubject,
                'messageBody'    => $messageBody
            ];

            $this->send($user->email, $params);
        }

    }


    /**
     * @param $user
     * @param $trainer
     * @param $evercisegroup
     * @param $sessionDate
     */
    public function trainerLeaveSession($user, $trainer, $evercisegroup, $sessionDate)
    {
        $params = [
            'subject'       => 'Someone has left your class',
            'view'          => 'v3.emails.trainer.session_left',
            'user'          => $user,
            'trainer'       => $trainer,
            'everciseGroup' => $evercisegroup,
            'sessionDate'   => $sessionDate,
        ];

        $this->send($user->email, $params);

    }


    /**
     * @param $user
     * @param $trainer
     * @param $session
     * @param $evercisegroup
     * @param $transactionId
     *
     * Event: trainer.session.joined
     */
    public function userJoinedTrainersSession($trainerId, $sessionDetails)
    {
        // This is fired once for each batch of classes belonging to a single trainer, so the Trainer only gets a single email per booking.

        $classes = [];
        foreach ($sessionDetails as $sd) {
            $this->log->info('SESSION BOOKED: ' . $sd['session']->id);

            $trainer = $sd['trainer'];
            $user = $sd['user'];

            if (!isset($classes[$sd['group']->id])) {
                $classes[$sd['group']->id] = [
                    'transaction' => $sd['transaction'],
                    'session'     => $sd['session'],
                    'codes'       => $sd['transaction']->makeBookingHashBySession($sd['session']->id)
                ];
            }
        }

        $params = [
            'subject'  => 'A User just Joined your Class',
            'view'     => 'v3.emails.trainer.user_joined_classes',
            'trainer'  => $trainer,
            'user'     => $user,
            'classes'  => $classes,
            'link_url' => $this->url->to('/'),
            'image'    => image('assets/img/email/user_booking_confirmation.jpg',
                'someone has joined your classs'),
        ];

        $this->send($trainer->email, $params);

    }

    /**
     * @param $user
     * @param $trainer
     * @param $session
     * @param $evercisegroup
     * @param $transactionId
     *
     * Event: session.joined
     */
    public function trainerJoinSession($user, $trainer, $session, $evercisegroup, $transaction)
    {
        // This is fired for every sessionmember that is created.

    }

    public function userReviewedClass($user, $trainer, $rating, $session, $evercisegroup)
    {

        $params = [
            'subject'       => 'A User Has Reviewed Your Class',
            'view'          => 'v3.emails.trainer.user_reviewed_class',
            'user'          => $user,
            'trainer'       => $trainer,
            'rating'        => $rating,
            'session'       => $session,
            'evercisegroup' => $evercisegroup,
            'link_url'      => $this->url->to('/'),
        ];

        $this->send($trainer->email, $params);
    }

    public function thanksForReview($user, $trainer, $rating, $session, $evercisegroup)
    {

        $params = [
            'subject'  => 'Thanks for the review!',
            'view'     => 'v3.emails.user.thanks_review',
            'user'     => $user,
            'trainer'  => $trainer,
            'review'   => $rating,
            'session'  => $session,
            'group'    => $evercisegroup,
            'link_url' => $this->url->to('/'),
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
    public function mailTrainer($trainer, $user, $evercisegroup, $session, $subject, $body)
    {
        $params = [
            'subject'        => 'You have a new message',
            'view'           => 'v3.emails.trainer.mail_trainer',
            'trainer'        => $trainer,
            'user'           => $user,
            'evercisegroup'  => $evercisegroup,
            'session'        => $session,
            'messageSubject' => $subject,
            'messageBody'    => $body
        ];

        $this->send($trainer->email, $params);
    }

    public function generateStaticLandingEmail($ppcCode, $categoryId = 0)
    {
        $params = [
            'subject'    => 'Static Landing Email',
            'view'       => 'v3.emails.user.static_landing_email',
            'ppcCode'    => $ppcCode,
            'categoryId' => $categoryId,
        ];

        $this->send('test@test.com', $params);

    }

    public function newYear($user)
    {
        $params = [
            'subject'  => 'Discover a new fitness challenge',
            'title'    => 'Discover a new fitness challenge',
            'view'     => 'v3.emails.user.new_year',
            'user'     => $user,
            'banner'   => FALSE,
            'image'    => image('/assets/img/email/new_year.jpg', 'Warm up for the new year'),
            'link_url' => $this->url->to('/')
        ];

        $this->send($user->email, $params);

    }

    public function relaunch($user)
    {
        $params = [
            'subject'  => 'Evercise Relaunch',
            'title'    => 'Evercise Relaunch!',
            'view'     => 'v3.emails.trainer.relaunch',
            'user'     => $user,
            'banner'   => FALSE,
            'image'    => image('/assets/img/email/relaunch.png', 'Check out the all new evercise'),
            'link_url' => $this->url->to('/')
        ];

        $this->send($user->email, $params);

    }

    public function notReturnedTrainer($trainer)
    {
        $params = [
            'subject'  => 'Don’t be a stranger!',
            'title'    => 'Don’t be a stranger!',
            'view'     => 'v3.emails.trainer.why_not_coming_back',
            'user'     => $trainer,
            'banner'   => FALSE,
            'image'    => image('/assets/img/email/user_default.jpg', 'Don’t be a stranger!'),
            'link_url' => $this->url->to('/uk/london')
        ];

        $this->send($trainer->email, $params);

    }


    /**
     * ########################################################################################
     * #####            ADMIN STUFF           #################################################
     * ########################################################################################
     */


    public function adminSendReminderForPayments($total)
    {


        $emails = $this->config->get('evercise.pending_emails');

        foreach ($emails as $email) {
            $params = [
                'subject'  => 'You have ' . $total . ' pending payments',
                'view'     => 'v3.emails.admin.payments_reminder',
                'total'    => $total,
                'link_url' => $this->url->route('admin.pending_withdrawal'),
                'image'    => image('assets/img/email/admin.jpg', 'Evercise'),
            ];

            $this->send($email, $params);
        }
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
        if (is_string($this->data['banner']) && !empty($this->data['banner_types'][$this->data['banner']])) {
            $this->data['banner'] = $this->data['banner_types'][$this->data['banner']];
        }

        $this->data['email'] = $email;

        $subject = $this->data['subject'];
        $attachments = $this->data['attachments'];

        $view = $this->view->make($this->data['view'], $this->data)->render();


        // Parse it all Inline
        $parse = new CssToInlineStyles($view, $this->data['css']);

        $content = $parse->convert();

        $plain_text = $this->plainText($content);


        $trace = debug_backtrace();
        $name = $this->formatName(get_called_class(), next($trace)['function']);

        // If params contain user or user_id, take user ID from there.  Otherwise query the email address to find user ID
        if (isset($params['user'])) {
            if ($params['user'] instanceof User || $params['user'] instanceof Sentry) {
                $user_id = $params['user']->id;
            }
        }

        if (isset($params['user_id'])) {
            $user_id = $params['user_id'];
        }

        if (!isset($user_id)) {
            $user_id = \User::where('email', $email)->pluck('id');
        }



        if ($this->config->get('pardot.active')) {
            $campayn_id = $this->config->get('pardot.campayns.' . $name);
        }


        $sent = FALSE;
        if (!empty($campayn_id)) {
            $pardotEmail = new \PardotEmail([
                'subject'   => $subject,
                'content'   => $content,
                'plainText' => $plain_text
            ]);

            $pardot = new \Pardot();

            try {
                $pardot->send($email, $campayn_id, $pardotEmail);
                $sent = TRUE;
            } catch (Exception $e) {
                $this->log->error('Pardot Email could not be sent ' . $e->getMessage());
                /** ADD HERE SOME SORT OF NOTIFICATION TO ADMINS !!!*/

            }
        }

        $message_id = '';

        if (!$sent) {
            try {



                /** Remove Unsubscribe for now! */
                $content = str_replace('%%unsubscribe%%', '', $content);
                $content = str_replace('dev.evercise.com', 'evercise.com', $content);
                $plain_text = str_replace('%%unsubscribe%%', '', $plain_text);
                $plain_text = str_replace('dev.evercise.com', 'evercise.com', $plain_text);


                $this->email->send(['v3.emails.blank', 'v3.emails.plain_blank'],
                    ['content' => $content, 'plain_text' => $plain_text],
                    function ($message) use ($email, $subject, $attachments, &$message_id) {
                        $message_id = $message->getId();
                        $message->to($email)->subject($subject);
                        if (count($attachments) > 0) {
                            foreach ($attachments as $attachment) {
                                $message->attach($attachment);
                            }
                        }
                    });
                $this->log->info('Email sent with basic sending');

            } catch (Exception $e) {
                $this->log->error('Email could not be sent ' . $e->getMessage());

                /** ADD HERE SOME SORT OF NOTIFICATION TO ADMINS !!!*/

            }



            if ($user_id) {
                EmailOut::addRecord($user_id, $name, $message_id);
            } else {
                EmailOut::addRecord($email, $name, $message_id);
            }
        }


        /** Output email to file so we can check it out */
        if (!empty($_ENV['SAVE_EMAILS']) && $_ENV['SAVE_EMAILS']) {
            if (!is_dir(storage_path() . '/emails')) {
                mkdir(storage_path() . '/emails');
            }
            file_put_contents(storage_path() . '/emails/' . $name . '.html', $content);
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


    /**
     * @param $content
     * @return string
     */
    private function plainText($content)
    {
        /** Strip Styles */
        $content = preg_replace("/<style\\b[^>]*>(.*?)<\\/style>/s", "", $content);


        $content = strip_tags(str_replace(["\r\n", "\r"], "\n", $content));
        $lines = explode("\n", $content);

        $new_lines = [];

        foreach ($lines as $i => $line) {
            if (!empty(trim($line))) {
                $new_lines[] = trim($line);
            }
        }
        $content = "\n" . implode($new_lines, "\n");

        $remove = [
            '&copy; Copyright 2014 Evercise',
            'Follow us on',
            'Unsubscribe'
        ];

        $content = str_replace($remove, '', $content);

        $content .= $this->view->make('v3.emails.plain_footer', $this->data);

        return $content;
    }
}

