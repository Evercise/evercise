@extends('v3.layouts.master')
@section('body')
{{ var_dump($featured) }}


    <div class="hero hero-nav-change">
        <div class="jumbotron">
          <div class="container text-center">
            <h1 class="text-white">spin class in king&apos;s cross</h1>
            <h1 class="text-primary">only &pound;5</h1>
            <div class="row mt50">
                <div class="col-md-2 col-md-offset-4">
                    <button class="btn btn-white btn-transparent mb10">Schedule<span class="icon icon-white-clock"></span></button>
                </div>
                <div class="col-md-2">
                    <div class="btn-group">
                        <button class="btn btn-primary">Join Class</button>
                        <button type="button" class="btn btn-primary btn-aside" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                    </div>
                </div>
            </div>


          </div>
        </div>
    </div>
    <div class="container-fluid panel-body bg-dark-grey">
        <div class="container">
            <div class="row no-gutter">
                {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                    <div class="col-sm-12">
                        <div class="input-group with-addon">
                            <div class="input-group-addon first"><span class="icon icon-search"></span></div>
                            {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search for Classes...']) }}

                            <div class="input-group-addon"><span class="icon icon-pointer"></span> </div>
                            {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location']) }}

                            <div class="input-group-addon"><span class="icon icon-distance"></span></div>
                            {{ Form::select( 'distance' , array_flip(Config::get('evercise.radius')), (!empty($radius) ? $radius : Config::get('evercise.default_radius')), ['class' => 'form-control mr50']) }}
                            <span class="input-group-btn">
                                <button class="btn btn-primary btn-block" type="submit">
                                     Find a Class
                                </button>
                            </span>
                        </div>


                    </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt10">
            <div class="col-sm-4 text-center">
                <div class="panel-body">
                    <div class="underline">
                        <h2>What is evercise</h2>
                    </div>

                    <img class="img-responsive" src="/assets/img/hero.jpg" alt="what is evercise">
                    <div class="caption">
                        <p>Evercise is the exciting new Pay As You Go fitness community that&apos;s flexible enough to fit in with your modern lifestyle. Evercise unites talented trainers with an active community who want more fun and flexibility from their fitness routine.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="panel-body">
                    <div class="underline">
                        <h2>Why join evercise</h2>
                    </div>

                    <img class="img-responsive" src="/assets/img/hero.jpg" alt="what is evercise">
                    <div class="caption">
                        <p>We want fitness to be fun and flexible rather than routine and restricted. By bringing together trainers and a keen community of fitness enthusiasts Evercise really does benefit everyone. Evercise makes fitness fun again, emphasising social, group-exercise that fits in with your life.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-center">
                <div class="panel-body">
                    <div class="underline">
                        <h2>How does it work</h2>
                    </div>

                    <img class="img-responsive" src="/assets/img/hero.jpg" alt="what is evercise">
                    <div class="caption">
                      <p>Whether you&apos;re a trainer or a participant Evercise is all about convenience. Once you’ve created an Evercise profile our smart platform helps trainers to find participants and participants to find their perfect class. All your booking and scheduling is done right here on Evercise.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-grey">
        <div class="container">
            <div class="underline">
                 <h1 class="text-center">Featured classes</h1>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    @include('v3.classes.class_module')
                </div>
                <div class="col-sm-4">
                    @include('v3.classes.class_module')
                </div>
                <div class="col-sm-4">
                    @include('v3.classes.class_module')
                </div>
            </div>
        </div>
    </div>
@stop