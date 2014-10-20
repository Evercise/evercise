@extends('v3.layouts.master')
@section('body')
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
                            <select name="radius" class="form-control mr50">
                              <option>Distance</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
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
                      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu</p>
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
                      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu</p>
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
                      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu</p>
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