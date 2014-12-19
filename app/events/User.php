<?php  namespace events;


use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Events\Dispatcher;
use Illuminate\Routing\UrlGenerator;

/**
 * Class User
 * @package events
 */
class User
{
    /**
     * @var Repository
     */
    protected $config;
    /**
     * @var Writer
     */
    protected $log;
    /**
     * @var Dispatcher
     */
    protected $event;
    /**
     * @var Activity
     */
    protected $activity;
    /**
     * @var Indexer
     */
    protected $indexer;
    /**
     * @var Mail
     */
    protected $mail;
    /**
     * @var Tracking
     */
    protected $track;
    /**
     * @var UrlGenerator
     */
    private $url;

    /**
     * @param Activity $activity
     * @param Indexer $indexer
     * @param Mail $mail
     * @param Writer $log
     * @param Repository $config
     * @param Dispatcher $event
     * @param Tracking $track
     * @param UrlGenerator $url
     */
    public function __construct(
        Activity $activity,
        Indexer $indexer,
        Mail $mail,
        Writer $log,
        Repository $config,
        Dispatcher $event,
        Tracking $track,
        UrlGenerator $url
    ) {
        $this->config = $config;
        $this->log = $log;
        $this->event = $event;
        $this->track = $track;

        $this->activity = $activity;
        $this->indexer = $indexer;
        $this->mail = $mail;
        $this->url = $url;
    }

    /**
     * @param $user
     */
    public function login($user)
    {

        $this->log->info('User ' . $user->id . ' has Logged In');
        $this->track->userLogin($user);

    }

    /**
     * @param $user
     */
    public function facebookLogin($user)
    {

        $this->log->info('User ' . $user->id . ' has Logged In with Facebook');
        $this->track->userFacebookLogin($user);

    }

    /**
     * @param $user
     */
    public function logout($user)
    {

        $this->log->info('User ' . $user->id . ' has Logged Out');
        $this->track->userLogout($user);

    }

    /**
     * @param $user
     */
    public function edit($user)
    {

        $this->log->info('User ' . $user->id . ' has edited his account');
        $this->track->userEdit($user);
    }


    /**
     * @param $user
     */
    public function hasRegistered($user)
    {
        $this->log->info('User ' . $user->id . ' has registered');

        $this->track->userRegistered($user);
    }

    /**
     * @param $user
     */
    public function facebookRegistered($user)
    {


        $this->log->info('User ' . $user->id . ' has registered with Facebook');
        $this->track->userFacebookRegistered($user);
    }



    /**
     * @param $user
     * @param $cart
     * @param $transaction
     */
    public function cartCompleted($user, $cart, $transaction)
    {


        $this->log->info('User ' . $user->id . ' cart completed');

        $this->mail->userCartCompleted($user, $cart, $transaction);

        $this->activity->userCartCompleted($user, $cart, $transaction);

    }

    /**
     * @param $user
     * @param $transaction
     */
    public function topupCompleted($user, $transaction, $balance)
    {
        $this->log->info('User ' . $user->id . ' topup completed');

        $this->mail->topupCompleted($user, $transaction, $balance);

        $this->activity->userTopupCompleted($user, $transaction, 'topupcompleted');
    }

    /**
     * @param $user
     * @param $transaction
     */
    public function referralCompleted($user, $transaction, $balance)
    {
        $this->log->info('User ' . $user->id . ' referral completed');

        $this->activity->userReferralCompleted($user, $transaction, 'referralcompleted');
    }

    /**
     * @param $user
     * @param $transaction
     */
    public function referralSignup($user, $transaction, $balance)
    {
        $this->log->info('User ' . $user->id . ' signup through referral');

        $this->activity->userReferralSignup($user, $transaction, 'referralsignup');
    }

    /**
     * @param $user
     * @param $transaction
     * @param $type
     * @param $description
     */
    public function ppcSignup($user, $transaction, $type, $description = 0)
    {
        $this->log->info('User ' . $user->id . ' signup through '.$type.' ppc code');

        $this->activity->ppcSignup($user, $transaction, $type, $description);
    }

