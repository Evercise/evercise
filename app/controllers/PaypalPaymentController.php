<?php

use Omnipay\Omnipay;

class PaypalPaymentController extends BaseController {

    

    /*
     * Create payment using credit card
     * url:payment/create
    */
    public function create()
    {
         $gateway = Omnipay::create('PayPal_Express');
         $gateway->setUsername('fee_api1.evercise.com');
         $gateway->setPassword('1382538555');
         $gateway->setSignature('Aodo9BslGbWevZQXif8dMUdeGkPiAViLGU1nZKk2LGHUbAj0M5jbw84L');
         $gateway->setTestMode(true);

         $response = $gateway->purchase(
                    array(
                        'cancelUrl' => 'http://localhost:1234/cancelurl',
                        'returnUrl' => 'http://localhost:1234/payment/5', 
                        'amount' => 0.01,
                        'currency' => 'GBP'
                    )
            )->send();

        $response->redirect();


         /* $response = $gateway->completePurchase(
                            array(
                                'cancelUrl' => 'www.evercise.com/cancelurl',
                                'returnUrl' => 'www.evercise.com/returnurl', 
                                'amount' => 12.99,
                                'currency' => 'GBP',
                                'Description' => 'Test Purchase for 12.99'
                            )
                    )->send();


            $data = $response->getData(); // this is the raw response object
            echo '<pre>';
            print_r($data);

            */

           // return var_dump($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername('fee_api1.evercise.com');
        $gateway->setPassword('1382538555');
        $gateway->setSignature('Aodo9BslGbWevZQXif8dMUdeGkPiAViLGU1nZKk2LGHUbAj0M5jbw84L');
        $gateway->setTestMode(true);

        $response = $gateway->completePurchase(
                        array(
                            'amount' => 0.01,
                            'currency' => 'GBP',
                            'Description' => 'Test Purchase for a penny'
                        )
                )->send();


            $data = $response->getData(); // this is the raw response object
            echo '<pre>';
            var_dump($data);
    }

}