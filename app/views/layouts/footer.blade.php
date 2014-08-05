<footer>
	<section>
		<aside>
			<header>
				{{trans('general.classes')}}
			</header>
			{{ HTML::linkRoute('evercisegroups.search', trans('footer.discover_fitness_classes') ) }}
		</aside>
		<aside>
			<header>
				{{trans('general.create')}}
			</header>
			{{ HTML::linkRoute('trainers.create', trans('footer.be_a_pro') ) }}
		</aside>
		<aside>
			<header>
				{{trans('general.about')}}
			</header>
			{{ HTML::linkRoute('static.about', trans('footer.what_is_Evercise')) }}<br>
			{{ HTML::linkRoute('static.class_guidelines', trans('footer.class_guidelines')) }}<br>
			{{ HTML::linkRoute('static.faq', trans('footer.help')) }}<br>
			{{ HTML::linkRoute('static.the_team', trans('footer.meet_the_team')) }}<br>
		</aside>
		<aside>
			<header>
				{{trans('general.stay_in_touch')}}
			</header>
			{{ HTML::linkRoute('static.contact_us', trans('footer.contact_us') ) }}<br>
		</aside>
		<div>
			<p>{{ trans('footer.what_is_Evercise') }}</p>
			<a href="https://www.facebook.com/evercise" target="_blank"><img src="/img/facebook.png" alt="evercise facebook page"/></a>
			<a href="https://twitter.com/LetsEvercise" target="_blank"><img src="/img/twitter.png" alt="evercise twitter page"/></a>
			<a href="https://plus.google.com/+Evercisefitness" target="_blank"><img src="/img/googleplus.png" alt="evercise google plus page"/></a>	
		</div>
	</section>
	
</footer>
<div class="lower_footer">
	<img src="/img/evercise logo for use.png" alt="evercise small logo"/>

	<p><small>{{ HTML::linkRoute('static.terms_of_use', 'Terms of Use') }}</small> <small>{{ HTML::linkRoute('static.privacy', trans('footer.privacy_policy') ) }}</small>{{trans('footer.copyright')}}</p>
</div>