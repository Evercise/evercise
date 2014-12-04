@extends('v3.emails.template')


    $params = [
            'subject'        => 'Evercise refund request',
            'view'           => 'v3.emails.user.request_refund',
            'email'          => $email,
            'userName'       => $userName,
            'userEmail'      => $userEmail,
            'group'          => $group,
            'messageSubject' => $messageSubject,
            'messageBody'    => $messageBody
        ];

        $this->send($email, $params);


@section('body')


     $emailBody = '
    			<p>Hi ' . $userName . ',</p>
    			<br>
    			<p>We are sorry to hear that your recently attended class was not what you expected. We have received your request for a refund and our Customer Relations Manager is investigating your claim. We will do our best to get back to you within 5 working days..</p>
    			<br>
    			<p>Please note the following:</p>
    			<ul>
    				<li>Refund requests must be sent no more than 5 working days after you have taken part in the class concerned.</li>
    				<li>You may only be refunded up to the amount of your original transaction.</li>
    				<li>The refund will only be sent to the account associated with the original transaction.</li>
    				<li>You must wait at least 24 hours after the original payment has been received before you can request a refund.</li>
    				<li>Please allow 24-72 hours for refunds to be fully processed (the length of time is dependent on the payment gateway services and financial institutions involved in the transaction).</li>
    			</ul>
    			<br>
    			<p>Feel free to call or email us with any questions. We’re always happy to help.</p>
    			<br>
    			<br>
    			<p>Message:</p>
    			<br>
    			<p>' . $messageSubject . '</p>
    			<br>
    			<p>' . $messageBody . '</p>
    		';


            $subject = 'Evercise refund request';
            $view = 'emails.template';
            $data['title'] = $subject;
            $data['mainHeader'] = 'You have a new message in your Evercise inbox.';
            $data['subHeader'] = 'Let`s try and resolve this';
            $data['body'] = $emailBody;
            $data['link'] = 'http://evercise.com';
            $data['linkLabel'] = 'evercise.com';

            $data['name'] = $userName;
            $this->sendTo($email, $subject, $view, $data);
            $this->sendTo($userEmail, $subject, $view, $data);

@stop