<?php


class Mindbody
{


    private $siteId;
    private $api_key;
    private $api_secret;
    private static $service = NULL;


    public function __construct($siteId)
    {
        $this->siteId = $siteId;
        $this->api_key = Config::get('evercise.mindbody.api_key');
        $this->api_secret = Config::get('evercise.mindbody.api_secret');

    }


    /************ VENUES  ***************/

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
                    'external_id'      => $l->ID,
                    'external_site_id' => $l->SiteID,
                    'name'             => $l->Name,
                    'address'          => $l->Address,
                    'town'             => $l->City,
                    'postcode'         => $l->PostalCode,
                    'lat'              => $l->Latitude,
                    'lng'              => $l->Longitude,
                    'image'            => $l->ImageURL
                ];
            }

        }

        return $locations;

    }


    /************ CLASSES  ***************/


    public function getClasses()
    {
        $service = $this->getService('ClassService');
        $request = $service::request('GetClassDescriptions', $this->credentials);
        $apiClasses = $service->GetClassDescriptions($request);


        d($apiClasses);

        $locations = [];

        if ($apiClasses->ErrorCode == 200) {

            if ($apiClasses->ResultCount == 0) {
                return FALSE;
            }

            foreach ($apiClasses->ClassDescriptions->ClassDescription as $c) {

                $classes[] = [
                    'external_id'      => $c->ID,
                    'external_site_id' => $this->siteId,
                    'name'             => $c->Name,
                    'title'            => $c->Name,
                    'description'      => $c->Description,
                    'image'            => $c->ImageURL,
                ];
            }

        }

        return $classes;

    }

    public function getClassSchedules()
    {

        $service = $this->getService('ClassService');
        $request = $service::request('GetClassSchedules', $this->credentials);
        $apiClasses = $service->GetClassSchedules($request);

        d($apiClasses);

    }

    public function getProducts()
    {

        $service = $this->getService('SaleService');
        $request = $service::request('GetProducts', $this->credentials);
        try {
            $apiClasses = $service->GetProducts($request);
        } catch(SoapFault $e) {

            d($service, false);
           d($service->__getLastRequest(), false);
            echo $e->getMessage();

            die('aaa');
        }

        d($apiClasses);
    }

    public function getSessions()
    {

        $service = $this->getService('ClassService');
        $request = $service::request('GetClasses', $this->credentials);
        $apiClasses = $service->GetClasses($request);

        d($apiClasses);
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
        $service = \MindbodyAPI\MindbodyClient::service($serviceType);

        $this->credentials = $service::credentials(
            $this->api_key,
            $this->api_secret,
            [$this->siteId]
        );

        return $service;

    }


}