@extends('layouts.master')


@section('content')
    <div id="how_it_works" class="full-width">
	    <div class="col12" id="how-it-works">
	    	<h1>How it Works</h1>
	    	<hr>
		    <video id="video" class="video" controls poster="{{ asset('img/search.png') }}">
				<source src="/video/EVERCISE ALMOST (2).mov"  type="video/mp4" />

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
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
						</ul>
					</div>
					<div id="step_2" class="four-step">
						{{ HTML::image('img/Sign-Up-Online.png','join up', array('class' => 'home-step-img')) }}
						<h6>Sign up to a class online</h6>
						<ul>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
						</ul>
					</div>
					<div id="step_3" class="four-step">
						{{ HTML::image('img/Class.png','get fit', array('class' => 'home-step-img')) }}
						<h6>Show up and shape up!</h6>
						<ul>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
						</ul>
					</div>
					<div id="step_4" class="four-step">
						{{ HTML::image('img/Rate-Review.png','rate trainer', array('class' => 'home-step-img')) }}
						<h6>Rate and review</h6>
						<ul>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
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
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultrices varius consequat. Sed in nibh tempus sem scelerisque egestas id quis erat. Curabitur justo justo, dictum mollis molestie tincidunt, facilisis et magna. In lorem enim, eleifend quis fermentum vel, cursus mollis justo. </p>
								<br>
								<p>Vivamus dignissim tempor ornare. Quisque dapibus luctus varius. Nam et velit sit amet nisl tincidunt tincidunt. Morbi ultrices est vitae velit tempor viverra. Phasellus feugiat arcu a dolor imperdiet iaculis. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
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
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultrices varius consequat. Sed in nibh tempus sem scelerisque egestas id quis erat. Curabitur justo justo, dictum mollis molestie tincidunt, facilisis et magna. In lorem enim, eleifend quis fermentum vel, cursus mollis justo. </p>
								<br>
								<p>Vivamus dignissim tempor ornare. Quisque dapibus luctus varius. Nam et velit sit amet nisl tincidunt tincidunt. Morbi ultrices est vitae velit tempor viverra. Phasellus feugiat arcu a dolor imperdiet iaculis. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
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
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultrices varius consequat. Sed in nibh tempus sem scelerisque egestas id quis erat. Curabitur justo justo, dictum mollis molestie tincidunt, facilisis et magna. In lorem enim, eleifend quis fermentum vel, cursus mollis justo. </p>
								<br>
								<p>Vivamus dignissim tempor ornare. Quisque dapibus luctus varius. Nam et velit sit amet nisl tincidunt tincidunt. Morbi ultrices est vitae velit tempor viverra. Phasellus feugiat arcu a dolor imperdiet iaculis. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
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
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultrices varius consequat. Sed in nibh tempus sem scelerisque egestas id quis erat. Curabitur justo justo, dictum mollis molestie tincidunt, facilisis et magna. In lorem enim, eleifend quis fermentum vel, cursus mollis justo. </p>
								<br>
								<p>Vivamus dignissim tempor ornare. Quisque dapibus luctus varius. Nam et velit sit amet nisl tincidunt tincidunt. Morbi ultrices est vitae velit tempor viverra. Phasellus feugiat arcu a dolor imperdiet iaculis. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
							</div>							
						</div>
					</div>
				</div>
				<div id="trainer" class="accordion-body tab-view">
					<div class="btn-wrap">
						@if(!isset($user) || !$user->inGroup($trainerGroup))
							{{HTML::link('trainers/create', 'Register', array('class' => 'btn btn-yellow'))}}

						@endif
					</div>
					<div id="step_1" class="four-step one_t">
						{{ HTML::image('img/register.png','register as trainer', array('class' => 'home-step-img')) }}
						<h6>Register</h6>
						<ul>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
						</ul>
					</div>
					<div id="step_2" class="four-step">
						{{ HTML::image('img/Class.png','create a class', array('class' => 'home-step-img')) }}
						<h6>Create a Class</h6>
						<ul>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
						</ul>
					</div>
					<div id="step_3" class="four-step">
						{{ HTML::image('img/create_class.png','add sessions', array('class' => 'home-step-img')) }}
						<h6>Add Sessions</h6>
						<ul>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
						</ul>
					</div>
					<div id="step_4" class="four-step">
						{{ HTML::image('img/withdraw.png','manage trainer', array('class' => 'home-step-img')) }}
						<h6>Manage Account</h6>
						<ul>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
							<li>List item</li>
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
								<h4>Search Classes</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultrices varius consequat. Sed in nibh tempus sem scelerisque egestas id quis erat. Curabitur justo justo, dictum mollis molestie tincidunt, facilisis et magna. In lorem enim, eleifend quis fermentum vel, cursus mollis justo. </p>
								<br>
								<p>Vivamus dignissim tempor ornare. Quisque dapibus luctus varius. Nam et velit sit amet nisl tincidunt tincidunt. Morbi ultrices est vitae velit tempor viverra. Phasellus feugiat arcu a dolor imperdiet iaculis. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
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
								<h4>Search Classes</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultrices varius consequat. Sed in nibh tempus sem scelerisque egestas id quis erat. Curabitur justo justo, dictum mollis molestie tincidunt, facilisis et magna. In lorem enim, eleifend quis fermentum vel, cursus mollis justo. </p>
								<br>
								<p>Vivamus dignissim tempor ornare. Quisque dapibus luctus varius. Nam et velit sit amet nisl tincidunt tincidunt. Morbi ultrices est vitae velit tempor viverra. Phasellus feugiat arcu a dolor imperdiet iaculis. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
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
								<h4>Search Classes</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultrices varius consequat. Sed in nibh tempus sem scelerisque egestas id quis erat. Curabitur justo justo, dictum mollis molestie tincidunt, facilisis et magna. In lorem enim, eleifend quis fermentum vel, cursus mollis justo. </p>
								<br>
								<p>Vivamus dignissim tempor ornare. Quisque dapibus luctus varius. Nam et velit sit amet nisl tincidunt tincidunt. Morbi ultrices est vitae velit tempor viverra. Phasellus feugiat arcu a dolor imperdiet iaculis. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
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
								<h4>Search Classes</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ultrices varius consequat. Sed in nibh tempus sem scelerisque egestas id quis erat. Curabitur justo justo, dictum mollis molestie tincidunt, facilisis et magna. In lorem enim, eleifend quis fermentum vel, cursus mollis justo. </p>
								<br>
								<p>Vivamus dignissim tempor ornare. Quisque dapibus luctus varius. Nam et velit sit amet nisl tincidunt tincidunt. Morbi ultrices est vitae velit tempor viverra. Phasellus feugiat arcu a dolor imperdiet iaculis. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
							</div>							
						</div>
					</div>
				</div>

			</div>	    
	    </div>
	</div>
    

@stop