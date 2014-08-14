@extends('layouts.master')


@section('content')
    <div id="faq" class="full-width">
	    <div class="col3">
	    	<div id="faq_nav_column" class="">
	            <ul>
	                <h3><a href="#Basics">Basics</a></h3>
                  @foreach(trans('faq-basics') as $basics)
                    <li><a href="#{{$basics['title']}}">{{$basics['link']}}</a></li>
                  @endforeach
	            </ul>
	            <ul>
	                <h3><a href="#instructor">For Instructor</a></h3>
                  @foreach(trans('faq-instructor') as $instructor)
                    <li><a href="#{{$instructor['title']}}">{{$instructor['link']}}</a></li>
                  @endforeach
	            </ul>
	            <ul>
	                <h3><a href="#Participant">For Participants</a></h3>
                  @foreach(trans('faq-participant') as $participant)
                    <li><a href="#{{$participant['title']}}">{{$participant['link']}}</a></li>
                  @endforeach
	            </ul>
	            <br><br><br><br><br><br>
        </div>
	    </div>
	    <div class="col9">
	    	<div id="faq_main_column">
                <ul name="basics"><h3>Basics</h3>
                  @foreach(trans('faq-basics') as $basics)
                    <li>
                        <a name="{{$basics['title']}}"><div class="faq_gap"></div></a>
                        <strong>{{$basics['title']}}</strong><br><br>
                        {{$basics['body']}}
                    </li>
                  @endforeach
                </ul><br><br>
                <ul name="instructor"><h3>For Instructors</h3>
                  @foreach(trans('faq-instructor') as $instructor)
                    <li>
                        <a name="{{$instructor['title']}}"><div class="faq_gap"></div></a>
                        <strong>{{$instructor['title']}}</strong><br><br>
                        {{$instructor['body']}}
                    </li>
                  @endforeach
                    
                </ul>
                <div class="faq_gap"></div>
                <ul name="participant"><h3>For Participant</h3>
                  @foreach(trans('faq-participant') as $participant)
                    <li>
                        <a name="{{$participant['title']}}"><div class="faq_gap"></div></a>
                        <strong>{{$participant['title']}}</strong><br><br>
                        {{$participant['body']}}
                    </li>
                  @endforeach
                    
                </ul>
   			</div>
	    </div>
    </div>
@stop