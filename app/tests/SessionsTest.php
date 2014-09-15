<?php namespace app\tests;

use app\tests\TestCase;
use SessionsController;
use Mockery;

class SessionsTest extends TestCase
{

    public function test_create_evercisesession_form()
    {

        $response = $this->action('GET', 'SessionsController@create', ['year' => 1, 'month'=>1, 'evercisegroupId'=>224]);

        $this->assertInstanceOf('Illuminate\Http\Response', $response, 'NOT A RESPONSE:'.get_class($response));

        $this->assertViewHas('year');
        $this->assertViewHas('month');
        $this->assertViewHas('displayMonth');
        $this->assertViewHas('date');
        $this->assertViewHas('id');
        $this->assertViewHas('duration');
        $this->assertViewHas('price');
        $this->assertViewHas('name');
        $this->assertViewHas('hour');
        $this->assertViewHas('minute');

    }

}