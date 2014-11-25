@extends('v3.layouts.master')
<?php View::share('og', $data['og']) ?>
@section('body')
    @if(isset($preview))
        <nav class="navbar navbar-inverse navbar-fixed-top" id="preview">
          <div class="container mt10">

            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    {{ Form::open(['route' => 'evercisegroups.publish', 'method' => 'post', 'id' =>'publish-class']) }}
                        <span class="text-white">This is what your class will look like when published</span>

                        {{ Html::linkRoute('sessions.add', 'Edit Sessions', $data['evercisegroup']->id, ['class' => 'btn btn-default text-right ml20 mr20'] ) }}
                        {{ Form::hidden('id', $data['evercisegroup']->id ) }}
                        {{ Form::hidden('publish', $data['evercisegroup']->published == 1 ? 0 : 1) }}
                        {{Form::submit( $data['evercisegroup']->published == 1 ? 'Un-publish' : 'Publish',['class'=>'btn btn-primary'])}}
                    {{ Form::close() }}
                </div>
            </div>
           </div>

        </nav>

    @endif
    <div class="hero no-nav-change" style="background-image: url('{{url().'/'.$data['trainer']->user->directory.'/cover_'.$data['evercisegroup']->image}}')">
        <nav class="navbar navbar-inverse nav-bar-bottom" role="navigation">
          <div class="container">
              <ul class="nav navbar-nav nav-justified nav-no-float" id="scroll-to">
                <li class="active"><a href="#about">About</a></li>
                <li class="{{ count($data['evercisegroup']->futuresessions) == 0 ? 'disabled' : null}}"><a href="#schedule">Schedule</a></li>
                <li class="{{ count($data['venue']->facilities) == 0 ? 'disabled' : null}}"><a href="#facilities">Facilities & Amenities</a></li>
                <li class="{{ count($data['allRatings']) == 0 ? 'disabled' : null}}"><a href="#ratings" >Reviews</a></li>
                <li class="text-center">
                    <span>
                        <a href="{{ Share::load(Request::url() , $data['evercisegroup']->name)->facebook()  }}" target="_blank"><span class="icon icon-fb mr20 hover"></span> </a>
                        <a href="{{ Share::load(Request::url() , $data['evercisegroup']->name)->twitter()  }}" target="_blank"><span class="icon icon-twitter mr20 hover"></span> </a>
                        <a href="{{ Share::load(Request::url() , $data['evercisegroup']->name)->gplus()  }}" target="_blank"><span class="icon icon-google hover"></span> </a>
                    </span>
                </li>
              </ul>
          </div>
        </nav>
    </div>
    <div class="container mt30 mb40">
        <div class="row" id="about">
            <div class="col-sm-6">
                <h1 class="mb5">{{ $data['evercisegroup']->name }}</h1>
                <div class="mb30">

                    @if (isset($data['allRatings']))
                        @include('v3.classes.ratings.stars', array('rating' => $data['allRatings']))
                    @endif
                </div>

                <p>{{ $data['evercisegroup']->description }}</p>
                <div class="row">
                    <div class="col-sm-11">
                        <div class="row mt20">
                            <div class="col-sm-3">
                                {{ image($data['trainer']->user->directory.'/small_'.$data['trainer']->user->image, $data['trainer']->user->first_name, ['class' => 'img-responsive img-circle']) }}
                            </div>
                            <div class="col-sm-9 mt25">
                                <div class="condensed">
                                    <strong>This class is presented by</strong>
                                </div>
                                <span>{{ $data['trainer']->user->display_name }}</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-sm-6">
                <h1 class="mb5">Location</h1>
                <span><span class="icon icon-pink-pointer"></span>{{ $data['venue']->address }}</span>
                <div id="map_canvas" class="map_canvas mt10" data-zoom="12" data-lat="{{ $data['venue']->lat }}" data-lng="{{ $data['venue']->lng }}"></div>
            </div>
        </div>
        <hr>
        <div id="schedule" class="row">
            <div class="col-sm-12">
                <h1>Upcoming sessions</h1>
            </div>

            <div class="col-sm-12">
                <ul class="nav navbar-nav nav-carousel hide-by-class-wrapper">
                    <li><a class="hide-by-class disabled" href="#Mon">MON</a></li>
                    <li><a class="hide-by-class disabled" href="#Tue">TUE</a></li>
                    <li><a class="hide-by-class disabled" href="#Wed">WED</a></li>
                    <li><a class="hide-by-class disabled" href="#Thu">THU</a></li>
                    <li><a class="hide-by-class disabled" href="#Fri">FRI</a></li>
                    <li><a class="hide-by-class disabled" href="#Sat">SAT</a></li>
                    <li><a class="hide-by-class disabled" href="#Sun">SUN</a></li>
                </ul>

                <div class="table-responsive center-block">
                    <table class="table table-hover pull-left">
                        <tbody>
                            @foreach($data['evercisegroup']->futuresessions as $futuresession)
                                <tr class="{{date('D' , strtotime($futuresession->date_time))}} hide-by-class-element hide">
                                    <td><span class="icon icon-calendar mr5"></span><span>{{ date('dS-M-y' , strtotime($futuresession->date_time))}}</span></td>
                                    <td><span class="icon icon-clock mr5"></span><span>{{ (date('h:ia' , strtotime($futuresession->date_time))) .' - '. (date('h:ia' , strtotime($futuresession->date_time) + ( $futuresession->duration * 60))) }}</span></td>
                                    <td><span class="icon icon-ticket mr10"></span><span>x {{ $futuresession->tickets -  $data['members'][$futuresession->id] }} tickets left</span></td>
                                    <td><span class="icon icon-watch mr5"></span><span>{{ $futuresession->formattedDuration() }}</span></td>
                                    <td>
                                        {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $futuresession->id, 'class' => 'add-to-class']) }}
                                            <span>
                                                <strong class="text-primary mr25 lead">&pound;{{ $futuresession->price }} </strong>
                                            </span>

                                            <div class="btn-group pull-right">
                                                {{ Form::submit('join class', ['class'=> 'btn btn-primary']) }}
                                                {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $futuresession->id)) }}

                                                  <select name="quantity" id="quantity" class="btn btn-primary btn-select">
                                                    @for($i=0; $i<($futuresession->tickets - $data['members'][$futuresession->id] + 1 ); $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                  </select>

                                            </div>
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr>
        <div id="facilities" class="row">
            <div class="col-sm-12">
                @if(count($data['venue']->facilities) > 0)
                <div class="page-header">
                    <h1>Venue Facilities</h1>
                </div>

                <ul class="row custom-list">
                    @foreach($data['venue']->facilities as $key => $facility)
                        @if ($facility->category == 'facility')
                            <div class="col-sm-3">
                                <li>{{ $facility->name}}</li>
                            </div>
                        @endif
					@endforeach
                </ul>
                @endif

                @if(count($data['venue']->facilities) > 0)
                <div class="page-header">
                    <h1>Venue Amenties</h1>
                </div>
                <ul class="row custom-list">
					@foreach($data['venue']->facilities as $key => $facility)
					        @if ($facility->category == 'amenity')
					            <div class="col-sm-3">
                                    <li>{{ $facility->name}}</li>
                                </div>
                            @endif
					@endforeach
                </ul>
                @endif
            </div>
        </div>
        @if(count($data['allRatings']) > 0)
        <hr>
        <div id="ratings" class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>Reviews</h1>
                </div>
            </div>
            @foreach ($data['allRatings'] as $rating)
                <div class="col-sm-6">
                    @include('v3.users.rating_block')
                </div>
            @endforeach
        </div>
        @endif
    </div>
@stop