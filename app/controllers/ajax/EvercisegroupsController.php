<?php namespace ajax;

use Input, Response, Validator, Event, Evercisegroup, Subcategory, Trainerhistory;

class EvercisegroupsController extends AjaxBaseController{



    /**
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public static function store($inputs, $user)
    {
        $validator = Validator::make(
            $inputs,
            [
                'classname' => 'required|max:100|min:5',
                'description' => 'required|max:5000|min:100',
                'image' => 'required',
                'venue' => 'required',
            ]
        );
        if ($validator->fails()) {
            $result = array(
                'validation_failed' => 1,
                'errors' => $validator->errors()->toArray()
            );
            return Response::json($result);
        } else {

            $classname = $inputs['classname'];
            $description = $inputs['description'];
            $image = $inputs['image'];
            $venue = $inputs['venue'];

            // Push categories into an array, and fail if there are none.
            $categories = [];
            if ($inputs['category1'] != '')
                array_push($categories, $inputs['category1']);
            if ($inputs['category2'] != '')
                array_push($categories, $inputs['category2']);
            if ($inputs['category3'] != '')
                array_push($categories, $inputs['category3']);

            if (empty($categories)) {
                return Response::json(
                    ['validation_failed' => 1, 'errors' => ['category1' => 'you must choose at least one category']]
                );
            }

            // convert array of category names into id's
            foreach ($categories as $key => $category) {
                if (!$categories[$key] = Subcategory::where('name', $category)->pluck('id')) {
                    return Response::json(
                        [
                            'validation_failed' => 1,
                            'errors' => [('category' . ($key + 1)) => 'One of the categories you have chosen is not in the list']
                        ]
                    );
                }
            }

            $evercisegroup = Evercisegroup::create(
                [
                    'name' => $classname,
                    'user_id' => $user->id,
                    'venue_id' => $venue,
                    'description' => $description,
                    'image' => $image,
                    'venue_id' => $venue,
                ]
            );

            $evercisegroup->subcategories()->attach($categories);

            Trainerhistory::create(
                [
                    'user_id' => $user->id,
                    'type' => 'created_evercisegroup',
                    'display_name' => $user->display_name,
                    'name' => $evercisegroup->name
                ]
            );

            Event::fire('evecisegroup.created', [$user, $evercisegroup]);

            return Response::json(['success' => 'true', 'id' => $evercisegroup->id ]);
        }
    }
}