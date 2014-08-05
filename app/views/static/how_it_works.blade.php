@extends('layouts.master')


@section('content')
    <div id="how_it_works" class="full-width">
	    <div class="col12" id="how-it-works">
	    	<h1>{{trans('how_it_works.title')}}</h1>
	    	<hr>
		    <iframe class="youtube-player" width="615" height="346" src="//www.youtube.com/embed/dtCbSpQ8NY8?autoplay=0&autohide=2" frameborder="0" allowfullscreen></iframe>
			<hr>
			<div class="accordion how-tabs">
				<div class="accordion-header icon-btn selected" data-view="user">
					<span>{{trans('how_it_works.choose_user')}}</span>
				</div>
				<div class="accordion-header icon-btn" data-view="trainer">
					<span>{{trans('how_it_works.chooser_trainer')}}</span>
				</div>
				<div id="user" class="accordion-body tab-view selected">
					<div class="btn-wrap">
						@if(!isset($user))
						{{HTML::link('users/create', 'Register', array('class' => 'btn btn-yellow btn-large'))}}
						@endif
					</div>
					<div id="step_1" class="four-step one_t">
						{{ HTML::image('img/search.png','search for classes', array('class' => 'home-step-img')) }}
						<h6>Search fitness classes</h6>
						<ul>
							<li>{{trans('how_it_works.step_1_1')}}</li>
							<li>{{trans('how_it_works.step_1_2')}}</li>
							<li>{{trans('how_it_works.step_1_3')}}</li>
							<li>{{trans('how_it_works.step_1_4')}}</li>
						</ul>
					</div>
					<div id="step_2" class="four-step">
						{{ HTML::image('img/Sign-Up-Online.png','join up', array('class' => 'home-step-img')) }}
						<h6>Sign up to a class online</h6>
						<ul>
							<li>{{trans('how_it_works.step_2_1')}}</li>
							<li>{{trans('how_it_works.step_2_2')}}</li>
							<li>{{trans('how_it_works.step_2_3')}}</li>
							<li>{{trans('how_it_works.step_2_4')}}</li>
						</ul>
					</div>
					<div id="step_3" class="four-step">
						{{ HTML::image('img/Class.png','get fit', array('class' => 'home-step-img')) }}
						<h6>Show up and shape up!</h6>
						<ul>
							<li>{{trans('how_it_works.step_3_1')}}</li>
							<li>{{trans('how_it_works.step_3_2')}}</li>
							<li>{{trans('how_it_works.step_3_3')}}</li>
							<li>{{trans('how_it_works.step_3_4')}}</li>
						</ul>
					</div>
					<div id="step_4" class="four-step">
						{{ HTML::image('img/Rate-Review.png','rate trainer', array('class' => 'home-step-img')) }}
						<h6>Rate and review</h6>
						<ul>
							<li>{{trans('how_it_works.step_4_1')}}</li>
							<li>{{trans('how_it_works.step_4_2')}}</li>
							<li>{{trans('how_it_works.step_4_3')}}</li>
						</ul>
					</div>
					<div class="tab-wrapper">
						<div class="tab-header" data-tab="search">
							<h4>{{trans('how_it_works.step_1_tab')}}</h4>
						</div>
						<div class="tab-body" id="search">
							<div class="tab-screen">
								{{ HTML::image('img/User - Step1.png','register as trainer', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>{{trans('how_it_works.step_1_title')}}</h4>
									{{trans('how_it_works.step_1_body')}}
							</div>							
						</div>
						<div class="tab-header" data-tab="class">
							<h4>{{trans('how_it_works.step_2_tab')}}</h4>
						</div>
						<div class="tab-body" id="class">
							<div class="tab-screen">
								{{ HTML::image('img/User - Step 2 .png','create classes', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>{{trans('how_it_works.step_2_title')}}</h4>
									{{trans('how_it_works.step_2_body')}}
							</div>
						</div>
						<div class="tab-header" data-tab="show">
							<h4>{{trans('how_it_works.step_3_tab')}}</h4>
						</div>
						<div class="tab-body" id="show">
							<div class="tab-screen">
								{{ HTML::image('img/User - Step3.jpg','add sessions', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>{{trans('how_it_works.step_3_title')}}</h4>
									{{trans('how_it_works.step_3_body')}}
							</div>							
						</div>
						<div class="tab-header" data-tab="rate">
							<h4>{{trans('how_it_works.step_4_tab')}}</h4>
						</div>
						<div class="tab-body" id="rate">
							<div class="tab-screen">
								{{ HTML::image('img/ratings.jpg','manage account', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>{{trans('how_it_works.step_4_title')}}</h4>
									{{trans('how_it_works.step_4_body')}}
							</div>							
						</div>
					</div>
				</div>
				<div id="trainer" class="accordion-body tab-view">
					<div class="btn-wrap">
						@if(!isset($user) || !$user->inGroup($trainerGroup))
							{{HTML::link('trainers/create', 'Register  as trainer', array('class' => 'btn btn-yellow btn-large'))}}

						@endif
					</div>
					<div id="step_1" class="four-step one_t">
						{{ HTML::image('img/register.png','register as trainer', array('class' => 'home-step-img')) }}
						<h6>Register</h6>
						<ul>
							<li>{{trans('how_it_works.tr_step_1_1')}}</li>
							<li>{{trans('how_it_works.tr_step_1_2')}}</li>
							<li>{{trans('how_it_works.tr_step_1_3')}}</li>
						</ul>
					</div>
					<div id="step_2" class="four-step">
						{{ HTML::image('img/Class.png','create a class', array('class' => 'home-step-img')) }}
						<h6>Create a Class</h6>
						<ul>
							<li>{{trans('how_it_works.tr_step_2_1')}}</li>
							<li>{{trans('how_it_works.tr_step_2_2')}}</li>
							<li>{{trans('how_it_works.tr_step_2_3')}}</li>
							<li>{{trans('how_it_works.tr_step_2_4')}}</li>
						</ul>
					</div>
					<div id="step_3" class="four-step">
						{{ HTML::image('img/create_class.png','add sessions', array('class' => 'home-step-img')) }}
						<h6>Add Sessions</h6>
						<ul>
							<li>{{trans('how_it_works.tr_step_3_1')}}</li>
							<li>{{trans('how_it_works.tr_step_3_2')}}</li>
							<li>{{trans('how_it_works.tr_step_3_3')}}</li>
						</ul>
					</div>
					<div id="step_4" class="four-step">
						{{ HTML::image('img/withdraw.png','manage trainer', array('class' => 'home-step-img')) }}
						<h6>Manage Account</h6>
						<ul>
							<li>{{trans('how_it_works.tr_step_4_1')}}</li>
							<li>{{trans('how_it_works.tr_step_4_2')}}</li>
							<li>{{trans('how_it_works.tr_step_4_3')}}</li>
							<li>{{trans('how_it_works.tr_step_4_4')}}</li>
						</ul>
					</div>
					<div class="tab-wrapper">
						<div class="tab-header" data-tab="register">
							<h4>{{trans('how_it_works.tr_step_1_tab')}}</h4>
						</div>
						<div class="tab-body" id="register">
							<div class="tab-screen">
								{{ HTML::image('img/Trainers-Step1.gif','rate trainer', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>{{trans('how_it_works.tr_step_1_title')}}</h4>
									{{trans('how_it_works.tr_step_1_body')}}
							</div>							
						</div>
						<div class="tab-header" data-tab="create">
							<h4>{{trans('how_it_works.tr_step_2_tab')}}</h4>
						</div>
						<div class="tab-body" id="create">
							<div class="tab-screen">
								{{ HTML::image('img/Class Hub.png','add class', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>{{trans('how_it_works.tr_step_2_title')}}</h4>
								{{trans('how_it_works.tr_step_2_body')}}
							</div>							
						</div>
						<div class="tab-header" data-tab="session">
							<h4>{{trans('how_it_works.tr_step_3_tab')}}</h4>
						</div>
						<div class="tab-body" id="session">
							<div class="tab-screen">
								{{ HTML::image('img/Calendar.png','add session', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>{{trans('how_it_works.tr_step_3_title')}}</h4>
								{{trans('how_it_works.tr_step_3_body')}}
							</div>							
						</div>
						<div class="tab-header" data-tab="manage">
							<h4>{{trans('how_it_works.tr_step_4_tab')}}</h4>
						</div>
						<div class="tab-body" id="manage">
							<div class="tab-screen">
								{{ HTML::image('img/Dashboard.png','manage account', array('class' => 'home-step-img')) }}
							</div>
							<div class="tab-info">
								<h4>{{trans('how_it_works.tr_step_4_title')}}</h4>
								{{trans('how_it_works.tr_step_4_body')}}
							</div>							
						</div>
					</div>
				</div>
			</div>	    
	  </div>
	</div>
    

@stop