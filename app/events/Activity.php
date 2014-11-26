<?php  namespace events;


use Activities;
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

    public function __construct(Writer $log, Repository $config, Dispatcher $event, Activities $activities)
    {
        $this->config = $config;
        $this->log = $log;
        $this->event = $event;
        $this->activities = $activities;
    }


    public function payedClass($class, $user)
    {
        $this->activities->create([
            'description' => 'Joined class ' . $class->name,
            'type' => 'payedclass',
            'user_id' => $user->id,
            'type_id' => $class->id
        ]);
    }


    public function canceledClass($class, $user)
    {
        $this->activities->create([
            'description' => 'Canceled class ' . $class->name,
            'type' => 'canceledclass',
            'user_id' => $user->id,
            'type_id' => $class->id
        ]);
    }


    public function walletToppup($user, $amount = 0)
    {

        $this->activities->create([
            'description' => '£' . $amount . ' Topped up Wallet',
            'type' => 'wallettoppup',
            'user_id' => $user->id
        ]);
    }

    public function walletWithdraw($user, $amount = 0)
    {

        $this->activities->create([
            'description' => '£' . $amount . ' amount Withdrawn',
            'type' => 'walletwithdraw',
            'user_id' => $user->id
        ]);
    }

    public function userEditProfile($user)
    {

        $this->activities->create([
            'description' => 'Edited your profile',
            'type' => 'editprofile',
            'user_id' => $user->id
        ]);
    }

    public function linkFacebook($user)
    {

        $this->activities->create([
            'description' => 'Linked Facebook account',
            'type' => 'linkfacebook',
            'user_id' => $user->id
        ]);
    }

    public function linkTwitter($user)
    {

        $this->activities->create([
            'description' => 'Linked Twitter account',
            'type' => 'linktwitter',
            'user_id' => $user->id
        ]);
    }

    public function invitedEmail($user, $email = '')
    {

        if ($email != '') {

            $this->activities->create([
                'description' => 'Invited ' . $email . ' to join Evercise',
                'type' => 'invitedemail',
                'user_id' => $user->id
            ]);
        }
    }

    public function createdClass($class, $user)
    {
        $this->activities->create([
            'description' => 'Created Class ' . $class->name,
            'type' => 'createdclass',
            'user_id' => $user->id,
            'type_id' => $class->id
        ]);
    }

    public function createdVenue($venue, $user)
    {

        $this->activities->create([
            'description' => 'Created Venue ' . $venue->name,
            'type' => 'createdvenue',
            'user_id' => $user->id,
            'type_id' => $venue->id
        ]);
    }

    public function createdSessions($class, $user)
    {

        $this->activities->create([
            'description' => 'Created Multiple sessions for ' . $class->name,
            'type' => 'createdsessions',
            'user_id' => $user->id,
            'type_id' => $class->id
        ]);
    }

    public function updatedClass($class, $user)
    {
        $this->activities->create([
            'description' => 'Updated Class ' . $class->name,
            'type' => 'updatedclass',
            'user_id' => $user->id,
            'type_id' => $class->id
        ]);
    }

    public function updatedVenue($venue, $user)
    {
        $this->activities->create([
            'description' => 'Updated Venue ' . $venue->name,
            'type' => 'updatedvenue',
            'user_id' => $user->id,
            'type_id' => $venue->id
        ]);
    }

    public function updatedSessions($class, $user)
    {
        $this->activities->create([
            'description' => 'Created Sessions for ' . $class->name,
            'type' => 'updatedsessions',
            'user_id' => $user->id,
            'type_id' => $class->id
        ]);
    }

    public function deletedClass($class, $user)
    {
        $this->activities->create([
            'description' => 'Deleted Class ' . $class->name,
            'type' => 'deletedclass',
            'user_id' => $user->id,
            'type_id' => $class->id
        ]);
    }

    public function deletedVenue($venue, $user)
    {
        $this->activities->create([
            'description' => 'Deleted Venue ' . $venue->name,
            'type' => 'deletedclass',
            'user_id' => $user->id,
            'type_id' => $venue->id
        ]);
    }

    public function deletedSessions($class, $user)
    {
        $this->activities->create([
            'description' => 'Deleted Sessions ' . $class->name,
            'type' => 'deletedsessions',
            'user_id' => $user->id,
            'type_id' => $class->id
        ]);
    }


}