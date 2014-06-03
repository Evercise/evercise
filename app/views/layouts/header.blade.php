<header>
	<section>
		<nav>		
			<ul>
				<a href="{{ URL::route('home', null) }}">{{ HTML::image('/img/evercise logo yellow.png', 'evercise logo'); }}</a>
                <li>{{ HTML::linkRoute('static', 'About', array('about')) }}</li>
                <li>{{ HTML::linkRoute('auth.login', 'Discover classes') }}</li>
                <li>{{ HTML::linkRoute('trainers.create', 'Be a pro') }}</li>
                <li>{{ HTML::linkRoute('auth.login', 'Help') }}</li>
                <li>
                	{{ Form::open(array('id' => 'search_bar', 'url' => 'users', 'method' => 'post')) }}
                		@include('form.textfield', array('fieldname'=>'search_bar', 'placeholder'=>'Find Classes near you', 'maxlength'=>50, 'label'=>null, 'fieldtext'=>null , 'default' => null ))
                	{{ Form::close() }}
                </li>
                @include('layouts.loginStatus')
            </ul>
		</nav>
	</section>
</header>