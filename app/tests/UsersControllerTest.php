<?php namespace app\tests;

use app\tests\TestCase;

class UsersControllerTest extends TestCase {

	/**
	 * Testing for UsersController
	 *
	 * @return void
	 */
	public function testIndex()
    {
        $this->client->request('GET', 'referralCode');
    }

}