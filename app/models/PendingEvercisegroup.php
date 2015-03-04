<?php
use Carbon\Carbon;

/**
 * Class PendingEvercisegroup
 */
class PendingEvercisegroup extends \Eloquent
{

    /**
     * @var array
     */
    protected $fillable = [
        'evercisegroup_id',
        'user_id',
        'venue_id',
        'name',
        'description',
        'image',
        'subcategories',
        'type',
        'status'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pending_evercisegroups';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function evercisegroup()
    {
        return $this->belongsTo('Evercisegroup');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    public function getSubcategoryIds()
    {
        $subcatIds = explode(',', $this->subcategories);

        return $subcatIds;
    }

    public static function storeUpdate($user, $evercisegroup)
    {
        $pendingG = static::create([
            'evercisegroup_id' => $evercisegroup->id,
            'user_id' => $user->id,
            'venue_id' => $evercisegroup->venue_id,
            'name' => $evercisegroup->name,
            'description' => $evercisegroup->description,
            'image' => $evercisegroup->image,
            'subcategories' => implode(',', $evercisegroup->getSubcategoryIds()),
            'type' => 'admin_update',
            'status' => 0
        ]);

        return $pendingG;
    }

    /**
     * @param $inputs
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
 /*   public static function validateAndStore($inputs, $user) // Lets not do it this way, as trainer will not be able to add sessions until class is confirmed.
    {
        $validator = Evercisegroup::validateInputs($inputs);

        if ($validator->fails()) {
            $result = [
                'validation_failed' => 1,
                'errors'            => $validator->errors()->toArray()
            ];

            return Response::json($result);
        } else {

            $classname = $inputs['class_name'];
            $description = $inputs['class_description'];
            $image = $inputs['image'];

            if ($inputs['gallery_image'] == 'true') {
                $image = Gallery::selectImage($image, $user, $classname);
            }


            $venueId = $inputs['venue_select'];
            if (!Venue::find($venueId)) {
                return Response::json(
                    ['validation_failed' => 1, 'errors' => ['venue_select' => 'Please select or create a new venue']]
                );
            }

            if (count($inputs['category_array']) == 1)
                $categoryNames = explode(',', $inputs['category_array'][0]);
            else
                $categoryNames = $inputs['category_array'];

            $categoryIds = Subcategory::namesToIds($categoryNames);

            if (empty($categoryIds)) {
                return Response::json(
                    ['validation_failed' => 1, 'errors' => ['category-select' => 'You must choose at least one category']]
                );
            }

            $pendingG = static::create([
                'user_id' => $user->id,
                'venue_id' => $venueId,
                'name' => $classname,
                'description' => $description,
                'image' => $image,
                'subcategories' => implode(',', $categoryIds),
                'type' => 'new',
                'status' => 0
            ]);

            Trainerhistory::create(
                [
                    'user_id'      => $user->id,
                    'type'         => 'created_evercisegroup_request',
                    'display_name' => $user->display_name,
                    'name'         => $classname
                ]
            );

            event('class.requested', [$pendingG, $user]);

            return Response::json(
                [
                    'url'     => route('sessions.add', $evercisegroup->id),
                    'success' => 'true',
                    'id'      => $evercisegroup->id
                ]
            );
        }
    }*/
}