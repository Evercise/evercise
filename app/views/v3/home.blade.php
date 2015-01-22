@extends('v3.layouts.master')
@section('body')
    <div id="hero-carousel" class="carousel slide">
          <div class="carousel-inner">
            @foreach($slider as $index => $sl)
                 <div class="item {{ $index == 0 ? 'active': null }}">
                    <div class="hero hero-nav-change" style="background-image: url('{{url().'/files/slider/cover_'. $sl['image']}}');">
                        <div class="jumbotron">
                          <div class="container text-center">
                            <h1 class="text-white mb0"> {{ $sl['name'] }}</h1>
                            <h2 class="text-primary mt0">only &pound; {{ round($sl['price'], 0) }}</h2>
                            <div class="row mt20 text-center">
                                {{ Html::linkRoute('evercisegroups.show', 'View Class', Evercisegroup::getSlug($sl['evercisegroup_id']) ,['class' => 'btn btn-primary']) }}
                            </div>
                          </div>
                        </div>
                    </div>
                 </div>
            @endforeach
          </div>
    </div>

    <div class="container-fluid bg-dark-grey mb30 sm-mb0">
        <div class="container">
            <div class="row mt10 mb10 sm-inline-gutter visible-md-block visible-lg-block">
                {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                    <div class="mb0">
                        <div class="col-sm-6">
                            <div class="input-group">
                                  <div class="input-group-addon"><span class="icon icon-search"></span></div>
                                  {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search for Classes...', 'data-toggle' => "dropdown",  'autocomplete' => 'off']) }}
                                   <ul class="dropdown-menu category-select" >
                                      <li class="heading">Popular Searches</li>
                                      @foreach($homepage['popular_searches'] as $search)
                                            <li><a href="{{$search}}">{{$search}}</a></li>
                                      @endforeach
                                  </ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="icon icon-pointer"></span></div>
                                {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location', 'id' => 'location-auto-complete', 'data-toggle' => 'dropdown',  'autocomplete' => 'off']) }}
                                <ul id="locaction-autocomplete" class="dropdown-menu category-select" >
                                    <li id="near-me" class="heading locator"><span class="icon icon-locator-pink-small"></span>Use my Current Location</li>
                                    <div class="autocomplete-content"></div>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            {{ Form::hidden('city', null) }}
                            {{ Form::submit('Find a class' , ['class' => 'btn btn-primary btn-block']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            <div class="row mt10 mb10 sm-inline-gutter visible-xs-block visible-sm-block">
                {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                    <div class="col-xs-10">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="icon icon-search"></span></div>
                            {{ Form::text('search', null, ['class' => 'form-control input-lg', 'placeholder' => 'I am looking for....Running']) }}
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <div class="btn-find-me">
                            {{ Form::hidden('location', null ) }}
                            {{ Form::hidden('city', null) }}
                            {{ Form::submit('' , ['class' => 'btn btn-primary btn-block btn-lg locator', 'id' => 'mobile-sub']) }}
                        </div>

                    </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="container">
       @foreach($blocks as $index => $block)
            @if(!isset($block['background']))
                <div class="row">
                   <div class="col-sm-12">
                       <div class="page-header">
                           <div class="row">
                                <div class="col-sm-9">
                                    <span class="text-primary text-larger">{{ $block['title'] }}</span>
                                </div>
                                <div class="col-sm-3 text-right hidden-sm hidden-xs">
                                    <a class="view-all-btn" href="{{ $block['link'] }}">{{ $block['link_title'] }}</a>
                                </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="row">
                   @foreach($block['results']->hits as $index => $result)
                        <div class="col-md-3 col-sm-4 {{ $index >= 3 ? 'hidden-sm' : null }}">
                            @include('v3.classes.class_block')
                        </div>
                   @endforeach
               </div>
           @endif
       @endforeach
       <div class="row visible-lg-block visible-md-block">
            @foreach($homepage['category_blocks'] as $style => $category)
                <div class="col-sm-4">
                    <div class="category-block {{$style == 0 ? 'pink'  : ($style == 1 ? 'yellow' : 'black') }}" style="background-image: url('{{url().$category['image']}}')">
                        <div class="mask"></div>
                        <div class="content">
                            <h3 class="text-white">{{ $category['title'] }}</h3>
                            <a href="{{$category['link']}}" class="btn {{$style == 0 ? 'btn-primary'  : ($style == 1 ? 'btn-warning' : 'btn-black') }} btn-rounded">View all classes ></a>
                        </div>
                    </div>
                </div>
            @endforeach
       </div>
    </div>
    @foreach($blocks as $block)
        @if(isset($block['background']))
            <div class="container-fluid sm-mt30 black-gradient-mask" style="background-image: url('{{url().$block['background']}}')">
                <div class="mask"></div>
                <div class="container mt15">
                    <div class="row">
                       <div class="col-sm-12">
                           <div class="page-header">
                               <div class="row">
                                    <div class="col-sm-9">
                                        <span class="text-white text-larger">{{ $block['title'] }}</span>
                                    </div>
                                    <div class="col-sm-3 text-right hidden-sm hidden-xs">
                                        <a class="view-all-btn" href="{{ $block['link'] }}">{{ $block['link_title'] }}</a>
                                    </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="row mt20 mb50">
                        @foreach($block['results']->hits as $index => $result)
                            <div class="col-md-3 col-sm-4 mb20 {{ $index >= 3 ? 'hidden-sm' : null }}">
                                @include('v3.classes.class_block')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <span class="text-primary text-larger">What are you looking for?</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="trapezium">
                <div id="row-1" class="col-sm-12 mb30">
                </div>
                @foreach($homepage['category_tags'] as $tag)
                    <div class="trapezium-item">
                        <a href="/uk/london?search={{$tag}}" class="btn btn-rounded btn-white-primary">{{$tag}}</a>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@stop