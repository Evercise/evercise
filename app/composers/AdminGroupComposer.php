<?php namespace composers;

use JavaScript;
use Evercisegroup;

class AdminGroupComposer {

    public function compose($view)
    {
        //JavaScript::put(['initSearchByName' => 1 ]);

        $cats = ( \Subcategory::lists( 'name') );
        $categories = json_encode($cats);

        JavaScript::put(['category_list' => 'cockmuncherrrr!' ]);

        $status = \Input::get('status');



        $selectedGroups = [];

        if ($status == 'active')
        {
            $futuregroups = Evercisegroup::has('futuresessions')->get();
            foreach($futuregroups as $futuregroup)
            {
                array_push($selectedGroups, $futuregroup);
            }
        }
        else if ($status == 'expired')
        {
            $pastGroupIds = [];
            $futureGroupIds = [];
            $futuregroups = Evercisegroup::has('futuresessions')->get();
            $pastgroups = Evercisegroup::has('pastsessions')->get();
            foreach($pastgroups as $pastgroup) array_push($pastGroupIds, $pastgroup->id);
            foreach($futuregroups as $futuregroup) array_push($futureGroupIds, $futuregroup->id);
            foreach($pastgroups as $pastgroup)
            {
                if(! in_array($pastgroup->id, $futureGroupIds))
                    array_push($selectedGroups, $pastgroup);
            }
        }
        else
        {
            $evercisegroups = Evercisegroup::get();
            foreach($evercisegroups as $evercisegroup)
            {
                array_push($selectedGroups, $evercisegroup);
            }
        }


        return $view
            ->with('categories', $categories)
            ->with('selectedGroups', $selectedGroups);
    }
}