<?php
use Illuminate\Log\Writer;
use Illuminate\Config\Repository;

/**
 * @property mixed paypal_config
 */
class WithdrawalPayment
{

    private $paypal_config;
    private $paypal;

    private $subject = 'Trainer Payment';
    private $currency = 'GBP';
    private $receivertype = 'EmailAddress';
    private $recipients = [];
    private $fields;

    public function __construct(Writer $log, Repository $config)
    {


        $this->paypal_config = [
            'Sandbox'      => getenv('PAYPAL_TESTMODE') ?: TRUE,
            'APIUsername'  => getenv('PAYPAL_USER') ?: FALSE,
            'APIPassword'  => getenv('PAYPAL_PASS') ?: FALSE,
            'APISignature' => getenv('PAYPAL_SIGNATURE') ?: FALSE,
            'PrintHeaders' => FALSE,
            'LogResults'   => TRUE,
            'LogPath'      => storage_path() . '/logs/PayPal.log',
        ];

        $this->paypal = new angelleye\PayPal\PayPal($this->paypal_config);
    }


    /**
     * @param string $currenctyCode
     */
    public function setCurrency($currenctyCode)
    {
        $this->currency = $currenctyCode;

        return $this;
    }

    /**
     * @param string $emailSubject
     */
    public function setSubject($emailSubject)
    {
        $this->subject = $emailSubject;

        return $this;
    }

    public function addUser($params = [])
    {
        $this->recipients[] = [
            'l_email'    => $params['email'],
            'l_amt'      => number_format($params['amount'], 2),
            'l_uniqueid' => $params['id'],
            'l_note'     => ''
        ];

        return $this;
    }


    public function pay()
    {

        if (count($this->recipients) == 0) {
            throw new \Exception('Please Add Recipients');
        }

        $this->setFields();


        $PayPalRequestData = ['MPFields' => $this->fields, 'MPItems' => $this->recipients];

        // Pass data into class for processing with PayPal and load the response array into $PayPalResult
        $PayPalResult = $this->paypal->MassPay($PayPalRequestData);


        Log::info($PayPalResult);

        d($PayPalResult);
    }

    private function setFields()
    {
        $this->fields = [
            'emailsubject' => $this->subject,
            'currencycode' => $this->currency,
            'receivertype' => $this->receivertype
        ];
    }

}
