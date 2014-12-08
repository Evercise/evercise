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
            $pardot_user = $this->connector->post('prospect', 'read', ['email' => $user->email]);

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

        if (!empty($user->pardot_id)) {
            $params = [
                'campaign_id'  => $campaign_id,
                'prospect_id'  => $user->pardot_id,
                'name'         => $mail->subject,
                'subject'      => $mail->subject,
                'text_content' => $mail->content,
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