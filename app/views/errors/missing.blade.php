@extends('v3.layouts.master')

@section('body')
<div class="container">
	<div id="missing" class="row no-gutter" style="margin-top:100px;text-align: center;margin-bottom: 70px">
		<h1>WHOOPS!</h1>

		<h3>We&apos;re sorry, but we can&apos;t seem to find <br>the page that you&apos;re looking for...</h3>
		<p>Try using the search box below and we&apos;ll see if we can get you back on track.</p>

            <div class="row no-gutter visible-md-block visible-lg-block">
                {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                    <div class="col-sm-12">
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
                                <button class="btn btn-primary" type="submit">
                                     Find a Class
                                </button>
                            </span>
                        </div>


                    </div>

                {{ Form::close() }}
         </div>
    </div>
</div>


@stop