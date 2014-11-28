<?php  namespace events;


use Activities;
use Evercisesession;
use Illuminate\Config\Repository;
use Illuminate\Log\Writer;
use Illuminate\Events\Dispatcher;

class Activity
{
    /**
     * @var Dispatcher
     */
    private $config;
    private $log;
    private $event;
    private $activities;
    private $evercisesession;

    public function __construct(
        Writer $log,
        Repository $config,
        Dispatcher $event,
        Activities $activities,
        Evercisesession $evercisesession
    ) {
        $this->config          = $config;
        $this->log             = $log;
        $this->event           = $event;
        $this->activities      = $activities;
        $this->activities      = $activities;
        $this->evercisesession = $evercisesession;
    }

    private function getSession($id)
    {
        $session = $this->evercisesession->find($id);
    }


    public function payedClass($class, $user)
    {
        $this->activities->create([
            'description' => 'Joined class ' . $class->name,
            'type'        => 'payedclass',
            'user_id'     => $user->id,
            'type_id'     => $class->id
        ]);
    }


    public function canceledClass($class, $user)
    {
        $this->activities->create([
            'description' => 'Canceled class ' . $class->name,
            'type'        => 'canceledclass',
            'user_id'     => $user->id,
            'type_id'     => $class->id
        ]);
    }


    public function walletToppup($user, $transaction)
    {

        $this->activities->create([
            'description' => '£' . $amount . ' Topped up Wallet',
            'type'        => 'wallettoppup',
            'user_id'     => $user->id
        ]);


        $this->activities->create([
            'title' => 'Top Up',
            'type'        => 'wallettoppup',
            'description' => '£'.$transaction->total.' credit to your account on '.date('d/m/y'),
            'user_id'     => $user->id,
            'type_id'     => $transaction->id,
            'link'        => 'transactions/'.$transaction->id,
            'link_title'  => 'View',
            'image'       => 'wallettoppup.png',
        ]);

    }

    public function walletWithdraw($user, $amount = 0)
    {

        $this->activities->create([
            'description' => '£' . $amount . ' amount Withdrawn',
            'type'        => 'walletwithdraw',
            'user_id'     => $user->id
        ]);
    }

    public function userEditProfile($user)
    {

        $this->activities->create([
            'description' => 'Edited your profile',
            'type'        => 'editprofile',
            'user_id'     => $user->id
        ]);
    }

    public function linkFacebook($user)
    {

        $this->activities->create([
            'description' => 'Linked Facebook account',
            'type'        => 'linkfacebook',
            'user_id'     => $user->id
        ]);
    }

    public function linkTwitter($user)
    {

        $this->activities->create([
            'description' => 'Linked Twitter account',
            'type'        => 'linktwitter',
            'user_id'     => $user->id
        ]);
    }

    public function invitedEmail($user, $email = '')
    {

        if ($email != '') {

            $this->activities->create([
                'description' => 'Invited ' . $email . ' to join Evercise',
                'type'        => 'invitedemail',
                'user_id'     => $user->id
            ]);
        }
    }

    public function createdClass($class, $user)
    {
        $this->activities->create([
            'description' => 'Created Class ' . $class->name,
            'type'        => 'createdclass',
            'user_id'     => $user->id,
            'type_id'     => $class->id
        ]);
    }

    public function createdVenue($venue, $user)
    {

        $this->activities->create([
            'description' => 'Created Venue ' . $venue->name,
            'type'        => 'createdvenue',
            'user_id'     => $user->id,
            'type_id'     => $venue->id
        ]);
    }

    public function createdSessions($class, $user)
    {

        $this->activities->create([
            'description' => 'Created Multiple sessions for ' . $class->name,
            'type'        => 'createdsessions',
            'user_id'     => $user->id,
            'type_id'     => $class->id
        ]);
    }

    public function updatedClass($class, $user)
    {
        $this->activities->create([
            'description' => 'Updated Class ' . $class->name,
            'type'        => 'updatedclass',
            'user_id'     => $user->id,
            'type_id'     => $class->id
        ]);
    }

    public function updatedVenue($venue, $user)
    {
        $this->activities->create([
            'description' => 'Updated Venue ' . $venue->name,
            'type'        => 'updatedvenue',
            'user_id'     => $user->id,
            'type_id'     => $venue->id
        ]);
    }

    public function updatedSessions($class, $user)
    {
        $this->activities->create([
            'description' => 'Created Sessions for ' . $class->name,
            'type'        => 'updatedsessions',
            'user_id'     => $user->id,
            'type_id'     => $class->id
        ]);
    }

    public function deletedClass($class, $user)
    {
        $activity = $this->activities->create([
            'description' => 'Deleted Class ' . $class->name,
            'type'        => 'deletedclass',
            'user_id'     => $user->id,
            'type_id'     => $class->id
        ]);
        Log::info($activiti->id);
    }

    public function deletedVenue($venue, $user)
    {
        $this->activities->create([
            'description' => 'Deleted Venue ' . $venue->name,
            'type'        => 'deletedclass',
            'user_id'     => $user->id,
            'type_id'     => $venue->id
        ]);
    }

    public function deletedSessions($class, $user)
    {
        $this->activities->create([
            'description' => 'Deleted Sessions ' . $class->name,
            'type'        => 'deletedsessions',
            'user_id'     => $user->id,
            'type_id'     => $class->id
        ]);
    }


    public function usedReviewedClass($user, $class)
    {

        $this->activities->create([
            'title' => 'You recently reviewed',
            'type'        => 'classreviewed',
            'description' => $class->name,
            'user_id'     => $user->id,
            'type_id'     => $class->id,
            'link'        => 'class/'.$class->id,
            'link_title'  => 'View',
            'image'       => 'classreviewed.png',
        ]);


    }

    public function usedCoupon($coupon, $user)
    {

        $this->activities->create([
            'title' => 'You used the coupon code: ' . $coupon->coupon,
            'type'        => 'couponused',
            'description' => ($coupon->type == 'amount' ? 'Worth £'.$coupon->amount : 'With '.$coupon->percentage.'% discount'),
            'user_id'     => $user->id,
            'type_id'     => $coupon->id,
            'link'        => '',
            'link_title'  => '',
            'image'       => 'couponused.png',
        ]);


    }

    public function userCartCompleted($user, $cart, $transaction)
    {

        $title       = 'You recently made a purchase';
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


        $description .= ' for £' . $cart['total']['final_cost'];

        $data     = [
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

}