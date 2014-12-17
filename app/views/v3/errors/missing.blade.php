@extends('v3.layouts.master')

@section('body')
<div class="container first-container">
	<div id="missing" class="row no-gutter text-center">
		<div class="row text-center">
            <div class="underline">
                <h1>Whoops</h1>
            </div>
        </div>

		<h3>We&apos;re sorry, but we can&apos;t seem to find <br>the page that you&apos;re looking for...</h3>
		<p>Try using the search box below and we&apos;ll see if we can get you back on track.</p>
    </div>
        <div class="row mt40 mb40">
            {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="input-group with-addon">
                        <div class="input-group-addon first"><span class="icon icon-search"></span></div>
                        {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search for Classes...']) }}

                        <div class="input-group-addon"><span class="icon icon-pointer"></span> </div>
                        {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location', 'id' => 'location-auto-complete']) }}

                        <div class="input-group-addon"><span class="icon icon-distance"></span></div>
                        <div class="custom-select custom-select-white">
                            {{ Form::select( 'distance' , array_flip(Config::get('evercise.radius')), (!empty($radius) ? $radius : Config::get('evercise.default_radius')), ['class' => 'form-control mr50']) }}
                        </div>
                        <span class="input-group-btn">
                            {{ Form::submit('Find a class', ['class' => 'btn btn-primary']) }}
                        </span>
                    </div>


                </div>

            {{ Form::close() }}
         </div>
</div>


@stop