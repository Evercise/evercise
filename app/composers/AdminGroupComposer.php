<?php namespace composers;

use Evercisegroup;
use Input;
use Subcategory;

class AdminGroupComposer {

    public function compose($view)
    {
        //JavaScript::put(['initSearchByName' => 1 ]);

        $cats = ( Subcategory::lists( 'name') );
        $categories = json_encode($cats);

        $status = Input::get('status');
        $searchTerm = Input::get('search');
        $orderBy = Input::get('order') ? Input::get('order') : 'id';

        $selectedGroups = [];

        if ($status == 'active')
        {
            if ($searchTerm != "")
                $futuregroups = Evercisegroup::has('futuresessions')->where('name', 'LIKE', '%'.$searchTerm.'%')->orderBy($orderBy)->get();
            else
                $futuregroups = Evercisegroup::has('futuresessions')->orderBy($orderBy)->get();

            foreach($futuregroups as $futuregroup)
            {
                array_push($selectedGroups, $futuregroup);
            }
        }
        else if ($status == 'expired')
        {
            $pastGroupIds = [];
            $futureGroupIds = [];
            $futuregroups = Evercisegroup::has('futuresessions')->orderBy($orderBy)->get();

            if ($searchTerm != "")
                $pastgroups = Evercisegroup::has('pastsessions')->where('name', 'LIKE', '%'.$searchTerm.'%')->orderBy($orderBy)->get();
            else
                $pastgroups = Evercisegroup::has('pastsessions')->orderBy($orderBy)->get();

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
            if ($searchTerm != "")
                $evercisegroups = Evercisegroup::where('name', 'LIKE', '%'.$searchTerm.'%')->orderBy($orderBy)->get();
            else
                $evercisegroups = Evercisegroup::orderBy($orderBy)->get();

            foreach($evercisegroups as $evercisegroup)
            {
                array_push($selectedGroups, $evercisegroup);
            }
        }


        return $view
            ->with('categories', $categories)
            ->with('selectedGroups', $selectedGroups)
            ->with('status', $status)
            ->with('search', $searchTerm);
    }
}