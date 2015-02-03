@extends('v3.layouts.master')
<?php View::share('og', $data['og']) ?>
<?php  View::share('angular', 'show') ?>
@section('body')
    <script>
        var CART = '{{ json_encode($cart_items) }}';
    </script>
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
    <div class="hero hero-nav-change class-hero" style="background-image: url('{{url().'/'.$data['user']->directory.'/cover_'.$data['image']}}')">
        <div class="mask"></div>
    </div>
    <div class="container class-content">
        <div class="row text-white">
            <div class="col-sm-12">
                <span class="text-large">Breadcrumb <span class="text-primary">></span> Where you are</span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-white lg">{{ $data['name'] }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mt15">
                <strong class="text-white">Overview</strong>
                <p class="mt1 text-white">{{ $data['description'] }}</p>
                <div class="row mt50">
                    <div class="col-xs-3">
                        {{ Html::decode( Html::linkRoute('trainer.show', image($data['user']->directory.'/small_'.$data['user']->image, $data['user']->display_name, ['class' => 'img-responsive img-circle']) , strtolower($data['user']->display_name)) ) }}
                    </div>
                    <div class="col-xs-9 mt25">
                        <div class="condensed">
                            <strong class="text-white">This class is presented by</strong>
                        </div>
                        <span>{{ Html::linkRoute('trainer.show', $data['user']->display_name, strtolower($data['user']->display_name), ['class' => 'text-primary'] )}}</span>
                    </div>
                </div>
                <div class="panel panel-default mt40" id="map-panel">
                    <div class="panel-body">
                        <strong class="text-large">Location</strong><br>
                        {{ $data['venue']->name }}<br>
                        {{ $data['venue']->address }}
                        <div id="map_canvas" class="map_canvas mt10" data-zoom="8" data-lat="{{ $data['venue']->lat }}" data-lng="{{ $data['venue']->lng }}"></div>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 sm-mt30">
                <div class="panel panel-default">
                    <div class="panel-body">
                       {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $data['next_session']->id, 'class' => 'add-to-class']) }}
                           @if(Input::has('t'))
                                <strong class="text-large">Selected Session</strong>
                           @else
                                <strong class="text-large">Next Session</strong>
                           @endif

                           <div class="row">
                                <div class="col-xs-6 visible-md-block visible-lg-block">{{ date('l M dS, g:iA' , strtotime($data['next_session']->date_time)) }}</div>
                                <div class="col-xs-6 visible-sm-block visible-xs-block">{{ date('D M dS, g:iA' , strtotime($data['next_session']->date_time)) }}</div>
                                <div class="col-xs-3 text-center"><strong class="text-primary">£{{ $data['next_session']->price }}</strong> </div>
                                <div class="qty-wrapper">
                                    <div class="col-xs-3 visible-md-block visible-lg-block visible-sm-block">
                                        <select name="quantity" id="quantity" class="qty-select select-box">
                                            @for($i=1; $i<($data['next_session']->remaining  + 1 ); $i++)
                                                <option value="{{$i}}" {{ (!empty($cart_items[$data['next_session']->id]) && $cart_items[$data['next_session']->id] == $i ? 'selected="selected"' : '') }}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-xs-3 visible-xs-block">
                                        <select name="quantity" id="quantity" class="qty-select form-control select-default">
                                            @for($i=1; $i<($data['next_session']->remaining  + 1 ); $i++)
                                                <option value="{{$i}}" {{ (!empty($cart_items[$data['next_session']->id]) && $cart_items[$data['next_session']->id] == $i ? 'selected="selected"' : '') }}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                           </div>
                           <div class="row mt15">
                                <div class="col-sm-12">
                                    <div class="pull-right">
                                        {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $data['next_session']->id)) }}
                                        {{ Form::hidden('force', true) }}
                                        {{ Form::submit('Book Class', ['class'=>'btn btn-primary add-btn']) }}

                                    </div>
                                </div>
                           </div>
                       {{ Form::close() }}
                    </div>
                </div>

                <div class="panel panel-default" ng-app="everApp" ng-controller="calendarController" ng-cloak>
                    <div class="panel-body">
                        <strong class="text-large">Session Calendar</strong><br>
                        <div id="class-calendar" class="class-calendar">
                            {{ Form::hidden('sessions',json_encode($data['futuresessions'])  ) }}
                        </div>
                    </div>
                    <ul class="list-group calendar-selected">
                        <li class="list-group-item text-center" ng-show="activeDate">
                            <strong class="list-group-item-heading">{[{ activeDate | date : "EEE, dd MMMM yyyy" }]}</strong>
                        </li>

                        <li class="list-group-item" ng-repeat="row in rows| filter:activeFilter">
                            <div class="row sm-no-gutter sm-mr0">
                                {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class-{[{ row.id  }]}', 'class' => 'add-to-class']) }}
                                    <div class="col-xs-5">
                                        <div class="row">
                                            <div class="col-xs-6 sm-text-right">{[{row.date | date: 'hh:mm a' }]}</div>
                                            <div class="col-xs-6 text-center text-primary sm-text-right">{[{row.price | currency : '£' : 2}]}</div>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="row">
                                            <div class="qty-wrapper">
                                                <div class="col-xs-5 visible-md-block visible-lg-block visible-sm-block">
                                                    <select name="quantity" id="quantity" class="select-box qty-select">
                                                        <option ng-selected="{[{ n + 1 == row.selected }]}" ng-repeat="n in [] | repeat:row.remaining" value="{[{ n + 1 }]}">{[{ n + 1}]}</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-5 col-xs-6 visible-xs-block selectable-btn">
                                                    <select name="quantity" id="quantity" class="form-control select-default qty-select">
                                                        <option ng-selected="{[{ n + 1 == row.selected }]}" ng-repeat="n in [] | repeat:row.remaining" value="{[{ n + 1 }]}">{[{ n + 1}]}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-7 col-xs-6">
                                                <div class="pull-right sm-no-float">
                                                    {{ Form::hidden('product-id', EverciseCart::toProductCode('session', '{[{ row.id}]}')) }}
                                                    {{ Form::hidden('force', true) }}
                                                    {{ Form::submit('Book Class', ['class'=> 'btn btn-primary add-btn sm-btn-block']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                {{Form::close()}}
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="ml10">
                    <strong class="text-large">Related Categories</strong>
                    <div class="text-center mt20">
                        @foreach($related as $cat)
                            <a href="/uk/london?search={{$cat->name}}" class="btn btn-rounded btn-white-primary mb10 mr10 ml10">{{$cat->name}}</a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <div class="row visible-xs-block">
            <div id="map-panel-mobile" class="col-sm-6"></div>
        </div>
        @if(count($facilities = $data['venue']->getFacilities()) || count($amenities = $data['venue']->getAmenities()))
            <div id="facilities" class="row sm-text-left">
                <div class="col-sm-12">
                    @if(count($facilities = $data['venue']->getFacilities()))
                        <div class="page-header">
                            <h3 class="h2">Venue Facilities</h3>
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
                            <h3 class="h2">Venue Amenties</h3>
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
    </div>
@stop
