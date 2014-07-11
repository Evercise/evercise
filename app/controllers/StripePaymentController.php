<?php

use Omnipay\Omnipay;

class StripePaymentController extends BaseController {

    

    /*
     * Create payment using credit card
     * url:payment/create
    */
    public function create()
    {
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        

    }

    public function pay()
    {
        return View::make('payments.stripepay');
    }

    public function paid()
    {

    }

}