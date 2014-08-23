<?php

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