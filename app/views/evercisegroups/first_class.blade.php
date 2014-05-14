@extends('layouts.master')

@section('content')

<div class="full_width">
	<div class="row8">
		<br>
		<h5>Creating your first class with evercise is easy</h5>
		<br>
		<br>
		<br>
		<div class="col2 push1">
			{{ HTML::image( '/img/first_class_type.png', 'class image', array('class' => 'class-block-img')); }}
			<br>
			<br>
			<br>
			{{ HTML::image( '/img/first_one.png', 'class image', array('class' => 'class-block-img')); }}
			<br>
			<br>
			
		</div>
		<div class="col2">
			{{ HTML::image('/img/first_arrow.png', 'class image', array('class' => 'class-block-img')); }}
		</div>
		<div class="col2">
			{{ HTML::image('/img/first_calander.png', 'class image', array('class' => 'class-block-img')); }}
			<br>
			<br>
			<br>
			{{ HTML::image( '/img/first_two.png', 'class image', array('class' => 'class-block-img')); }}
			<br>
			<br>
		</div>
	</div>
	<div class="row8">
		<div class="col4">
			<h6>Fill out the class information</h6>
			<br>
			<small>If you intend to run the class regularly, <br>
			you only need to create it once. <br><br>
			As well as saving you time, <br>
			this also means your class can build <br>
			up a reputation through participant feedback.</small>
		</div>
		<div class="col4">
			<h6>Fill out the class information</h6>
			<br>
			<small>Once you have created a class, <br>
			add multiple dates.<br><br>

			You don't have to decide on all the dates <br>
			when you create the class, <br>
			you can always add new dates later.</small>
		</div>
	</div>

	<div class="row8">
		<div class="col4">
			<br>
			<br>
			<br>
			<br>
			{{ HTML::linkRoute('evercisegroups.create', 'Create your first class!',null ,array('class' => 'btn-yellow push2')) }}
		</div>
	</div>
	
</div>
@stop