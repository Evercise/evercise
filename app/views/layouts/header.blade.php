<header>
	<section>
		<nav>
			<ul>
				<a href=""><img src="/img/evercise logo yellow.png" alt="evercise facebook page"/></a>
                <li>{{ HTML::linkRoute('auth.login', 'About') }}</li>
                <li>{{ HTML::linkRoute('auth.login', 'Discover classes') }}</li>
                <li>{{ HTML::linkRoute('auth.login', 'Be a pro') }}</li>
                <li>{{ HTML::linkRoute('auth.login', 'Help') }}</li>
                <li>
                	{{ Form::open(array('id' => 'search_bar', 'url' => 'users', 'method' => 'post')) }}
                		@include('form.textfield', array('fieldname'=>'search_bar', 'placeholder'=>'Find Classes near you', 'maxlength'=>50, 'label'=>null, 'fieldtext'=>null ))
                	{{ Form::close() }}
                </li>
                <li>{{ HTML::linkRoute('auth.login', 'Join Evercise') }}</li>
                <li>{{ HTML::linkRoute('auth.login', 'Login', null, array('id'=>'login')) }}</li>
            </ul>
			@include('layouts.headerUser')
		</nav>
	</section>
</header>