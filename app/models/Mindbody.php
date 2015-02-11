<?php


use Carbon\Carbon;
use MindbodyAPI\structures\UserCredentials;
use MindbodyAPI\MindbodyClient;

class Mindbody
{


    private $siteId;
    private $api_key;
    private $api_secret;
    private static $service = NULL;


    public function __construct(User $user)
    {
        $this->user = $user;
        $this->siteId = $user->mindbody->site_id;
        $this->api_key = Config::get('evercise.mindbody.api_key');
        $this->api_secret = Config::get('evercise.mindbody.api_secret');


        $this->user_credentials = new UserCredentials();
        $this->user_credentials->Username = $user->mindbody->user_login;
        $this->user_credentials->Password = $user->mindbody->user_pass;
        $this->user_credentials->SiteIDs = [(int)$user->mindbody->site_id];

    }


    /************ VENUES  ***************/


    public function importVenues()
    {
        $venues = $this->getVenues();

        $ids = [];
        foreach ($venues as $v) {

            $v = array_filter($v);

            $venue = VenueImport::where($v);
            if ($venue->count() == 0) {
                $venue = VenueImport::create($v);
                echo 'NEW <br/>';
            } else {
                $venue = $venue->first();
                echo 'OLD <br/>';
            }

            /** Not Sure what to do with the venue here */
            $ids[] = $venue->id;
        }

        return $ids;

    }

    public function getVenues()
    {
        $service = $this->getService('SiteService');
        $request = $service::request('GetLocations', $this->credentials);
        $apiLocations = $service->GetLocations($request);

        $locations = [];

        if ($apiLocations->ErrorCode == 200) {

            if ($apiLocations->ResultCount == 0) {
                return FALSE;
            }

            foreach ($apiLocations->Locations->Location as $l) {
                $locations[] = [
                    'user_id'     => $this->user->id,
                    'external_id' => $l->ID,
                    'name'        => $l->Name,
                    'source'      => 'mindbody',
                    'address'     => $l->Address,
                    'town'        => $l->City,
                    'postcode'    => $l->PostalCode,
                    'lat'         => $l->Latitude,
                    'lng'         => $l->Longitude,
                    'image'       => $l->ImageURL
                ];
            }

        }

        return $locations;

    }


    /************ CLASSES  ***************/

    public function importClasses()
    {
        $classes = $this->getClassSchedules();

        $ids = [];
        foreach ($classes as $c) {

            $v = array_filter($v);

            $venue = VenueImport::where($v);
            if ($venue->count() == 0) {
                $venue = VenueImport::create($v);
                echo 'NEW <br/>';
            } else {
                $venue = $venue->first();
                echo 'OLD <br/>';
            }

            /** Not Sure what to do with the venue here */
            $ids[] = $venue->id;
        }


        d($ids);

    }
//['ClassScheduleIDs' => [2206]
    public function getClassScheduless($classID = 0)
    {
        $service = $this->getService('ClassService');
        $request = $service::request('GetClassSchedules', $this->credentials, null);
        $apiClasses = $service->GetClassSchedules($request);


        return $apiClasses;
    }

    public function getClassVisits($classID = 0)
    {
        $service = $this->getService('ClassService');
        $request = $service::request('GetClassVisits', $this->credentials, null, ['ClassID' => 2152]);
        $apiClasses = $service->GetClassVisits($request);


        return $apiClasses;
    }
    public function getSchedules()
    {
        $service = $this->getService('ClassService');
        $request = $service::request('GetClassSchedules', $this->credentials);
        $apiClasses = $service->GetClassSchedules($request);


        return $apiClasses;
        $schedules = [];

        if ($apiClasses->ErrorCode == 200) {

            if ($apiClasses->ResultCount == 0) {
                return FALSE;
            }

            foreach ($apiClasses->ClassSchedules->ClassSchedule as $c) {

                $schedules[$c->ClassScheduleID] = [
                      //  'visits' => $

                    ];


            }

        }

        return $classes;

    }


    public function getEnrollments($classId = 0) {


        $service = $this->getService('ClassService');
        $request = $service::request('GetEnrollments', $this->credentials, null);

        $apiClasses = $service->GetEnrollments($request);

        return $apiClasses;
    }


