<?php

class SessionsController extends \BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function setCheckoutSessionData()
    {
        $sessionIds = json_decode(Input::get('session-ids'), TRUE);
        $evercisegroupId = json_decode(Input::get('evercisegroup-id'), TRUE);
        Session::put('sessionIds', $sessionIds);
        Session::put('evercisegroupId', $evercisegroupId);

    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($evercisegroup_id = '')
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($class_id)
    {
        $sessions = Evercisegroup::find($class_id)->evercisesession;
        $data = [
            'evercisegroup_id' => $class_id
        ];

        return View::make('v3.classes.add_sessions')->with('data', $data)->with('sessions', $sessions);
    }


    /**
     * Show the popup form for mailing all users signed up to a session
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getMailAll($id)
    {
        return View::make('sessions.mail_all')->with('sessionId', $id);
    }

    /**
     * Send the mail to all users signed up to a session
     *
     * @param $sessionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function postMailAll($sessionId)
    {
        $userList = [];
        foreach (Evercisesession::getMembers($sessionId) as $user) {
            $userList[$user->first_name . ' ' . $user->last_name] = $user->email;
        }

        return Evercisesession::mailMembers($sessionId, $userList);
    }

    /**
     * Show the form to send a mail to a single user
     *
     * @param $sessionId
     * @param $userId
     * @return \Illuminate\View\View
     */
    public function getMailOne($sessionId, $userId)
    {
        $userDetails = User::where('id', $userId)->select('first_name', 'last_name')->first();
        $name = $userDetails['first_name'] . ' ' . $userDetails['last_name'];

        return View::make('sessions.mail_one')->with('sessionId', $sessionId)->with('userId', $userId)->with(
            'firstName',
            $name
        );
    }

    /**
     * Send the mail to a single user
     *
     * @param $sessionId
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function postMailOne($sessionId, $userId)
    {
        $userDetails = User::getNameAndEmail($userId);
        $userList = [$userDetails['name'] => $userDetails['email']];

        return Evercisesession::mailMembers($sessionId, $userList);
    }

    /**
     * Get for to send an email to the trainer of a group
     *
     * @param $sessionId
     * @param $trainerId
     * @return \Illuminate\View\View
     */
    public function getMailTrainer($sessionId, $trainerId)
    {
        $session = Evercisesession::with('evercisegroup')->find($sessionId);
        $dateTime = $session->date_time;
        $groupName = $session->evercisegroup->name;

        $name = User::getName($trainerId);

        return View::make('sessions.mail_trainer')
            ->with('sessionId', $sessionId)
            ->with('trainerId', $trainerId)
            ->with('userId', Sentry::getUser()->id)
            ->with('dateTime', $dateTime)
            ->with('groupName', $groupName)
            ->with('name', $name);
    }

    /**
     * @param $sessionId
     * @param $trainerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function postMailTrainer($sessionId, $trainerId)
    {
        list($groupId, $groupName) = Evercisesession::mailTrainer($sessionId, $trainerId);

        return Response::json(
            [
                'message'  => 'group: ' . $groupId . ': ' . $groupName . ', session: ' . $sessionId,
                'callback' => 'mailSent'
            ]
        );
    }

    /**
     * check login status and either direct to checkout, or open login box
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function checkout()
    {
        $this->setCheckoutSessionData();

        $redirect_after_login_url = 'sessions.join.get';

        if (!Sentry::getUser()) {
            return View::make('auth.login')->with('redirect_after_login', TRUE)->with(
                'redirect_after_login_url',
                $redirect_after_login_url
            );
        } else {
            return Response::json(['status' => 'logged_in']);
        }
    }

    /**
     *
     *
     * confirmation for join sessions
     */
    public function joinSessions()
    {
        $sessionIds = Session::get('sessionIds', FALSE);
        $evercisegroupId = Session::get('evercisegroupId', FALSE);
        if (!$sessionIds) {
            $sessionIds = json_decode(Input::get('session-ids'), TRUE);
        }
        if (!$evercisegroupId) {
            $evercisegroupId = Input::get('evercisegroup-id');
        }

        if (empty($sessionIds)) {
            return Redirect::route('evercisegroups.show', [$evercisegroupId]);
        }

        if ($joinParams = Evercisesession::confirmJoinSessions($evercisegroupId, $sessionIds)) {
            Session::put('sessionIds', $sessionIds);
            Session::put('amountToPay', $joinParams['totalPrice']);

            return View::make('sessions.join')
                ->with('evercisegroup', $joinParams['evercisegroup'])
                ->with('members', $joinParams['members'])
                ->with('userTrainer', $joinParams['userTrainer'])
                ->with('totalPrice', $joinParams['totalPrice'])
                ->with('totalPricePence', $joinParams['totalPricePence'])
                ->with('totalSessions', $joinParams['totalSessions'])
                ->with('sessionIds', $joinParams['sessionIds']);
        } else {
            return Response::json('USER HAS ALREADY JOINED SESSION');
        }
    }


    /**
     * Get the form for leaving a session
     *
     * @param $evercisesessionId
     * @return \Illuminate\View\View
     */
    function getLeaveSession($evercisesessionId)
    {
        $leaveParams = Evercisesession::getLeaveSessionForm($evercisesessionId);

        return View::make('sessions.leave')
            ->with('session', $leaveParams['session'])
            ->with('refund', $leaveParams['refund'])
            ->with('refundInEvercoins', $leaveParams['refundInEvercoins'])
            ->with('evercoinBalanceAfterRefund', $leaveParams['evercoinBalanceAfterRefund'])
            ->with('evercoin', $leaveParams['evercoin'])
            ->with('status', $leaveParams['status']);
    }

    public function postLeaveSession($id)
    {
        return Evercisesession::processLeaveSession($id);
    }


    public function redeemEvercoins($evercisegroupId)
    {
        $usecoins = Input::get('redeem');
        $sessionIds = Session::get('sessionIds');

        $evercoinParams = Evercisesession::getRedeemEvercoinsView($evercisegroupId, $usecoins, $sessionIds);

        Session::put('amountToPay', $evercoinParams['amountRemaining']);

        if ($evercoinParams['priceInEvercoins'] == $evercoinParams['usecoins']) {

            return Response::json(
                [
                    'callback' => 'openPopup',
                    'popup'    => (string)View::make('sessions.checkoutwithevercoins')
                        ->with('evercisegroupId', $evercisegroupId)
                        ->with('priceInEvercoins', $evercoinParams['priceInEvercoins'])
                        ->with('evercoinBalance', $evercoinParams['evercoinBalance'])
                        ->with('usecoinsInPounds', $evercoinParams['usecoinsInPounds'])
                ]
            );


        } else {

            return Response::json(
                [
                    'usecoins'         => $usecoins,
                    'amountRemaining'  => $evercoinParams['amountRemaining'],
                    'usecoinsInPounds' => $evercoinParams['usecoinsInPounds'],
                    'callback'         => 'paidWithEvercoins'
                ]
            );
        }
    }


    /**
     * Put evercoin payment details into the session and then add member to class
     *
     * @param $evercisegroupId
     * @return \Illuminate\View\View
     */
    public function postPayWithEvercoins($evercisegroupId)
    {
        Session::put('paymentMethod', 'evercoins');
        Session::put(
            'transactionId',
            substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 1) . substr(
                str_shuffle('aBcEeFgHiJkLmNoPqRstUvWxYz0123456789'),
                0,
                10
            )
        );


        return $this->payForSessions($evercisegroupId);

    }

    public function getRefund($id)
    {
        $session = Evercisesession::with('evercisegroup')->find($id);

        $sessionDate = new DateTime($session->date_time);
        $now = new DateTime();
        $twodaystime = (new DateTime())->add(new DateInterval('P2D'));
        $fivedaystime = (new DateTime())->add(new DateInterval('P5D'));

        $evercoin = Evercoin::where('user_id', $session->evercisegroup->user_id)->first();


        if ($sessionDate > $fivedaystime) {
            $status = 2;
            $refund = $session->price;

        } elseif ($sessionDate > $twodaystime) {
            $status = 1;
            $refund = $session->price / 2;
        } else {
            $status = 0;
            $refund = 0;
        }

        $refundInEvercoins = Evercoin::poundsToEvercoins($refund);
        $evercoinBalanceAfterRefund = $evercoin->balance + $refundInEvercoins;

        return View::make('sessions.refund_request')
            ->with('session', $session)
            ->with('refund', $refund)
            ->with('refundInEvercoins', $refundInEvercoins)
            ->with('evercoinBalanceAfterRefund', $evercoinBalanceAfterRefund)
            ->with('evercoin', $evercoin)
            ->with('status', $status);
    }


    public function postRefund($sessionId)
    {

        $validator = Validator::make(
            Input::all(),
            [
                'mail_subject' => 'required',
                'mail_body'    => 'required',
            ]
        );
        if ($validator->fails()) {

            $result = [
                'validation_failed' => 1,
                'errors'            => $validator->errors()->toArray()
            ];

            return Response::json($result);

        } else {
            $subject = Input::get('mail_subject');
            $body = Input::get('mail_body');
            $contact = 'contact@evercise.com';

            $groupId = Evercisesession::where('id', $sessionId)->pluck('evercisegroup_id');
            $groupName = Evercisegroup::where('id', $groupId)->pluck('name');

            Event::fire(
                'session.refund',
                [

                    'email'     => $contact,
                    'userName'  => Sentry::getUser()->display_name,
                    'userEmail' => Sentry::getUser()->email,
                    'groupName' => $groupName,
                    'subject'   => $subject,
                    'body'      => $body
                ]
            );
        }

        return Response::json(['callback' => 'successAndRefresh']);
    }


}