    /**
     * @param $user
     * @param $transaction
     */
    public function withdrawCompleted($user, $transaction, $balance)
    {
        $this->log->info('User ' . $user->id . ' topup completed');

        $this->mail->withdrawCompleted($user, $transaction, $balance);

        $this->activity->userWithdrawCompleted($user, $transaction);
    }


    /**
     * @param $user
     */
    public function connectedFacebook($user)
    {
        $this->log->info('User ' . $user->id . ' Connected his facebook account');

        $this->activity->linkFacebook($user);
    }


    /**
     * @param $user
     */
    public function connectedTwitter($user)
    {
        $this->log->info('User ' . $user->id . ' Connected his twitter account');

        $this->activity->linkTwitter($user);
    }

    /** MOVED FROM UserMailer */


    public function welcome($user)
    {

        $this->log->info('Sending welcome email to ' . $user->id);


        $this->mail->welcome($user);

        $this->activity->userRegistered($user);

    }

    /**
     * @param $user
     */
    public function welcomeGuest($user)
    {

        $this->log->info('Sending welcome email with reset password to ' . $user->id);

        /** @var Forgotten Password Code Generate $resetCode */
        $resetCode = $user->getResetPasswordCode();
        $link = $this->url->to('users/' . $user->display_name . '/resetpassword/' . urlencode($resetCode));

        $this->mail->welcomeGuest($user, $link);
    }

    /**
     * @param $user
     */
    public function facebookWelcome($user)
    {

        $this->log->info('Sending welcome email to FB ' . $user->id);

        /** @var Forgotten Password Code Generate $resetCode */
        $resetCode = $user->getResetPasswordCode();
        $link = $this->url->to('users/' . $user->display_name . '/resetpassword/' . urlencode($resetCode));


        $this->mail->welcomeFacebook($user, $link);
    }


    /**
     * @param $user
     */
    public function forgotPassword($user)
    {

        $this->log->info('Sending forgoten password ' . $user->id);

        /** @var Forgotten Password Code Generate $resetCode */
        $resetCode = $user->getResetPasswordCode();
        $link = $this->url->to('users/' . $user->display_name . '/resetpassword/' . urlencode($resetCode));


        $this->mail->userForgotPassword($user, $link);
    }


    /**
     * @param $user
     */
    public function userChangedPassword($user)
    {

        $this->log->info('User changed password ' . $user->id);

        $this->mail->userChangedPassword($user);
        $this->track->userChangedPassword($user);

    }


    /**
     * @param $user
     */
    public function userUpgrade($user)
    {
        $this->log->info('User upgraded to Trainer ' . $user->id);

        $this->mail->userUpgrade($user);
    }

    /**
     * @param $email
     * @param $referralCode
     * @param $referrerName
     */
    public function invite($email, $referralCode, $referrerName, $referrerEmail, $balanceWithBonus)
    {
        $this->log->info('User Invite ' . $email);

        $this->mail->invite($email, $referralCode, $referrerName);
        $this->mail->thanksForInviting($referrerEmail, $referrerName, $email, $balanceWithBonus);
    }

    /**
     * @param $email
     * @param $categoryId
     * @param $ppcCode
     */
    public function ppc($email, $categoryId, $ppcCode)
    {
        $this->log->info('PPC ' . $email);

        $this->mail->ppc($email, $categoryId, $ppcCode);
    }

    public function userLanding($email, $categoryId, $ppcCode, $location)
    {
        $this->log->info('landing user ' . $email);

        $this->mail->userLanding($email, $categoryId, $ppcCode, $location);
    }

    public function generateStaticLandingEmail($ppcCode, $categoryId)
    {
        $this->log->info('static landing email generated ' . $ppcCode);

        $this->mail->generateStaticLandingEmail($ppcCode, $categoryId);
    }
}
