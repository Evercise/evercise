<?php namespace composers;

use DateTime;
use Evercisesession;
use Sentry;
use Rating;
use Evercisegroup;
use Javascript;

class UserClassesComposer
{

    public function compose($view)
    {
        $user = Sentry::getUser();
        $userId = $user->id;

        $sessions = Evercisesession::whereHas(
            'users',
            function ($query) use (&$userId) {
                $query->where('user_id', $userId);

            }
        )->orderBy('date_time', 'asc')->get();

        $pastFutureCount = [];
        $groupsWithKeys = [];
        $members = [];
        $sessionmember_ids = []; // For rating
        $ratingsWithKeys = [];
        $pastSessionCount = 0;
        $currentDate = new DateTime();
        if ($sessions->count()) {
            $group_ids = [];
            foreach ($sessions as $session_id => $session) {
                if (!in_array($session->evercisegroup_id, $group_ids)) {
                    $group_ids[] = $session->evercisegroup_id;
                }
                $members[$session->id] = count($session->sessionmembers); // Count those members
                foreach ($session->sessionmembers as $sessionmember) {
                    if ($sessionmember->user_id == $user->id) {
                        $sessionmember_ids[$session->id] = $sessionmember->id;
                    }
                }
                if (new DateTime($session->date_time) < $currentDate) {
                    $pastSessionCount ++;
                }
            }

            $pastFutureCount = ['past'   => $pastSessionCount,
                                'future' => ($sessions->count() - $pastSessionCount),
                                'total'  => $sessions->count()
            ];

            $ratings = Rating::whereIn('sessionmember_id', $sessionmember_ids)->get();

            foreach ($ratings as $rating) {
                $ratingsWithKeys[$rating->session_id] = ['comment' => $rating->comment, 'stars' => $rating->stars];
            }

            $groups = Evercisegroup::whereIn('id', $group_ids)->get();

            foreach ($groups as $key => $group) {
                $groupsWithKeys[$group->id] = $group;
            }
        }

        // get current tab

        $viewdata = $view->getData();

        $tab = isset($viewdata['tab']) ? $viewdata['tab'] : 0;

        // initialise js functions for trainer edit

        JavaScript::put(
            [
                'initPut_user_edit'       => json_encode(['selector' => '#user_edit']),
                'initPut_send_invite'     => json_encode(['selector' => '#send_invite']),
                'initPut_password_change' => json_encode(['selector' => '#password_change']),
                'initPut_feedback'        => json_encode(['selector' => '#feedback']),
                'initUsers'               => 1,
                'initToolTip'             => 1, //Initialise tooltip JS.
                'initDashboardPanel'      => 1, // Initialise title swap Trainer JS.
                'selectTab'               => ['tab' => $tab],
                'initAddRating'           => 1
            ]
        );


        $view->with('groups', $groupsWithKeys)
            ->with('sessions', $sessions)
            ->with('members', $members)
            ->with('sessionmember_ids', $sessionmember_ids)
            ->with('ratings', $ratingsWithKeys)
            ->with('pastFutureCount', $pastFutureCount);
    }
}