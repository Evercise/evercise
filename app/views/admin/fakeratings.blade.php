@extends('layouts.master')


@section('title', 'View Classes')
@section('content')

	@include('layouts.pagetitle', array('title'=>'View Classes', 'subtitle'=>'and stuff'))

	@foreach($evercisegroups as $evercisegroup)

                {{ Form::open(array('id' => 'fakerating_create', 'url' => 'admin/fakeratings', 'method' => 'post', 'class' => 'create-form')) }}
                <p>{{ $evercisegroup->name }}</p>
                <h2>real reviews:</h2>
                <ul>
                @foreach($evercisegroup->ratings as $rating)
                        <li>- {{ $rating->stars }} stars: {{ $rating->comment }} </li>
                @endforeach
                </ul>
                <h2>fake reviews:</h2>
                <ul>
                @foreach($evercisegroup->fakeRatings as $rating)
                        <li>- {{ $rating->stars }} stars: {{ $rating->comment }} </li>
                @endforeach
                </ul>

                @include('form.textfield', array('fieldname'=>'stars', 'placeholder'=>'stars', 'maxlength'=>10, 'label'=>'stars', 'default' => 5 ))
                @include('form.textfield', array('fieldname'=>'comment', 'placeholder'=>'comment', 'maxlength'=>10, 'label'=>'comment', 'default' => '' ))
                @include('form.hidden', array('fieldname'=>'evercisegroup_id', 'placeholder'=>'evercisegroup_id', 'maxlength'=>10, 'label'=>'evercisegroup_id', 'value' => $evercisegroup->id ))
                
                {{ Form::submit('Leave review' , array('class'=>'btn btn-yellow', 'id' => 'create_review')) }}

                {{ Form::close() }}
		
	@endforeach

@stop