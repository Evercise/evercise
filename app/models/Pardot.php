<?php

use HGG\Pardot\Connector;
use HGG\Pardot\Exception\PardotException;

/**
 * Class Pardot
 */
class Pardot
{


    /**
     * Construct
     */
    public function __construct()
    {
        $connectorParameters = [
            'email'    => getenv('PARDOT_EMAIL'),
            'user-key' => getenv('PARDOT_KEY'),
            'password' => getenv('PARDOT_PASSWORD'),
            'format'   => getenv('PARDOT_FORMAT') ?: 'json',
            'output'   => getenv('PARDOT_OUTPUT') ?: 'full',
        ];

        $this->connector = new Connector($connectorParameters);

    }


    public function createUnregisteredUser($email)
    {
        $params = [
            'email'      => $email,
            'first_name' => 'Invited',
            'last_name'  => 'Invited',
            'country'    => 'United Kingdom'
        ];

        $create = $this->connector->post('prospect', 'create', $params);

        return $create;
    }

    public function createUser($user)
    {

        $params = [
            'email'      => $user->email,
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'country'    => 'United Kingdom',
            'phone'      => $user->phone,
            'Birthdate'  => $user->dob
        ];

        $create = $this->connector->post('prospect', 'create', $params);

        return $create;

    }


    /**
     * @param $email
     * @return \Cartalyst\Sentry\Users\UserInterface
     * @internal param $user
     */
    public function getUser($email)
    {

        try {
            $user = Sentry::findUserByLogin($email);
        } catch (Exception $e) {
            try {
                $pardot_user = $this->connector->post('prospect', 'read', ['email' => $email]);
            } catch (\Exception $e) {
                $pardot_user = $this->createUnregisteredUser($email);
            }

            return $pardot_user['id'];
        }

        if (empty($user->salesforce_id)) {

            $events = App::make('events\Tracking');

            $user = $events->registerUserTracking($user, ($user->isTrainer() ? 'TRAINER' : 'USER'));

        }

        if (empty($user->pardot_id)) {

            try {
                $pardot_user = $this->connector->post('prospect', 'read', ['email' => $user->email]);
            } catch (\Exception $e) {
                \Log::info($e->getMessage());
                $pardot_user = $this->createUser($user);
            }

            if (!empty($pardot_user['id'])) {
                $user->pardot_id = $pardot_user['id'];
                $user->save();
            }

        }


        return $user;
    }

    /**
     * @param $user_email
     * @param $campaign_id
     * @param PardotEmail $mail
     */
    public function send($user_email, $campaign_id, PardotEmail $mail)
    {

        throw new Exception('No Message Sent');

        $user = $this->getUser($user_email);

        $pardot_id = FALSE;

        if (!empty($user->pardot_id) && $user->pardot_id > 0) {

            $pardot_id = $user->pardot_id;

        } else {
            if (!empty($user)) {
                $pardot_id = $user;
            }
        }


        if ($pardot_id) {
            $params = [
                'campaign_id'  => $campaign_id,
                'prospect_id'  => $pardot_id,
                'name'         => $mail->subject,
                'subject'      => $mail->subject,
                'text_content' => $mail->plainText,
                'html_content' => $mail->content,
                'from_email'   => $mail->from,
                'from_name'    => $mail->fromName
            ];

            $send = $this->connector->post('email', 'send', $params);


            if (!empty($send['id'])) {
                return TRUE;
                Log::info('Pardot Campaign  ' . $campaign_id . ' : ' . $send['id'] . ' Sent to user ' . $user_email);
            }
        }

        Log::error('No Message Sent ' . $user_email . ' ' . $campaign_id);

        throw new Exception('No Message Sent');

    }


}