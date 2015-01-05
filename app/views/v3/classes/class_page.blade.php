@extends('v3.layouts.master')
<?php View::share('og', $data['og']) ?>
@section('body')
    @if(isset($preview))
        <nav class="navbar navbar-inverse navbar-fixed-top" id="preview">
          <div class="container mt10">

            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    {{ Form::open(['route' => 'evercisegroups.publish', 'method' => 'post', 'id' =>'publish-class']) }}
                        <div class="row">
                            <div class="col-sm-6 sm-text-center"><span class="text-white">This is what your class will look like when published</span></div>
                            <div class="col-sm-3 sm-mb10  sm-mt10">{{ Html::linkRoute('sessions.add', 'Edit Sessions', $data['id'], ['class' => 'btn btn-default btn-block'] ) }}</div>
                            <div class="col-sm-3 sm-mb10">{{Form::submit( $data['published'] == 1 ? 'Un-publish' : 'Publish',['class'=>'btn btn-primary btn-block'])}}</div>
                        </div>



                        {{ Form::hidden('id', $data['id'] ) }}
                        {{ Form::hidden('publish', $data['published'] == 1 ? 0 : 1) }}

                    {{ Form::close() }}
                </div>
            </div>
           </div>

        </nav>

    @endif
    <div class="hero no-nav-change" style="background-image: url('{{url().'/'.$data['user']->directory.'/cover_'.$data['image']}}')">
        <nav class="navbar navbar-inverse nav-bar-bottom" role="navigation">
          <div class="container">
              <ul class="nav navbar-nav nav-justified nav-no-float" id="scroll-to">
                <li class="active"><a href="#about">About</a></li>
                <li class="{{ count($data['futuresessions']) == 0 ? 'hidden' : null}}"><a href="#schedule">Schedule</a></li>
                <li class="{{ count($data['venue']->facilities) == 0 ? 'hidden' : null}}"><a href="#facilities">Facilities & Amenities</a></li>
                <li class="{{ count($data['ratings']) == 0 ? 'hidden' : null}}"><a href="#ratings" >Reviews</a></li>
                <li class="text-center">
                    <span>
                        <a href="{{ Share::load(Request::url() , $data['name'])->facebook()  }}" target="_blank"><span class="icon icon-fb-white mr20 hover"></span> </a>
                        <a href="{{ Share::load(Request::url() , $data['name'])->twitter()  }}" target="_blank"><span class="icon icon-twitter-white mr20 hover"></span> </a>
                        <a href="{{ Share::load(Request::url() ,$data['name'])->gplus()  }}" target="_blank"><span class="icon icon-google-white hover"></span> </a>
                    </span>
                </li>
              </ul>
          </div>
        </nav>
    </div>
    <div class="container mt30 mb40">
        <div class="row sm-text-center" id="about">
            <div class="col-sm-6">
                <h1 class="mb5">{{ $data['name'] }}</h1>
                <div class="mb30">

                    @if (isset($data['ratings']))
                        @include('v3.classes.ratings.stars', array('rating' => $data['ratings']))
                    @endif
                </div>

                <p>{{ $data['description'] }}</p>
                <div class="row">
                    <div class="col-sm-11">
                        <div class="row mt20">
                            <div class="col-sm-3">
                                {{ Html::decode( Html::linkRoute('trainer.show', image($data['user']->directory.'/small_'.$data['user']->image, $data['user']->display_name, ['class' => 'img-responsive img-circle center-block']) , $data['user']->display_name) ) }}
                            </div>
                            <div class="col-sm-9 mt25">
                                <div class="condensed">
                                    <strong>This class is presented by</strong>
                                </div>
                                <span>{{ Html::linkRoute('trainer.show', $data['user']->display_name, $data['user']->display_name) }}</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-sm-6">
                <h1 class="mb5">Location</h1>
                <div class="condensed">
                    <span class="icon icon-pink-pointer"></span><strong>{{ ucfirst($data['venue']->name) }}</strong>
                </div>
                <span>{{ $data['venue']->fullAddress() }}</span>
                <div id="map_canvas" class="map_canvas mt10" data-zoom="12" data-lat="{{ $data['venue']->lat }}" data-lng="{{ $data['venue']->lng }}"></div>
            </div>
        </div>
        <hr>
        <div id="schedule" class="row">
            <div class="col-sm-12">
                <h2 class="h1">Upcoming sessions</h2>
            </div>

            <div class="col-sm-12">
                <ul class="nav  nav-carousel hide-by-class-wrapper">
                    <li class="hidden-mob"><a class="hide-by-class disabled" href="#Mon">MON</a></li>
                    <li class="hidden-mob"><a class="hide-by-class disabled" href="#Tue">TUE</a></li>
                    <li class="hidden-mob"><a class="hide-by-class disabled" href="#Wed">WED</a></li>
                    <li class="hidden-mob"><a class="hide-by-class disabled" href="#Thu">THU</a></li>
                    <li class="hidden-mob"><a class="hide-by-class disabled" href="#Fri">FRI</a></li>
                    <li class="hidden-mob"><a class="hide-by-class disabled" href="#Sat">SAT</a></li>
                    <li class="hidden-mob"><a class="hide-by-class disabled" href="#Sun">SUN</a></li>
                </ul>
                <div class="session-list">
                    @foreach($data['futuresessions'] as $futuresession)
                        <div class="row {{date('D' , strtotime($futuresession->date_time))}} hide-by-class-element hide">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <div class="row">
                                            <div class="col-sm-7"><span class="icon icon-calendar mr5"></span><span><time datetime="{{ date('Y-m-d H:i' ,strtotime($futuresession->date_time) )}}">{{ date('M jS Y' , strtotime($futuresession->date_time))}}</time></span></div>
                                            <div class="col-sm-5"><span class="icon icon-clock mr5"></span><span><time datetime="{{ date('Y-m-d H:i' ,strtotime($futuresession->date_time) )}}">{{ (date('g:ia' , strtotime($futuresession->date_time))) }}</time></span></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                @if($futuresession->remaining  > 0)
                                                    <span class="icon icon-ticket mr10"></span><span>x {{$futuresession->remaining  }} tickets left</span>
                                                @else
                                                    <span class="text-danger">Class Full</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-6"><span class="icon icon-watch mr5"></span><span>{{ formatDuration($futuresession->duration) }}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"><strong class="text-primary mr25 text-larger">&pound;{{ round($futuresession->price , 2)}}</strong></div>
                            <div class="col-md-3 hidden-sm hidden-xs">
                                @if($futuresession->remaining  > 0)
                                    {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $futuresession->id, 'class' => 'add-to-class']) }}
                                        <div class="btn-group btn-block">
                                            {{ Form::submit('Join class', ['class'=> isset($preview) ? 'btn btn-primary disabled' : 'btn btn-primary add-btn ']) }}
                                            {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $futuresession->id)) }}
                                            {{ Form::hidden('force', true) }}
                                            <div class="btn btn-primary btn-aside">
                                                <div class="custom-select">
                                                    <select name="quantity" id="quantity" class="btn-select btn-primary {{isset($preview) ? 'disabled' : null}}">
                                                        @for($i=1; $i<($futuresession->remaining  + 1 ); $i++)
                                                        <option value="{{$i}}" {{ (!empty($cart_items[$futuresession->id]) && $cart_items[$futuresession->id] == $i ? 'selected="selected"' : '') }}>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                @else
                                    <span class="text-danger">Class Full</span>
                                @endif
                            </div>
                            <div class="col-md-3 visible-sm-block visible-xs-block">
                                @if($futuresession->remaining  > 0)
                                    {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $futuresession->id, 'class' => 'add-to-class']) }}
                                        <div class="row sm-mt5">
                                            <div class="col-xs-6">
                                                <div class="toggle-select row" data-qty="{{$futuresession->remaining}}">
                                                    <div class="switch col-xs-3"><a href="#minus">-</a></div>
                                                    <div id="qty" class="col-xs-6 text-center">{{ !empty($cart_items[$futuresession->id]) ?  $cart_items[$futuresession->id] : 1}}</div>
                                                    <div class="switch col-xs-3"><a href="#plus">+</a> </div>
                                                    {{Form::hidden('quantity', !empty($cart_items[$futuresession->id]) ?  $cart_items[$futuresession->id] : 1 ,['id' => 'toggle-quantity'])}}
                                                </div>

                                            </div>
                                            <div class="col-xs-6">
                                                {{ Form::submit('join class', ['class'=> isset($preview) ? 'btn btn-primary disabled btn-block' : 'btn btn-primary add-btn btn-block']) }}
                                            </div>
                                            {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $futuresession->id)) }}
                                            {{ Form::hidden('force', true) }}

                                        </div>
                                    {{ Form::close() }}
                                @else
                                    <span class="text-danger">Class Full</span>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr>
        @if(count($facilities = $data['venue']->getFacilities()) || count($amenities = $data['venue']->getAmenities()))
            <div id="facilities" class="row sm-text-left">
                <div class="col-sm-12">
                    @if(count($facilities = $data['venue']->getFacilities()))
                        <div class="page-header">
                            <h2 class="h1">Venue Facilities</h2>
                        </div>

                        <ul class="row custom-list">
                            @foreach($facilities as $facility)
                                <div class="col-sm-3 sm-text-left">
                                    <li>{{ $facility->name}}</li>
                                </div>
                            @endforeach
                        </ul>
                    @endif

                    @if(count($amenities = $data['venue']->getAmenities()))
                        <div class="page-header">
                            <h2 class="h1">Venue Amenties</h2>
                        </div>
                        <ul class="row custom-list">
                            @foreach($amenities as $amenity)
                                <div class="col-sm-3 sm-text-left">
                                    <li>{{ $amenity->name}}</li>
                                </div>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @endif
        @if(count($data['ratings']) > 0)
        <hr>
        <div id="ratings" class="row sm-text-center">
            <div class="col-sm-12">
                <div class="page-header">
                    <h2 class="h1">Reviews</h2>
                </div>
            </div>
            @foreach ($data['ratings'] as $rating)
                <div class="col-sm-6">
                    @include('v3.users.rating_block')
                </div>
            @endforeach
        </div>
        @endif
    </div>
@stop
