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

    <div class="container-fluid bg-dark-grey mb30">
        <div class="container">
            <div class="row mt10 mb10 sm-inline-gutter">
                {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                    <div class="mb0">
                        <div class="col-sm-6">
                            <div class="input-group">
                                  <div class="input-group-addon"><span class="icon icon-search"></span></div>
                                  {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search for Classes...']) }}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="icon icon-pointer"></span></div>
                                {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location', 'id' => 'location-auto-complete']) }}
                            </div>
                        </div>

                        <div class="col-sm-2">
                            {{ Form::hidden('city', null) }}
                            {{ Form::submit('Find a class' , ['class' => 'btn btn-primary btn-block']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="container">
       <div class="row mt50 mb10">
           <div class="col-sm-12">
                <strong class="text-primary text-larger">New this week</strong>
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
                <div class="category-block">
                    <h3 class="text-white">Martial arts</h3>
                    <a href="/" class="btn btn-primary btn-rounded">View all classes></a>
                </div>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
       </div>
    </div>
@stop