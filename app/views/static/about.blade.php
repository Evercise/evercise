@extends('layouts.master')


@section('content')
    <div id="about" class="center_col">
        {{ HTML::image(trans('about.section1-image_url'), trans('about.section1-image_alt'), array('class' => 'wei')) }}
        <h2>{{trans('about.section1-title')}}</h2>
        {{trans('about.section1-body')}}

        <hr>
        {{ HTML::image(trans('about.section2-image_url'), trans('about.section2-image_alt'), array('class' => 'wei')) }}
        <h2>{{trans('about.section2-title')}}</h2>
        {{trans('about.section2-body')}}

        <hr>
        {{ HTML::image(trans('about.section3-image_url'), trans('about.section3-image_alt'), array('class' => 'wei')) }}
        <h2>{{trans('about.section3-title')}}</h2>
        {{trans('about.section3-body')}}

        <hr>
        {{ HTML::image(trans('about.section4-image_url'), trans('about.section4-image_alt'), array('class' => 'wei')) }}
        <br>
        <br>
        <br>
        <h2>{{trans('about.section4-title')}}</h2>
        {{trans('about.section4-body')}}
        
      
    </div>
@stop