    public function formatClassDescription($class)
    {
        return [
            'user_id'           => $this->user->id,
            'evercisegroup_id'  => 0,
            'external_id'       => $class->ClassDescription->ID,
            'external_venue_id' => $class->Location->ID,
            'source'            => 'mindbody',
            'name'              => $class->ClassDescription->Name,
            'description'       => $class->ClassDescription->Description,
            'image'             => $class->ClassDescription->ImageURL
        ];

    }

    public function getClassSchedules()
    {

        $service = $this->getService('ClassService');
        $request = $service::request('GetClassSchedules', $this->credentials);
        $apiClasses = $service->GetClassSchedules($request);


        return $apiClasses;
        $classes = [];

        if ($apiClasses->ErrorCode == 200) {

            if ($apiClasses->ResultCount == 0) {
                return FALSE;
            }

            foreach ($apiClasses->ClassSchedules->ClassSchedule as $c) {


                /** Pull Out the actual Class of this */
                $class = $this->formatClassDescription($c);


                $sessions = $this->formatClassSessions($c);

                d($class);
                /**
                 * $class = [
                 *
                 *
                 *
                 * ];
                 * $classes[] = [
                 * 'external_id'      => $c->ClassDescription->ID,
                 * 'user_id'   => $this->user->id,
                 * 'name'             => $c->Name,
                 * 'title'            => $c->Name,
                 * 'description'      => $c->Description,
                 * 'image'            => $c->ImageURL,
                 * ];
                 *
                 * +Classes: null
                 * +Clients: null
                 * +Course: null
                 * +SemesterID: null
                 * +IsAvailable: null
                 * +Action: null
                 * +ID: 2255
                 * +ClassDescription: ClassDescription {#1051 ▼
                 * +ImageURL: null
                 * +Level: Level {#1052 ▶}
                 * +Action: null
                 * +ID: 69
                 * +Name: "Power Yoga"
                 * +Description: "As the name suggests, this class places a strong and fast demand on one’s awareness, agility and strength.  We will walk you into the inner depths of your practice and help you cultivate the strength, alertness and concentration needed to achieve improved vitality.  Not recommended for the faint hearted!"
                 * +Prereq: ""
                 * +Notes: ""
                 * +LastUpdated: "2011-03-03T06:17:11"
                 * +Program: Program {#1053 ▶}
                 * +SessionType: SessionType {#1054 ▶}
                 * }
                 * +DaySunday: false
                 * +DayMonday: true
                 * +DayTuesday: true
                 * +DayWednesday: true
                 * +DayThursday: false
                 * +DayFriday: true
                 * +DaySaturday: true
                 * +StartTime: "1899-12-30T16:30:00"
                 * +EndTime: "1899-12-30T17:45:00"
                 * +StartDate: "2015-01-21T00:00:00"
                 * +EndDate: "2016-01-21T00:00:00"
                 * +Staff: Staff {#1055 ▼
                 * +Appointments: null
                 * +Unavailabilities: null
                 * +Availabilities: null
                 * +Email: null
                 * +MobilePhone: null
                 * +HomePhone: null
                 * +WorkPhone: null
                 * +Address: null
                 * +Address2: null
                 * +City: null
                 * +State: "CA"
                 * +Country: null
                 * +PostalCode: null
                 * +ForeignZip: null
                 * +LoginLocations: null
                 * +Action: null
                 * +ID: 100000279
                 * +Name: "Ashley Knight"
                 * +FirstName: "Ashley"
                 * +LastName: "Knight"
                 * +ImageURL: "https://clients.mindbodyonline.com/studios/DemoAPISandboxRestore/staff/100000279_large.jpg?imageversion=1423538749"
                 * +Bio: null
                 * +isMale: false
                 * +"SortOrder": 0
                 * }
                 * +Location: Location {#1056 ▼
                 * +BusinessID: null
                 * +SiteID: -99
                 * +BusinessDescription: "YEGFit PASS is part of the YEG Fitness Family. Bringing you all things fitness and wellness in the Edmonton area."
                 * +AdditionalImageURLs: {#1057}
                 * +FacilitySquareFeet: null
                 * +TreatmentRooms: null
                 * +ProSpaFinderSite: null
                 * +HasClasses: false
                 * +PhoneExtension: ""
                 * +Action: null
                 * +ID: 1
                 * +Name: "Clubville"
                 * +Address: "4051 S Broad St"
                 * +Address2: "San Luis Obispo, CA 93401"
                 * +Tax1: 0.08
                 * +Tax2: 0.05
                 * +Tax3: 0.05
                 * +Tax4: 0.0
                 * +Tax5: 0.0
                 * +Phone: "8777554279"
                 * +City: "San Luis Obispo"
                 * +StateProvCode: "CA"
                 * +PostalCode: "93401"
                 * +Latitude: 35.2470788
                 * +Longitude: -120.6426145
                 * +DistanceInMiles: null
                 * +ImageURL: null
                 * +Description: null
                 * +HasSite: null
                 * +CanBook: null
                 * }
                 **/

            }

        }

    }

