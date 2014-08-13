@extends('layouts.master')


@section('content')
    <div id="about" class="center_col">
      <p>PPC</p>
      <br>
      <p>{{ $category }}</p>

      <div class="milestone-refer">
        <div class="milestone-refer-wrap">
          <h4>Get Code</h4>
          <p>Bang in your email and we'll send you a lovely code n stuff</p>
          {{ Form::open(array('id' => 'send_ppc', 'url' => 'landings', 'method' => 'POST', 'class' => 'create-form milestone-form')) }}
            {{ Form::label( 'email', 'Email') }}
            {{ Form::text( 'email' , '', array('id' => 'email','placeholder' => 'Enter your email address')) }}
            {{ Form::submit('Get Code' , array('class'=>'btn btn-yellow ')) }}
          {{ Form::close() }}
        </div>
      </div>

    </div>
@stop