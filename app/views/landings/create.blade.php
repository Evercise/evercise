@extends('layouts.landingMaster')


@section('content')


<div class="row">
  <div class="styling-template">
    {{ HTML::image('img/landing_page_concept_2_cropped.png') }}
  </div>
  <header class="ppc">
    <section class="logo">
      {{ HTML::image('/img/evercise_logo.png', 'evercise logo', array('class' => 'logo')); }}
    </section>
    <section class="strapline">
      <h1>{{trans('landing.header')}}</h1>
      <p>{{trans('landing.terms')}}</p>
    </section>
  </header>
  <div  class="sign-up">
    {{ Form::open(array('id' => 'send_ppc', 'url' => 'landings', 'method' => 'POST', 'class' => 'create-form milestone-form')) }}
            {{ Form::label( 'email', 'Email Address') }}
            {{ Form::hidden( 'category' , $category->id , array('id' => 'category')) }}
            {{ Form::text( 'email' , '', array('id' => 'email','placeholder' => 'Enter your email address')) }}
            {{ Form::submit('Get Code' , array('class'=>'btn btn-yellow ')) }}
          {{ Form::close() }}
          {{ HTML::link('ppc_fb/'.$category->id, 'Sign up with facebook', array('class' => 'btn btn-fb btn-large')) }}
  </div>
</div>
{{--
    <div id="about" class="center_col">
      <p>PPC</p>
      <br>
      <p>{{ $category->name }}</p>

      <div class="milestone-refer">
        <div class="milestone-refer-wrap">
          <h4>Get Code</h4>
          <p>Bang in your email and we'll send you a lovely code n stuff</p>
          {{ Form::open(array('id' => 'send_ppc', 'url' => 'landings', 'method' => 'POST', 'class' => 'create-form milestone-form')) }}
            {{ Form::label( 'email', 'Email') }}
            {{ Form::text( 'category' , $category->id , array('id' => 'category')) }}
            {{ Form::text( 'email' , '', array('id' => 'email','placeholder' => 'Enter your email address')) }}
            {{ Form::submit('Get Code' , array('class'=>'btn btn-yellow ')) }}
          {{ Form::close() }}
          {{ HTML::link('ppc_fb/'.$category->id, 'Sign up with facebook', array('class' => 'btn btn-fb btn-large')) }}
        </div>
      </div>

    </div>
    --}}
@stop

@include('layouts.laracasts')