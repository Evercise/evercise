<?php  namespace events;


use Activities;
use Evercisesession;
use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Events\Dispatcher;

/**
 * Class Activity
 * @package events
 */
class Activity
{
    /**
     * @var Dispatcher
     */
    private $config;
    /**
     * @var Writer
     */
    private $log;
    /**
     * @var Dispatcher
     */
    private $event;
    /**
     * @var Activities
     */
    private $activities;
    /**
     * @var Evercisesession
     */
    private $evercisesession;

    /**
     * @param Writer $log
     * @param Repository $config
     * @param Dispatcher $event
     * @param Activities $activities
     * @param Evercisesession $evercisesession
     */
    public function __construct(
        Writer $log,
        Repository $config,
        Dispatcher $event,
        Activities $activities,
        Evercisesession $evercisesession
    ) {
        $this->config = $config;
        $this->log = $log;
        $this->event = $event;
        $this->activities = $activities;
        $this->evercisesession = $evercisesession;
    }

    /**
     * @param $id
     */
    private function getSession($id)
    {
        return $this->evercisesession->find($id);
    }


    private function fixAmountDisplay($amount)
    {
        if (strpos($amount, '-') !== FALSE) {
            return str_replace('-', '-£', $amount);
        }

        return '£' . $amount;
    }


    /**
     * @param $class
     * @param $user
     */
    public function payedClass($class, $user)
    {

        $trainer = $class->user()->first();
        $this->activities->create([
            'title'       => 'Joined class',
            'description' => $class->name,
            'link'        => 'class/' . $class->id,
            'link_title'  => 'View class',
            'type'        => 'payedclass',
            'image'       => $trainer->directory . '/' . $class->image,
            'user_id'     => $user->id,
            'type_id'     => $class->id
        ]);
    }


    /**
     * @param $class
     * @param $user
     */
    public function canceledClass($class, $user)
    {
        $this->activities->create([
            'title'       => 'Canceled class',
            'description' => $class->name,
            'type'        => 'canceledclass',
            'image'       => $user->directory . '/' . $class->image,
            'link'        => 'class/' . $class->id,
            'user_id'     => $user->id,
            'type_id'     => $class->id,
        ]);


    }


    /**
     * @param $user
     * @param $transaction
     */
    public function walletToppup($user, $transaction)
    {

        $this->activities->create([
            'title'       => 'Top Up',
            'type'        => 'wallettoppup',
            'description' => $this->fixAmountDisplay($transaction->total) . ' credit to your account on ' . date('d/m/y'),
            'user_id'     => $user->id,
            'type_id'     => $transaction->id,
            'link'        => 'transactions/' . $transaction->id,
            'link_title'  => 'View',
            'image'       => 'assets/img/activity/Activity_Topped_Up.png',
        ]);

    }

    /**
     * @param $user
     * @param int $amount
     */
    public function walletWithdraw($user, $amount = 0)
    {

        //        $this->activities->create([
        //            'description' => '£' . $amount . ' amount Withdrawn',
        //            'type'        => 'walletwithdraw',
        //            'user_id'     => $user->id
        //        ]);

        $this->activities->create([
            'title'       => 'Wallet Withdraw',
            'type'        => 'wallettoppup',
            'description' => $this->fixAmountDisplay($amount) . ' amount Withdrawn',
            'user_id'     => $user->id,
            'type_id'     => $user->id,
            'link'        => 'profile/' . $user->id . '/wallet',
            'link_title'  => 'View',
            'image'       => 'assets/img/activity/Activity_Withdawal.png',
        ]);
    }


    /**
     * @param $user
     * @param int $amount
     */
    public function userRegistered($user)
    {
        $this->activities->create([
            'title'       => 'Joined Evercise',
            'type'        => 'userregistered',
            'description' => 'Welcome',
            'user_id'     => $user->id,
            'type_id'     => $user->id,
            'link'        => 'profile/' . $user->display_name,
            'link_title'  => 'Profile',
            'image'       => 'assets/img/activity/Activity_Joined_Evercise.png',
        ]);
    }

    /**
     * @param $user
     */
    public function userEditProfile($user)
    {

        //        $this->activities->create([
        //            'description' => 'Edited your profile',
        //            'type'        => 'editprofile',
        //            'user_id'     => $user->id
        //        ]);
    }

    /**
     * @param $user
     */
    public function linkFacebook($user)
    {

        //        $this->activities->create([
        //            'description' => 'Linked Facebook account',
        //            'type'        => 'linkfacebook',
        //            'user_id'     => $user->id
        //        ]);
    }

