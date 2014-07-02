@extends('layouts.master')

@section('content')

	<div id="missing" class="col7 push1">
		<h1>WHOOPS!</h1>

		<h3>We&apos;re sorry, but we can&apos;t seem to find <br>the page that you&apos;re looking for...</h3>
		<p>Try using the search box below and we&apos;ll see if we can get you back on track.</p>
		<div class="search-box-wrap">
			@include('evercisegroups.refine')
		</div>

	</div>
	{{ HTML::image('img/confussed_guy.png', 'missing potatoe' , array('class' => 'missing-potatoe')); }}

@stop