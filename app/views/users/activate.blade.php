@extends('layouts.master')


@section('content')



	<div>user: {{ $display_name }}</div>
	@if(!isset($activation))
		<div>Thanks for signing up. go check your email</div>
	@else

		@if($activation == 0)
			<div>Your account could not be activated, if you copy and pasted the URL, please check you didn't miss any characters</div>
		@elseif($activation == 1)
			<div>Thankyou for signing up. Please check your email</div>
		@elseif($activation == 2)
			<div>Congratulations, your account has been successfuly activated</div>
		@elseif($activation == 3)
			<div>Congratulations, you have successfully signed up with facebook. Your password has been emailed to you</div>
		@endif

		@if($activation >= 2)
		<br>
			now:
			<div>Check out some classes</div>
			<div>Become a Trainer</div>
		@endif
	@endif

@stop