    /**
     * @param $user
     */
    public function linkTwitter($user)
    {

        //        $this->activities->create([
        //            'description' => 'Linked Twitter account',
        //            'type'        => 'linktwitter',
        //            'user_id'     => $user->id
        //        ]);
    }

    /**
     * @param $user
     * @param string $email
     */
    public function invitedEmail($user, $email = '')
    {

        if ($email != '') {
            //
            //            $this->activities->create([
            //                'description' => 'Invited ' . $email . ' to join Evercise',
            //                'type'        => 'invitedemail',
            //                'user_id'     => $user->id
            //            ]);
        }
    }


    /**
     * @param $class
     * @param $user
     */
    public function createdClass($class, $user)
    {

        $this->activities->create([
            'title'       => 'You created a class',
            'type'        => 'createclass',
            'description' => $class->name,
            'user_id'     => $user->id,
            'type_id'     => $class->id,
            'link'        => 'class/' . $class->id,
            'link_title'  => 'View',
            'image'       => $user->directory . '/search_' . $class->image,
        ]);
    }

    /**
     * @param $venue
     * @param $user
     */
    public function createdVenue($venue, $user)
    {
        $this->activities->create([
            'title'       => 'You created a Venue',
            'description' => $venue->name,
            'type'        => 'createvenue',
            'description' => $venue->name,
            'user_id'     => $user->id,
            'type_id'     => $venue->id,
            'link'        => FALSE,
            'link_title'  => FALSE,
            'image'       => 'https://maps.googleapis.com/maps/api/staticmap?zoom=11&size=105x85&maptype=roadmap&markers=color:red%7Clabel:C%7C' . $venue->lat . ',' . $venue->lng
        ]);
    }

    /**
     * @param $class
     * @param $user
     */
    public function createdSessions($class, $user)
    {

        //        $this->activities->create([
        //            'description' => 'Created Multiple sessions for ' . $class->name,
        //            'type'        => 'createdsessions',
        //            'user_id'     => $user->id,
        //            'type_id'     => $class->id
        //        ]);
    }

    /**
     * @param $class
     * @param $user
     */
    public function updatedClass($class, $user)
    {
        $this->activities->create([
            'title'       => 'Updated a Class',
            'type'        => 'updatedclass',
            'description' => $class->name,
            'user_id'     => $user->id,
            'type_id'     => $class->id,
            'link'        => 'class/' . $class->id,
            'link_title'  => 'View',
            'image'       => 'updatedclass.png',
        ]);
    }

    /**
     * @param $venue
     * @param $user
     */
    public function updatedVenue($venue, $user)
    {
        $this->activities->create([
            'title'       => 'You Updated a Venue',
            'description' => $venue->name,
            'type'        => 'updatevenue',
            'user_id'     => $user->id,
            'type_id'     => $venue->id,
            'link'        => FALSE,
            'link_title'  => FALSE,
            'image'       => 'https://maps.googleapis.com/maps/api/staticmap?zoom=11&size=105x85&maptype=roadmap&markers=color:red%7Clabel:C%7C' . $venue->lat . ',' . $venue->lng
        ]);
    }

    /**
     * @param $class
     * @param $user
     */
    public function updatedSessions($class, $user)
    {
        //        $this->activities->create([
        //            'description' => 'Created Sessions for ' . $class->name,
        //            'type'        => 'updatedsessions',
        //            'user_id'     => $user->id,
        //            'type_id'     => $class->id
        //        ]);
    }

    /**
     * @param $class
     * @param $user
     */
    public function deletedClass($class, $user)
    {
        $this->activities->create([
            'title'       => 'Deleted a Class',
            'type'        => 'deletedclass',
            'description' => $class->name,
            'user_id'     => $user->id,
            'type_id'     => $class->id,
            'link'        => 'class/' . $class->id,
            'link_title'  => 'View',
            'image'       => $user->directory . '/' . $class->image,
        ]);
    }

    /**
     * @param $venue
     * @param $user
     */
    public function deletedVenue($venue, $user)
    {
        $this->activities->create([
            'description' => 'Deleted Venue ' . $venue->name,
            'type'        => 'deletedclass',
            'user_id'     => $user->id,
            'type_id'     => $venue->id
        ]);
    }

