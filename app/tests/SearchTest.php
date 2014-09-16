<?php namespace app\tests;

use Mockery as m;

use Link;

class SearchTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        parent::setUp();

        $this->search_pages = [
            'london',
            'london/area/kings-cross',
            'london/station/kings-cross',
            'london?page=2'
        ];

    }

    /** @test */
    public function checklink_is_finding_the_places_and_returning_LINK_Class()
    {
        foreach ($this->search_pages as $page) {

            /** Remove all optional values */
            $link = explode('?', $page);


            $LinkClass = Link::checkLink($link[0]);

            $this->assertTrue(is_a($LinkClass, 'Link'));
        }
    }


}