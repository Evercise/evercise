<footer>
	<section>
		<aside>
			<header>
				Classes
			</header>
			{{ HTML::linkRoute('auth.login', 'Discover fitness classes') }}
		</aside>
		<aside>
			<header>
				Create
			</header>
			{{ HTML::linkRoute('trainers.create', 'Be a pro') }}
		</aside>
		<aside>
			<header>
				About
			</header>
			{{ HTML::linkRoute('static.about', 'What is Evercise?') }}<br>
			{{ HTML::linkRoute('static.class_guidelines', 'Class Guidelines') }}<br>
			{{ HTML::linkRoute('static.faq', 'Help') }}<br>
			{{ HTML::linkRoute('static.the_team', 'Meet the team') }}<br>
		</aside>
		<aside>
			<header>
				Stay in touch
			</header>
			{{ HTML::linkRoute('static.contact_us', 'Contact Us') }}<br>
		</aside>
		<div>
			<p>Follow us</p>
			<a href="https://www.facebook.com/evercise" target="_blank"><img src="/img/facebook.png" alt="evercise facebook page"/></a>
			<a href="https://twitter.com/LetsEvercise" target="_blank"><img src="/img/twitter.png" alt="evercise twitter page"/></a>
			<a href="https://plus.google.com/+Evercisefitness" target="_blank"><img src="/img/googleplus.png" alt="evercise google plus page"/></a>	
		</div>
	</section>
	
</footer>
<div class="lower_footer">
	<img src="/img/evercise logo for use.png" alt="evercise small logo"/>

	<p><small>{{ HTML::linkRoute('static.terms_of_use', 'Terms of Use') }}</small> <small>{{ HTML::linkRoute('static.privacy', 'Privacy Policy') }}</small>©2014 Qin Technology. Inc.</p>
</div>