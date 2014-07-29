@extends('layouts.master')


@section('content')

<div class="row">
	<div class="full-width">
		<br>
		<h1 class="tc">What is your goal?</h1>
		<div class="switch">
			<div class="switch-header icon-btn tc" data-view="user">
				<div class="switch-inner">
					{{ HTML::image( '/img/joinclasses2.png', 'choose user', array('class' => 'switch-image')) }}
					<span>{{ HTML::image( '/img/tick.png', 'choose user', array('class' => 'tick')) }}I want to join classes</span>

					
				</div>
				
			</div>
			<div class="switch-header icon-btn tc" data-view="trainer">
				<div class="switch-inner">
					{{ HTML::image( '/img/listclasses2.png', 'choose trainer', array('class' => 'switch-image')) }}
					<span>{{ HTML::image( '/img/tick.png', 'choose user', array('class' => 'tick')) }}I want to list classes</span>
				</div>
			</div>
		</div>
	</div>
	<div id="user" class="switch-body tab-view">
		@include('users.create')
	</div>
	<div id="trainer" class="switch-body tab-view">
		@include('users.create' , ['type' => route('trainers.create') , 'typeId' => 'trainer'])
	</div>
		
</div>


@stop