@extends('v3.layouts.master')
@section('body')

    <div id="hero-carousel" class="carousel slide">
          <div class="carousel-inner">
            @foreach($slider as $index => $sl)
                 <div class="item {{ $index == 0 ? 'active': null }}">
                    <div class="hero hero-nav-change" style="background-image: url('{{url().'/files/slider/cover_'. $sl['image']}}')">
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
                                      <li><a href="judo">Judo</a></li>
                                      <li><a href="something bigger">something bigger</a></li>
                                  </ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="icon icon-pointer"></span></div>
                                {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location', 'id' => 'location-auto-complete' ]) }}

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
                            {{ Form::submit('' , ['class' => 'btn btn-primary btn-block btn-lg']) }}
                        </div>

                    </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="container">
       <div class="row">
           <div class="col-sm-12">
               <div class="page-header">
                   <div class="row">
                        <div class="col-sm-9">
                            <span class="text-primary text-larger">New this week</span>
                        </div>
                        <div class="col-sm-3 text-right hidden-sm hidden-xs">
                            <a class="view-all-btn" href="/">View all new this week</a>
                        </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="row">
            <div class="col-md-3">
                <ul class="list-group class-block ">
                    <li class="list-group-item class-img-wrapper">{{ image('/files/u/0/24/module_salsa-classdance-wise1.jpg', 'class image', ['class' => 'img-responsive']) }}</li>
                    <div class="class-body">
                        {{ image('/files/u/0/24/search_salsa-classdance-wise1.jpg', 'class image', ['class' => 'img-responsive']) }}
                        <li class="list-group-item text-center class-title">
                            <h4>Salsa is cool!</h4>
                            <p><span class="icon icon-pointer"></span>Croydon</p>
                        </li>
                        <li class="list-group-item class-footer">
                            <aside class="text-center"><strong class="text-primary">£89.99</strong></aside>
                            <aside class="btn-wrapper"><a href="/" class="btn btn-primary">View Class</a></aside>
                        </li>
                    </div>

                </ul>
            </div>
            <div class="col-md-3">
                <ul class="list-group class-block">
                    <li class="list-group-item class-img-wrapper">{{ image('/files/u/0/24/module_salsa-classdance-wise1.jpg') }}</li>
                    <li class="list-group-item text-center">
                        <h4>Salsa is cool!</h4>
                        <p>Croydon</p>
                    </li>
                    <li class="list-group-item class-footer">
                        <aside class="text-center"><strong class="text-primary">£89.99</strong></aside>
                        <aside class="btn-wrapper"><a href="/" class="btn btn-primary">View Class</a></aside>
                    </li>
                </ul>
            </div>
            <div class="col-sm-3">
                <ul class="list-group class-block">
                    <li class="list-group-item class-img-wrapper">{{ image('/files/u/0/24/module_salsa-classdance-wise1.jpg') }}</li>
                    <li class="list-group-item text-center">
                        <h4>Salsa is cool!</h4>
                        <p>Croydon</p>
                    </li>
                    <li class="list-group-item class-footer">
                        <aside class="text-center"><strong class="text-primary">£89.99</strong></aside>
                        <aside class="btn-wrapper"><a href="/" class="btn btn-primary">View Class</a></aside>
                    </li>
                </ul>
            </div>
            <div class="col-sm-3">
                <ul class="list-group class-block">
                    <li class="list-group-item class-img-wrapper">{{ image('/files/u/0/24/module_salsa-classdance-wise1.jpg') }}</li>
                    <li class="list-group-item text-center">
                        <h4>Salsa is cool!</h4>
                        <p>Croydon</p>
                    </li>
                    <li class="list-group-item class-footer">
                        <aside class="text-center"><strong class="text-primary">£89.99</strong></aside>
                        <aside class="btn-wrapper"><a href="/" class="btn btn-primary">View Class</a></aside>
                    </li>
                </ul>
            </div>
       </div>
       <div class="row">
          <div class="col-sm-12">
              <div class="page-header">
                  <div class="row">
                      <div class="col-sm-10">
                          <span class="text-primary text-larger">New this week</span>
                      </div>
                      <div class="col-sm-2 text-right">
                          <a class="view-all-btn" href="/">View all new this week</a>
                      </div>
                  </div>
              </div>
          </div>
       </div>
       <div class="row">
            <div class="col-sm-3">
                <ul class="list-group class-block">
                    <li class="list-group-item class-img-wrapper">{{ image('/files/u/0/24/module_salsa-classdance-wise1.jpg') }}</li>
                    <li class="list-group-item text-center">
                        <h4>Salsa is cool!</h4>
                        <p>Croydon</p>
                    </li>
                    <li class="list-group-item class-footer">
                        <aside class="text-center"><strong class="text-primary">£89.99</strong></aside>
                        <aside class="btn-wrapper"><a href="/" class="btn btn-primary">View Class</a></aside>
                    </li>
                </ul>
            </div>
            <div class="col-sm-3">
                <ul class="list-group class-block">
                    <li class="list-group-item class-img-wrapper">{{ image('/files/u/0/24/module_salsa-classdance-wise1.jpg') }}</li>
                    <li class="list-group-item text-center">
                        <h4>Salsa is cool!</h4>
                        <p>Croydon</p>
                    </li>
                    <li class="list-group-item class-footer">
                        <aside class="text-center"><strong class="text-primary">£89.99</strong></aside>
                        <aside class="btn-wrapper"><a href="/" class="btn btn-primary">View Class</a></aside>
                    </li>
                </ul>
            </div>
            <div class="col-sm-3">
                <ul class="list-group class-block">
                    <li class="list-group-item class-img-wrapper">{{ image('/files/u/0/24/module_salsa-classdance-wise1.jpg') }}</li>
                    <li class="list-group-item text-center">
                        <h4>Salsa is cool!</h4>
                        <p>Croydon</p>
                    </li>
                    <li class="list-group-item class-footer">
                        <aside class="text-center"><strong class="text-primary">£89.99</strong></aside>
                        <aside class="btn-wrapper"><a href="/" class="btn btn-primary">View Class</a></aside>
                    </li>
                </ul>
            </div>
            <div class="col-sm-3">
                <ul class="list-group class-block">
                    <li class="list-group-item class-img-wrapper">{{ image('/files/u/0/24/module_salsa-classdance-wise1.jpg') }}</li>
                    <li class="list-group-item text-center">
                        <h4>Salsa is cool!</h4>
                        <p>Croydon</p>
                    </li>
                    <li class="list-group-item class-footer">
                        <aside class="text-center"><strong class="text-primary">£89.99</strong></aside>
                        <aside class="btn-wrapper"><a href="/" class="btn btn-primary">View Class</a></aside>
                    </li>
                </ul>
            </div>
       </div>

       <div class="row">
            <div class="col-sm-4">
                <div class="category-block pink">
                    <div class="mask"></div>
                    <div class="content">
                        <h3 class="text-white">Martial arts</h3>
                        <a href="/" class="btn btn-primary btn-rounded">View all classes ></a>
                    </div>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="category-block yellow">
                    <div class="mask"></div>
                    <div class="content">
                        <h3 class="text-white">Martial arts</h3>
                        <a href="/" class="btn btn-primary btn-rounded">View all classes ></a>
                    </div>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="category-block black">
                    <div class="mask"></div>
                    <div class="content">
                        <h3 class="text-white">Martial arts</h3>
                        <a href="/" class="btn btn-primary btn-rounded">View all classes ></a>
                    </div>

                </div>
            </div>
       </div>
    </div>
    <div class="container-fluid black-gradient-mask" style="background-image: url('{{url().'/files/slider/cover_'. $sl['image']}}')">
        <div class="mask"></div>
        <div class="container mt15">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header">
                        <span class="text-white text-larger">Ten-Hut! Great Deals on Bootcamp Sessions</span>
                    </div>
                </div>
            </div>
            <div class="row mt20 mb50">
                <div class="col-sm-3 mb20">
                    <ul class="list-group class-block">
                        <li class="list-group-item class-img-wrapper">{{ image('/files/u/0/24/module_salsa-classdance-wise1.jpg') }}</li>
                        <li class="list-group-item text-center">
                            <h4>Salsa is cool!</h4>
                            <p>Croydon</p>
                        </li>
                        <li class="list-group-item class-footer">
                            <aside class="text-center"><strong class="text-primary">£89.99</strong></aside>
                            <aside class="btn-wrapper"><a href="/" class="btn btn-primary">View Class</a></aside>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
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
                    <div class="row"></div>
                </div>
                <a href="/" class="btn btn-rounded btn-white-primary">Line Dance</a>
                <a href="/" class="btn btn-rounded btn-white-primary">yoda</a>
                <a href="/" class="btn btn-rounded btn-white-primary">wate</a>
                <a href="/" class="btn btn-rounded btn-white-primary">watersaavag</a>
                <a href="/" class="btn btn-rounded btn-white-primary">wing</a>
                <a href="/" class="btn btn-rounded btn-white-primary">wadlipping</a>
                <a href="/" class="btn btn-rounded btn-white-primary">wate</a>
                <a href="/" class="btn btn-rounded btn-white-primary">watipping</a>
                <a href="/" class="btn btn-rounded btn-white-primary">water fliing</a>
                <a href="/" class="btn btn-rounded btn-white-primary">wing</a>
                <a href="/" class="btn btn-rounded btn-white-primary">water flippin fbdfg</a>
                <a href="/" class="btn btn-rounded btn-white-primary">water flg</a>
                <a href="/" class="btn btn-rounded btn-white-primary">water flippgdgd dgdfang</a>
                <a href="/" class="btn btn-rounded btn-white-primary">water flippng</a>
                <a href="/" class="btn btn-rounded btn-white-primary">water flipping</a>
                <a href="/" class="btn btn-rounded btn-white-primary">water fliputping</a>
                <a href="/" class="btn btn-rounded btn-white-primary">wate7ipping</a>

            </div>
        </div>
    </div>
@stop