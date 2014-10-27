@extends('v3.layouts.master')
@section('body')


    <div class="col-lg-12" style="margin-top:80px">
        <div class="col-lg-4">
            <ul>
                @foreach($categories as $c)
                    <li><a href="{{ url($c->permalink) }}">{{ $c->title }}</a></li>
                @endforeach
            </ul>

        </div>
        <div class="col-lg-8">
            <h1>{{ $title }}</h1>

            @foreach($articles as $a)

                   <div class="row" style="border-bottom:3px solid #cc6633; margin-bottom: 10px">

                       <img src="{{asset($a->main_image)}}" style="float:left; margin-right:10px; width:300px"/>
                            <h3>{{ $a->title }}</h3>
                            <p>{{ $a->intro }}</p>

                            <li><a href="{{ url(Articles::createUrl($a)) }}">Read More</a></li>
                    </div>

            @endforeach
        </div>
    </div>
@stop