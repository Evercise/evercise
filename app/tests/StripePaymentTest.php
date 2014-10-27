<?php namespace app\tests;

use Mockery as m;

use StripePaymentController, Cart;

class StripePaymentTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        parent::setUp();


    }

    /** @test */
    public function process_payment()
    {
        $productCode = 'S136';
        $groupName = 'INSANITY';
        $quantity = 1;
        $price = 10;
        $evercisegroupId = 136;
        $sessionId = 1231;
        $date_time = '2014-11-17 21:30:00';

        Cart::associate('Evercisesession')->add( $productCode, $groupName, $quantity, $price,
            [
                'evercisegroupId' => $evercisegroupId,
                'sessionId' => $sessionId,
                'date_time' => $date_time
            ]
        );

        $response = $this->action('POST', 'StripePaymentController@store');



    }



}