    /**
     * @param $class
     * @param $user
     */
    public function deletedSessions($class, $user)
    {
        //        $this->activities->create([
        //            'description' => 'Deleted Sessions ' . $class->name,
        //            'type'        => 'deletedsessions',
        //            'user_id'     => $user->id,
        //            'type_id'     => $class->id
        //        ]);
    }


    /**
     * @param $user
     * @param $class
     */
    public function usedReviewedClass($user, $class)
    {

        $this->activities->create([
            'title'       => 'You recently reviewed',
            'type'        => 'classreviewed',
            'description' => $class->name,
            'user_id'     => $user->id,
            'type_id'     => $class->id,
            'link'        => 'class/' . $class->id,
            'link_title'  => 'View',
            'image'       => 'classreviewed.png',
        ]);


    }

    /**
     * @param $coupon
     * @param $user
     */
    public function usedCoupon($coupon, $user)
    {

        $this->activities->create([
            'title'       => 'You used the coupon code: ' . $coupon->coupon,
            'type'        => 'couponused',
            'description' => ($coupon->type == 'amount' ? 'Worth £' . round($coupon->amount,
                    2) : 'With ' . $coupon->percentage . '% discount'),
            'user_id'     => $user->id,
            'type_id'     => $coupon->id,
            'link'        => '',
            'link_title'  => '',
            'image'       => 'assets/img/activity/Activity_Coupon.png',
        ]);


    }

    /**
     *
     * Mark the purchase completed
     * @param $user
     * @param $cart
     * @param $transaction
     */
    public function userCartCompleted($user, $cart, $transaction)
    {

        $title = 'You recently made a purchase';
        $description = '';
        if (count($cart['sessions']) > 0 && count($cart['packages']) > 0) {
            $description = 'Bought a total of ' . count($cart['sessions']) . ' ' . returnPlural('session',
                    $cart['sessions']) . ' and ' . count($cart['packages']) . ' ' . returnPlural('package',
                    $cart['packages']);
        } elseif (count($cart['sessions']) > 0 && count($cart['packages']) == 0) {
            $description = 'Bought a total of ' . count($cart['sessions']) . ' ' . returnPlural('session',
                    $cart['sessions']);
        } elseif (count($cart['sessions']) == 0 && count($cart['packages']) > 0) {
            $description = 'Bought a total of ' . count($cart['packages']) . ' ' . returnPlural('package',
                    $cart['packages']);
        }


        $description .= ' for ' . $this->fixAmountDisplay($cart['total']['final_cost']);

        $data = [
            'description' => $description,
            'title'       => $title,
            'link'        => 'transaction/' . $transaction->id,
            'link_title'  => 'View transaction',
            'image'       => 'cartcompleted.png',
            'type'        => 'cartcompleted',
            'user_id'     => $user->id,
            'type_id'     => $transaction->id
        ];
        $activity = $this->activities->create($data);

        $this->log->info(implode(', ', $data));
        $this->log->info($activity->toJson());


    }

    /**
     * @param $user
     * @param $transaction
     */
    public function userTopupCompleted($user, $transaction)
    {
        $title = 'You topped up your account';
        $description = 'You topped up your account with ' . $this->fixAmountDisplay($transaction->total);

        $data = [
            'description' => $description,
            'title'       => $title,
            'link'        => 'transaction/' . $transaction->id,
            'link_title'  => 'View transaction',
            'image'       => 'topupcompleted.png',
            'type'        => 'topupcompleted',
            'user_id'     => $user->id,
            'type_id'     => $transaction->id
        ];
        $activity = $this->activities->create($data);

        $this->log->info(implode(', ', $data));
        $this->log->info($activity->toJson());
    }


    /** PACKAGES
     *
     * Deduct a item from a package
     * @param $user
     * @param $userpackage
     * @param $package
     * @param $session
     */
    public function packageUsed($user, $userpackage, $session)
    {
        $package = $userpackage->package()->first();

        $class = $session->evercisegroup()->first();

        $amountUsed = $userpackage->amountUsed($userpackage->id);

        $this->activities->create([
            'title'       => $class->name . ' deducted from package',
            'type'        => 'packageused',
            'description' => ($amountUsed > $package->classes ? 'You have ' . ($package->classes - $amountUsed) . ' left with this package' : 'You have used up all classes on this package'),
            'user_id'     => $user->id,
            'type_id'     => $userpackage->id,
            'link'        => ($amountUsed > $package->classes ? 'packages/' : ''),
            'link_title'  => ($amountUsed > $package->classes ? 'Buy more' : ''),
            'image'       => 'packageused.png',
        ]);
    }


}