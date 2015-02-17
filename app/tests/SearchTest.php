<?php namespace app\tests;

use Mockery as m;

use Link, Place, Artisan;

class SearchTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        parent::setUp();

        $place = Place::where('place_type', 1)->get();
        foreach($place as $p) {
            $p->link()->delete();
            $p->delete();
        }

       // Artisan::call('migrate');
        //Artisan::call('indexer:geo');

        $this->search_pages_old = [
            'london',
            'london/area/kings-cross',
            'london/station/kings-cross',
            'london?page=2'
        ];


        $this->search_pages_new = [
            ['location' => 'Queen street, London, United Kingdom', 'radius' => '2mi',
                'expected' => 'uk/london/area/queen-street?radius=2mi'],
            ['location' => 'Embankment, City of Westminster, United Kingdom', 'radius' => '2mi',
                'expected' => 'uk/london/area/embankment-city-of-westminster?radius=2mi'],
            ['location' => 'London Eye, Westminster Bridge Road, London, United Kingdom', 'radius' => '2mi',
                'expected' => 'uk/london/area/eye-westminster-bridge-road?radius=2mi'],
            ['location' => 'Asda Leyton', 'radius' => '2mi',
                'expected' => 'uk/london/area/asda-leyton?radius=2mi'],
            ['location' => 'Westfield London, London, United Kingdom', 'radius' => '2mi',
                'expected' => 'uk/london/area/westfield?radius=2mi']
        ];


    }

    /** @test */
    public function checklink_is_finding_the_places_and_returning_LINK_Class()
    {

        foreach ($this->search_pages_old as $page) {

            /** Remove all optional values */
            $link = explode('?', $page);

            $LinkClass = Link::checkLink($link[0]);

            $this->assertTrue(is_a($LinkClass, 'Link'));


        }
    }

    /** @test */
    public function checklink_is_parsing_the_location_and_creating_a_new_place()
    {
        foreach ($this->search_pages_new as $params) {

            $expected = $params['expected'];

            unset($params['expected']);
            $response = $this->call('GET', 'uk', $params);

            /** The system should redirect to the expected location */
            $this->assertRedirectedTo($expected);

            /** We should have the expect URL in the database */
            $permalink = explode('?', str_replace('uk/','',$expected));
            $this->assertEquals(1, Link::where('permalink', $permalink[0])->get()->count());

        }
    }


}