@extends('v3.emails.template')



@section('body')
<p>Hi</p>

<p>First of all thanks for agreeing to participate in  this user test. Your feedback is invaluable to us designing the very best experience for the Evercise customers. At the end of the session you will have purchased a class using a free voucher code or your own ccard where we will reimburse you. You will also have answered some questions about your experience. This will take no longer that 20 minutes. We would love you to attend the class but it is completely up to you!</p>

<p>Your voucher code for 20£ is <strong>{{ $email }}</strong></p>

<p>The user test is in 2 parts.</p>

<p>In part 1, we would like to chose a class and a venue near where you live or work and purchase the class. If you live and work outside London can you assume your home address is 10 Bewdly Street, Islington, London , N1 1HB and your work address is 1-4 Morwell St. London WC1B. Otherwise use your real addresses.</p>

<p>In part 2 we would be grateful if you can answer some questions based on your experience using Survey Monkey.</p>

<p><strong>Part 1</strong></p>

<p>1. From the home page find a class you would like to attend at a time that suits you and  purchase your class.</p>

<p>2. Click on the this link to start you purchase….</p>

<p><a href="https://evercise.com/?t=start">https://evercise.com/?t=start</a></p>


<p><strong>Part 2</strong></p>

<p>Once finished please click the link below to answer some questions about the experience.</p>

<p><a href="http://www.surveymonkey.com/s/Evercise_user_survey">http://www.surveymonkey.com/s/Evercise_user_survey</a>

<p>Thank you for your feedback and enjoy your free class.</p>

<p>Regards</p>

<p>Evercise Team</p>

@stop