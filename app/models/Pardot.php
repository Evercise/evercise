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

    public function createUser($user) {

        $params = [
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'country' => 'United Kingdom',
            'phone' => $user->phone,
            'Birthdate' => $user->dob
        ];

        \Log::info('what');

        $create = $this->connector->post('prospect', 'create', $params);


        d($create);

        return $create;




    }



    /**
     * @param $user
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public function getUser($user)
    {
        $user = Sentry::findUserByLogin($user);

        if (empty($user->salesforce_id)) {

            $events = App::make('events\Tracking');

            $user = $events->registerUserTracking($user, ($user->isTrainer() ? 'TRAINER' : 'USER'));

        }

        if (empty($user->pardot_id)) {

            try{
                $pardot_user = $this->connector->post('prospect', 'read', ['email' => $user->email]);
            } catch (\Exception $e) {
                \Log::info($e->getMessage());
                $pardot_user = $this->createUser($user);
            }

            $user->pardot_id = $pardot_user['id'];
            $user->save();

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
        $user = $this->getUser($user_email);

        if (!empty($user->pardot_id) && $user->pardot_id > 0) {
            $params = [
                'campaign_id'  => $campaign_id,
                'prospect_id'  => $user->pardot_id,
                'name'         => $mail->subject,
                'subject'      => $mail->subject,
                'text_content' => $mail->plainText,
                'html_content' => $mail->content,
                'from_email'   => $mail->from,
                'from_name'    => $mail->fromName
            ];

            try {
                $send = $this->connector->post('email', 'send', $params);

                if (!empty($send['id'])) {
                    Log::info('Pardot Campaign  ' . $campaign_id . ' : ' . $send['id'] . ' Sent to user ' . $user_email);

                }
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }

            return TRUE;

        }

        Log::error('No Message Sent ' . $user_email . ' ' . $campaign_id);
    }


}