@extends('v3.layouts.master')
@section('body')


    @if($tester)
        {{ $tester }}
    @endif
    <div class="hero hero-nav-change black-gradient-mask" style="background-image: url('{{url().'/assets/img/home/banner-'.rand(1,6).'.jpg'}}');">
        <div class="mask"></div>
        <div class="jumbotron text-center">
            <h1 class="drop-shadow text-white"><span class="text-primary">PAY</span> AS YOU <span class="text-primary">GO</span> FITNESS</h1>
            <h2 class="text-white drop-shadow">NO MEMBERSHIPS <span class="text-primary dot"></span> 17,000+ CLASSES <span class="text-primary dot"></span> OVER 600 LOCATIONS</h2>
        </div>
    </div>
    <div class="container-fluid bg-dark-grey sm-mb0">
        <div class="container">
            <div class="row mt10 mb10 sm-inline-gutter visible-md-block visible-lg-block">
                {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                    <div class="mb0">
                        <div class="col-sm-6">
                            <div class="input-group">
                                  <div class="input-group-addon"><span class="icon icon-search"></span></div>
                                  {{ Form::text('search', NULL, ['class' => 'form-control', 'placeholder' => 'Search for Classes...', 'data-toggle' => "dropdown",  'autocomplete' => 'off']) }}
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
                                {{ Form::text('location', NULL, ['class' => 'form-control', 'placeholder' => 'Location', 'id' => 'location-auto-complete',  'autocomplete' => 'off']) }}
                                {{ Form::hidden('fullLocation', NULL) }}
                                <ul id="locaction-autocomplete" class="dropdown-menu category-select" >
                                    <li id="near-me" class="heading locator"><span class="icon icon-locator-pink-small"></span>Use my Current Location</li>
                                    <div class="autocomplete-content"></div>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            {{ Form::hidden('city', NULL) }}
                            {{ Form::submit('Find a class' , ['class' => 'btn btn-primary btn-block']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            <div class="row mt10 mb10 sm-inline-gutter visible-xs-block visible-sm-block">
                {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                    <div class="col-xs-9  col-sm-10">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="icon icon-search"></span></div>
                            {{ Form::text('search', NULL, ['class' => 'form-control input-lg', 'placeholder' => 'I am looking for....Running']) }}
                        </div>
                    </div>
                    <div class="col-xs-3  col-sm-2">
                        <div class="btn-find-me">
                            {{ Form::hidden('location', NULL ) }}
                            {{ Form::hidden('city', NULL) }}
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
                                    <a class="view-all-btn grey-link" href="{{ $block['link'] }}">{{ $block['link_title'] }}</a>
                                </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="row">
                   @foreach($block['results']->hits as $index => $result)
                        <div class="col-md-3 col-sm-4 {{ $index >= 3 ? 'hidden-sm' : NULL }}">
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
                                        <a class="view-all-btn text-white" href="{{ $block['link'] }}">{{ $block['link_title'] }}</a>
                                    </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="row mt20 mb50">
                        @foreach($block['results']->hits as $index => $result)
                            <div class="col-md-3 col-sm-4 mb20 {{ $index >= 3 ? 'hidden-sm' : NULL }}">
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
            <div class="col-sm-12 mb30">
                <div class="page-header text-center">
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
                        <a href="/uk/london?search={{$tag}}" class="btn btn-rounded btn-pill">{{$tag}}</a>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@stop