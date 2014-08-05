<footer>
	<section>
		<aside>
			<header>
				{{Loc::text('general', 'classes', true)}}
			</header>
			{{ HTML::linkRoute('evercisegroups.search', Loc::text('footer', 'discover_fitness_classes') ) }}
		</aside>
		<aside>
			<header>
				{{Loc::text('general', 'create', true)}}
			</header>
			{{ HTML::linkRoute('trainers.create', Loc::text('footer', 'be_a_pro') ) }}
		</aside>
		<aside>
			<header>
				{{Loc::text('general', 'about', true)}}
			</header>
			{{ HTML::linkRoute('static.about', Loc::text('footer', 'what_is_Evercise')) }}<br>
			{{ HTML::linkRoute('static.class_guidelines', Loc::text('footer', 'class_guidelines')) }}<br>
			{{ HTML::linkRoute('static.faq', Loc::text('footer', 'help')) }}<br>
			{{ HTML::linkRoute('static.the_team', Loc::text('footer', 'meet_the_team')) }}<br>
		</aside>
		<aside>
			<header>
				{{Loc::text('general', 'stay_in_touch')}}
			</header>
			{{ HTML::linkRoute('static.contact_us', Loc::text('footer', 'contact_us') ) }}<br>
		</aside>
		<div>
			<p>{{ Loc::text('footer', 'what_is_Evercise') }}</p>
			<a href="https://www.facebook.com/evercise" target="_blank"><img src="/img/facebook.png" alt="evercise facebook page"/></a>
			<a href="https://twitter.com/LetsEvercise" target="_blank"><img src="/img/twitter.png" alt="evercise twitter page"/></a>
			<a href="https://plus.google.com/+Evercisefitness" target="_blank"><img src="/img/googleplus.png" alt="evercise google plus page"/></a>	
		</div>
	</section>
	
</footer>
<div class="lower_footer">
	<img src="/img/evercise logo for use.png" alt="evercise small logo"/>

	<p><small>{{ HTML::linkRoute('static.terms_of_use', 'Terms of Use') }}</small> <small>{{ HTML::linkRoute('static.privacy', Loc::text('footer', 'privacy_policy', true) ) }}</small>{{Loc::text('footer', 'copyright')}}</p>
</div>