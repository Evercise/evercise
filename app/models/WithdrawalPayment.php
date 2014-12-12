<?php
use Illuminate\Log\Writer;
use Illuminate\Config\Repository;

/**
 * @property mixed paypal_config
 */
class WithdrawalPayment {

    protected $paypal_config;
    protected $paypal;

    protected $subject = 'Trainer Payment';
    protected $currenctyCode = 'GBP';
    protected $receivertype = 'GBP';

    public function __construct(Writer $log,Repository $config) {


        $this->paypal_config = [
            'Sandbox' => getenv('PAYPAL_TESTMODE') ?: true,
            'APIUsername' => getenv('PAYPAL_USER') ?: false,
            'APIPassword' => getenv('PAYPAL_PASS') ?: false,
            'APISignature' => getenv('PAYPAL_SIGNATURE') ?: false,
            'PrintHeaders' => false,
            'LogResults' => true,
            'LogPath' => storage_path().'/logs/PayPal.log',
        ];

        $this->paypal = new angelleye\PayPal\PayPal($this->paypal_config);
    }



    /**
     * @param string $currenctyCode
     */
    public function setCurrenctyCode($currenctyCode)
    {
        $this->currenctyCode = $currenctyCode;
    }

    /**
     * @param string $receivertype
     */
    public function setReceivertype($receivertype)
    {
        $this->receivertype = $receivertype;
    }

    /**
     * @param string $emailSubject
     */
    public function setSubject($emailSubject)
    {
        $this->emailSubject = $emailSubject;
    }

'l_email' => 'andrew_1342623385_per@angelleye.com', 							// Required.  Email address of recipient.  You must specify either L_EMAIL or L_RECEIVERID but you must not mix the two.
'l_amt' => '10.00', 								// Required.  Payment amount.
'l_uniqueid' => '', 						// Transaction-specific ID number for tracking in an accounting system.
'l_note' => ''

    public function addUser($params = []) {
        $recipient = [
            'l_email' =>

        ]
    }



    public function pay() {


    }

}


// Prepare request arrays
$MPFields = array(
    'emailsubject' => 'Test MassPay', 						// The subject line of the email that PayPal sends when the transaction is completed.  Same for all recipients.  255 char max.
    'currencycode' => 'USD', 						// Three-letter currency code.
    'receivertype' => 'EmailAddress' 						// Indicates how you identify the recipients of payments in this call to MassPay.  Must be EmailAddress or UserID
);

// Typically, you'll loop through some sort of records to build your MPItems array.
// Here I simply include 3 items individually.

$Item1 = array(
    'l_email' => 'andrew_1342623385_per@angelleye.com', 							// Required.  Email address of recipient.  You must specify either L_EMAIL or L_RECEIVERID but you must not mix the two.
    'l_receiverid' => '', 						// Required.  ReceiverID of recipient.  Must specify this or email address, but not both.
    'l_amt' => '10.00', 								// Required.  Payment amount.
    'l_uniqueid' => '', 						// Transaction-specific ID number for tracking in an accounting system.
    'l_note' => '' 								// Custom note for each recipient.
);

$Item2 = array(
    'l_email' => 'usb_1329725429_biz@angelleye.com', 							// Required.  Email address of recipient.  You must specify either L_EMAIL or L_RECEIVERID but you must not mix the two.
    'l_receiverid' => '', 						// Required.  ReceiverID of recipient.  Must specify this or email address, but not both.
    'l_amt' => '10.00', 								// Required.  Payment amount.
    'l_uniqueid' => '', 						// Transaction-specific ID number for tracking in an accounting system.
    'l_note' => '' 								// Custom note for each recipient.
);

$Item3 = array(
    'l_email' => 'andrew_1277258815_per@angelleye.com', 							// Required.  Email address of recipient.  You must specify either L_EMAIL or L_RECEIVERID but you must not mix the two.
    'l_receiverid' => '', 						// Required.  ReceiverID of recipient.  Must specify this or email address, but not both.
    'l_amt' => '10.00', 								// Required.  Payment amount.
    'l_uniqueid' => '', 						// Transaction-specific ID number for tracking in an accounting system.
    'l_note' => '' 								// Custom note for each recipient.
);

$MPItems = array($Item1, $Item2, $Item3);  // etc

$PayPalRequestData = array('MPFields'=>$MPFields, 'MPItems' => $MPItems);

// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->MassPay($PayPalRequestData);

// Write the contents of the response array to the screen for demo purposes.
echo '<pre />';
print_r($PayPalResult);
?>