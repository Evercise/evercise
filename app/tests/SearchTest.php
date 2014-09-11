<?php namespace app\tests;

use Mockery as m;

use Event;
use Trainer;
use Milestone;
use User;

use Geo;

class SearchTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }


    public function __construct() {
        m::mock('Request')->shouldDeferMissing();
    }
    public function setUp()
    {
        parent::setUp();

        $this->search_pages = [
            '/uk',
            '/uk/london',
            '/uk/london/areas/kings-cross',
            '/uk/london/stations/kings-cross',
            '/uk/london?page=2',
            '/uk/kings-cross'
        ];

        $this->class_page = '/uk/class/some_class_from_database';

    }


    /** @test */
    public function it_returns_london_if_the_ip_is_missing() {

        $response = Geo::getLatLng('127.0.0.1');

        $expecting = [
            'lat'   => 51.5307,
            'lng'   => -0.12308
        ];

        $this->assertEquals($expecting, $response);

    }


    /**
     * @test
     * @throws Exception
     */
    public function it_returns_exception() {

        $response = Geo::getLatLng('gani*AUEI)igu38ghw0rgjo');

    }



}