    public function getProducts()
    {

        $service = $this->getService('SaleService');
        $request = $service::requestBody('GetServices', $this->credentials, $this->user_credentials,
            ['LocationID' => 'null', 'HideRelatedPrograms' => 'null']);
        try {
            $apiClasses = $service->GetServices($request);
        } catch (SoapFault $e) {

            d($service, FALSE);
            d($service->__getLastRequest(), FALSE);
            echo $e->getMessage();
            die('done');
        }

        return $apiClasses;
    }

    public function getClasses()
    {

        $service = $this->getService('ClassService');
        $request = $service::request('GetClasses', $this->credentials);
        $apiClasses = $service->GetClasses($request);

        return $apiClasses;
    }
    public function getSessions()
    {

        $service = $this->getService('ClassService');
        $request = $service::request('GetClasses', $this->credentials);
        $apiClasses = $service->GetClasses($request);

        return $apiClasses;

        $sessions = [];

        if ($apiClasses->ErrorCode == 200) {

            if ($apiClasses->ResultCount == 0) {
                return FALSE;
            }

            foreach ($apiClasses->Classes->Class as $c) {

                $start = date('Y-m-d');

                $carbon = \Carbon\Carbon::parse($c->StartDateTime);
                $sessions[] = [
                    'external_id'       => $c->ID,
                    'external_site_id'  => $this->siteId,
                    'external_venue_id' => $c->Location->ID,
                    'external_class_id' => $c->ClassDescription->ID,
                    'date_time'         => $carbon->toDateTimeString(),
                    'duration'          => $carbon->diffInMinutes(\Carbon\Carbon::parse($c->EndDateTime)),
                    'price'             => $c->ClassDescription->Name,
                    'description'       => $c->ClassDescription->description,
                    'capacity'          => $c->MaxCapacity,
                    'image'             => $c->ClassDescription->ImageURL,
                ];

                ['evercisegroup_id', 'date_time', 'price', 'duration', 'members_emailed', 'tickets'];

                $classes[] = [

                    'user_id',
                    'category_id',
                    'venue_id',
                    'name',
                    'title',
                    'slug',
                    'description',
                    'image',
                    'gender',
                    'capacity',
                    'default_duration',
                    'default_price',
                    'published'
                ];
            }

        }


        return $classes;
    }


    /** STUPID STATIC LIBRARY!!! */
    public function getService($serviceType)
    {
        $service = MindbodyClient::service($serviceType);

        $this->credentials = $service::credentials(
            $this->api_key,
            $this->api_secret,
            [$this->siteId]
        );

        return $service;

    }

    private function formatClassSessions($class)
    {

        $sessions = [];

        $startDate = new \Carbon\Carbon($class->StartDate);
        $endDate = new \Carbon\Carbon($class->EndDate);

        foreach (range(0, $startDate->diffInDays($endDate)) as $days) {


            $session = [];

            $day = $startDate->addDays($days);

            $timeStart = strtotime(str_replace('1899-12-30T', '', $class->StartTime));
            $timeEnd = strtotime(str_replace('1899-12-30T', '', $class->EndTime));
            $duration = round(($timeEnd - $timeStart) / 60, 0);


            $days = [
                0 => 'Sunday',
                1 => 'Monday',
                2 => 'Tuesday',
                3 => 'Wednesday',
                4 => 'Thursday',
                5 => 'Friday',
                6 => 'Saturday'
            ];


            $dayVar = 'Day' . $days[$day->dayOfWeek];

            if ($class->{$dayVar}) {


                $session = [
                    'external_class_id' => $class->ClassDescription->ID,
                    'external_id'       => $class->ID,
                    'duration'          => (int)$duration,
                    'date_time'         => $day->hour(date('H', $timeStart))->minute(date('i',
                        $timeStart))->second(date('s', $timeStart)),
                ];
            }


        }


    }


}