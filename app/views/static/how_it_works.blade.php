@extends('layouts.master')


@section('content')
    <div id="how_it_works" class="full-width">
	    <div class="col12" id="how-it-works">
	    	<h1>How it Works</h1>
	    	<hr>
		    <video id="video" class="video" controls poster="{{ asset('img/evercise logo BW.jpg') }}">
				<source src="{{ url() }}/video/evercise.mov"  type="video/mp4" />
				<source src="{{ url() }}/video/evercise.mp4"  type="video/mp4" />
			</video>
			<hr>
			<div class="accordion how-tabs">
				<div class="accordion-header icon-btn selected" data-view="user">
					<span>I am a particpant</span>
				</div>
				<div class="accordion-header icon-btn" data-view="trainer">
					<span>I am a trainer</span>
				</div>
				<div id="user" class="accordion-body tab-view selected">
					<div class="btn-wrap">
						@if(!isset($user))
						{{HTML::link('users/create', 'Register', array('class' => 'btn btn-yellow'))}}
						@endif
					</div>
					<div id="step_1" class="four-step one_t">
						{{ HTML::image('img/search.png','search for classes', array('class' => 'home-step-img')) }}
						<h6>Search fitness classes</h6>
						<ul>
							<li>Get fit with maximum flexibility</li>
							<li>Access a huge range of fitness classes</li>
							<li>Find a class wherever you are</li>
							<li>Join for FREE</li>
						</ul>
					</div>
					<div id="step_2" class="four-step">
						{{ HTML::image('img/Sign-Up-Online.png','join up', array('class' => 'home-step-img')) }}
						<h6>Sign up to a class online</h6>
						<ul>
							<li>See reviews of a class before you join</li>
							<li>Review and join multiple timeslots</li>
							<li>View details about the venue and facilities</li>
							<li>Ask the trainer any questions you may have</li>
						</ul>
					</div>
					<div id="step_3" class="four-step">
						{{ HTML::image('img/Class.png','get fit', array('class' => 'home-step-img')) }}
						<h6>Show up and shape up!</h6>
						<ul>
							<li>Train with like minded people</li>
							<li>Achieve your goals</li>
							<li>Receive a reminder well in advance</li>
							<li>Make new friends</li>
						</ul>
					</div>
					<div id="step_4" class="four-step">
						{{ HTML::image('img/Rate-Review.png','rate trainer', array('class' => 'home-step-img')) }}
						<h6>Rate and review</h6>
						<ul>
							<li>Make an impact with your review</li>
							<li>Tell users how you felt during the class</li>
							<li>Help like minded people with their fitness needs</li>
						</ul>
					</div>
					<div class="tab-wrapper">
						<div class="tab-header" data-tab="search">
							<h4>Step 1- Search Classes</h4>
						</div>
						<div class="tab-body" id="search">
							<div class="tab-screen">
								{{ HTML::image('img/register.png','register as trainer', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>Search Classes</h4>
								<p>Evercise is the perfect solution for those wanting to get fit with maximum flexibility. Access a huge range of fitness classes, trainers and locations on one website.</p>
								<br>
								<p>Whether your aim is to lose weight, bulk up or gain a skill, with  Evercise you can find, compare and join classes, review trainers and join like minded people in your area to help you achieve your goals.</p>
							</div>							
						</div>
						<div class="tab-header" data-tab="class">
							<h4>Step 2- Join a class</h4>
						</div>
						<div class="tab-body" id="class">
							<div class="tab-screen">
								{{ HTML::image('img/Class.png','create classes', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>Search Classes</h4>
								<p>Not only does exercising in a group significantly reduce the cost per participant, many studies have proven that it also inspires willpower and discipline and therefore greater results!</p>
							</div>							
						</div>
						<div class="tab-header" data-tab="show">
							<h4>Step 3- show Up and Shape Up</h4>
						</div>
						<div class="tab-body" id="show">
							<div class="tab-screen">
								{{ HTML::image('img/create_class.png','add sessions', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>Search Classes</h4>
								<p>Once you have purchased a class you can easily contact  the trainer if you have any questions, Will will send you a reminder about the class the day before so all you have to do is show up and shape up.</p>
								<br>
								<p>If something comes up and you can&apos;t attend the class you can cancel, if you cancel more than 5 days in advance we will credit you evercoin account with the full amount of the class to spend on another class at a time that bests suits you. If you need to do a last minute cancellation we will credit you 50% of the cost up to 2 days before the class, unfortunately on closer to that we can not offer any credit</p>
							</div>							
						</div>
						<div class="tab-header" data-tab="rate">
							<h4>Step 4- Rate and Review</h4>
						</div>
						<div class="tab-body" id="rate">
							<div class="tab-screen">
								{{ HTML::image('img/withdraw.png','manage account', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>Search Classes</h4>
								<p>Your evaluation has an impact on future classes. Tell users what happened during the class and how you felt with the group. You are more than welcome to join our community, let&apos;s inspire each other.</p>
							</div>							
						</div>
					</div>
				</div>
				<div id="trainer" class="accordion-body tab-view">
					<div class="btn-wrap">
						@if(!isset($user) || !$user->inGroup($trainerGroup))
							{{HTML::link('trainers/create', 'Register  as trainer', array('class' => 'btn btn-yellow'))}}

						@endif
					</div>
					<div id="step_1" class="four-step one_t">
						{{ HTML::image('img/register.png','register as trainer', array('class' => 'home-step-img')) }}
						<h6>Register</h6>
						<ul>
							<li>No expensive monthly fees</li>
							<li>Membership is FREE</li>
							<li>Great exposure</li>
						</ul>
					</div>
					<div id="step_2" class="four-step">
						{{ HTML::image('img/Class.png','create a class', array('class' => 'home-step-img')) }}
						<h6>Create a Class</h6>
						<ul>
							<li>Easily create a class</li>
							<li>reuse an edit venue details</li>
							<li>View data on participants</li>
							<li>Classes are promoted</li>
						</ul>
					</div>
					<div id="step_3" class="four-step">
						{{ HTML::image('img/create_class.png','add sessions', array('class' => 'home-step-img')) }}
						<h6>Add Sessions</h6>
						<ul>
							<li>Add sessions to a class with a click of a button</li>
							<li>Directly message any participants</li>
							<li>Get sent your participant list before each session</li>
						</ul>
					</div>
					<div id="step_4" class="four-step">
						{{ HTML::image('img/withdraw.png','manage trainer', array('class' => 'home-step-img')) }}
						<h6>Manage Account</h6>
						<ul>
							<li>Withdraw money from you evercise wallet to your paypal account</li>
							<li>View statistics on all classes</li>
							<li>View your activity</li>
							<li>Monitor your success</li>
						</ul>
					</div>
					<div class="tab-wrapper">
						<div class="tab-header" data-tab="register">
							<h4>Step 1- Register</h4>
						</div>
						<div class="tab-body" id="register">
							<div class="tab-screen">
								{{ HTML::image('img/Rate-Review.png','rate trainer', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>It&apos;s easy and FREE!</h4>
								<p>We consider varying levels of expertise, class types and locations.Having a professional account and promoting classes is FREE.</p>
								<br>
								<p>
									<li> Click “register as trainer” on the nav bar, and follow the simple instructions.</li>
									<li> We aim to process your application in one working day!</li>
									<li>You can start creating classes straight away. These will become visible to the public as soon as we have processed your application.</li>
								</p>
							</div>							
						</div>
						<div class="tab-header" data-tab="create">
							<h4>Step 2- Create a Class</h4>
						</div>
						<div class="tab-body" id="create">
							<div class="tab-screen">
								{{ HTML::image('img/Rate-Review.png','rate trainer', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>They will be promoted by evercise on multiple platforms</h4>
								<p>Easily create classes which will be linked to your profile and can be searched for and purchased online. Simply click “class hub” on the nav bar, then “create a new class”.</p>
								<br>
								<p>
									<li>Add your class name, photo and description. Specify its duration, size, price and whether it is gender specific. Choose a category so your class is easily searchable.</li>
									<li>Add venues and fill out details such as the facilities available. The venues you create will appear in a drop-down menu, so you only need to do this once per venue, not every time you create a class.</li>
									<li>If you run two similar classes with a small difference, you can “clone” a class you have already created, and simply change the relevant details.</li>
									<li> View participant lists and easily contact those who have joined. Evercise will send out handy reminders before each session.</li>
								</p>
							</div>							
						</div>
						<div class="tab-header" data-tab="session">
							<h4>Step 3- Add Sessions</h4>
						</div>
						<div class="tab-body" id="session">
							<div class="tab-screen">
								{{ HTML::image('img/Rate-Review.png','rate trainer', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>No need to start from scratch each time.</h4>
								<p>Once a class is created you can add multiple dates by simply clicking on the calendar.</p>
								<br>
								<p>
									<li>For each date added you can edit the time, price and duration.</li>
									<li>You can delete sessions until your first participant joins.</li>
								</p>
							</div>							
						</div>
						<div class="tab-header" data-tab="manage">
							<h4>Step 4- Manage Account</h4>
						</div>
						<div class="tab-body" id="manage">
							<div class="tab-screen">
								{{ HTML::image('img/Rate-Review.png','rate trainer', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>Managaging your accounts couldn&apos;t be easier</h4>
								<p>Evercise has a variety of user-friendly features to help you manage your earnings and keep track of your activity.</p>
								<br>
								<p>
									<li>Getting paid through Evercise couldn’t be easier. Once a class is complete you can withdraw your money directly. You don&apos;t have to pay a penny until you start earning, and when you do, we only take a small commission of 10%!</li>
									<li>Evercise automatically creates a log of your activity. View your class statistics, e.g. total bookings and revenue, so you can monitor the progress and success of your class.</li>
									<li>Your Evercise Wallet will show a statement with all your incoming and outgoing funds. You can also view your earnings per month</li>
								</p>
							</div>							
						</div>
					</div>
				</div>

			</div>	    
	    </div>
	</div>
    

@stop