<?php namespace app\tests;

class SearchTest extends TestCase
{

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
    public function url_will_return_a_search()
    {
        foreach ($this->search_pages as $page) {
            $parsed = \Evercisegroup::parseSegments($page);

            $this->assertTrue($parsed['type'] == 'search');

        }
    }

    /** @test */
    public function url_will_return_a_class()
    {
        $parsed = \Evercisegroup::parseSegments($this->class_page);

        $this->assertTrue($parsed['type'] == 'class');
    }

}