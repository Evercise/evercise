@extends('v3.layouts.master')
@section('body')

    <div id="hero-carousel" class="carousel slide">
          <div class="carousel-inner">
            @foreach($slider as $index => $sl)

                 <div class="item {{ $index == 0 ? 'active': null }}">
                    <div class="hero hero-nav-change" style="background-image: url('{{url().'/files/slider/cover_'. $sl['image']}}')">
                       <ol class="carousel-indicators">
                           <li data-target="#hero-carousel" data-slide-to="{{$index}}" class="{{ $index == 0 ? 'active' : null }}"></li>
                       </ol>
                        <div class="jumbotron">
                          <div class="container text-center">
                            <h1 class="text-white"> {{ $sl['name'] }}</h1>
                            <h1 class="text-primary">only &pound; {{ round($sl['price'], 0) }}</h1>
                            <div class="row mt50 text-center">
                            {{ Html::linkRoute('evercisegroups.show', 'View Class', Evercisegroup::getSlug($sl['evercisegroup_id']) ,['class' => 'btn btn-primary']) }}
                            <!--
                                <div class="col-md-2 col-md-offset-4">
                                    <button class="btn btn-white btn-transparent mb10">Schedule<span class="icon icon-white-clock"></span></button>
                                </div>

                                <div class="col-md-3">


                                    <div class="btn-group">
                                        <button class="btn btn-primary">Join Class</button>
                                        <button type="button" class="btn btn-primary btn-aside" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                    </div>

                                </div>
                                -->
                            </div>
                          </div>
                        </div>
                    </div>
                 </div>
            @endforeach

          </div>
    </div>

    <div class="container-fluid panel-body bg-dark-grey">
        <div class="container">
            <div class="row no-gutter visible-md-block visible-lg-block">
                {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                    <div class="col-sm-12">
                        <div class="input-group with-addon">
                            <div class="input-group-addon first"><span class="icon icon-search"></span></div>
                            {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search for Classes...']) }}

                            <div class="input-group-addon"><span class="icon icon-pointer"></span> </div>
                            {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location', 'id' => 'location-auto-complete']) }}
                            {{ Form::hidden('city', null) }}
                            <div class="input-group-addon"><span class="icon icon-distance"></span></div>
                            <div class="custom-select">
                                {{ Form::select( 'distance' , array_flip(Config::get('evercise.radius')), (!empty($radius) ? $radius : Config::get('evercise.default_radius')), ['class' => 'form-control mr50']) }}
                            </div>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                     Find a Class
                                </button>
                            </span>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            <div class="row no-gutter hidden-md hidden-lg">
                {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                    <div class="col-sm-12">
                        <div class="input-group with-addon mb10">
                            <div class="input-group-addon first"><span class="icon icon-search"></span></div>
                            {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search for Classes...']) }}
                        </div>
                        <div class="input-group with-addon mb10">
                            <div class="input-group-addon"><span class="icon icon-pointer"></span> </div>
                            {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location', 'id' => 'location-auto-complete']) }}
                        </div>
                        <div class="input-group with-addon mb10">
                            <div class="input-group-addon"><span class="icon icon-distance"></span></div>
                            {{ Form::select( 'distance' , array_flip(Config::get('evercise.radius')), (!empty($radius) ? $radius : Config::get('evercise.default_radius')), ['class' => 'form-control mr50']) }}
                        </div>

                        <button class="btn btn-primary center-block md-btn-block" type="submit">
                             Find a Class
                        </button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt10">
            <div class="col-md-4 text-center">
                <div class="panel-body">
                    <div class="underline">
                        <h2>{{ Html::linkRoute('general.about', 'What is Evercise', null, ['class' => 'text-dark']) }}</h2>
                    </div>
                    <div class="home-assets">
                        {{ image('img/home/wie.png', 'what is evercise', ['class' => 'img-responsive center-block']) }}
                    </div>

                    <div class="caption">
                        <p>Evercise is the exciting new Pay As You Go fitness community that’s flexible enough to fit in with your modern lifestyle. Evercise unites talented trainers with an active community who want more fun and freedom from their fitness routine. </p>
                    </div>
                </div>

            </div>
            <div class="col-md-4 text-center">
                <div class="panel-body">
                    <div class="underline">
                        <h2>{{ Html::linkRoute('general.about', 'Why join Evercise', null, ['class' => 'text-dark']) }}</h2>
                    </div>
                    <div class="home-assets">
                        {{ image('img/home/wje.png', 'why join evercise', ['class' => 'img-responsive center-block']) }}
                    </div>
                    <div class="caption">
                         <p>We want fitness to be fun and flexible rather than routine and restricted. By bringing together trainers and a keen community of fitness enthusiasts Evercise really does benefit everyone. Evercise makes fitness fun again, emphasising social, group exercise that fits in with your life</p>
                    </div>
                </div>

            </div>
            <div class="col-md-4 text-center">
                <div class="panel-body">
                    <div class="underline">
                        <h2>{{ Html::linkRoute('general.about', 'How it works', null, ['class' => 'text-dark']) }}</h2>
                    </div>
                    <div class="home-assets">
                        {{ image('img/home/hiw.png', 'how it works', ['class' => 'img-responsive center-block']) }}
                    </div>
                    <div class="caption">
                         <p>Whether you’re a trainer or a participant Evercise is all about convenience. Once you’ve created an Evercise profile our smart platform helps trainers to find participants and participants to find their perfect class. All your booking and scheduling is done right here on Evercise.</p>
                    </div>
                </div>

            </div>

        <!--
            @foreach($articles as $a)
                <div class="col-sm-4 text-center">
                    <div class="panel-body">
                        <div class="underline">
                            <h2>{{ $a->title }}</h2>
                        </div>

                        {{ image($a->main_image, $a->title, ['class' => 'img-responsive']) }}
                        <div class="caption">
                            <p>{{ $a->intro }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        -->
        </div>
    </div>
    <div class="container-fluid bg-grey">
        <div class="container mt20">
            <div class="underline">
                 <h1 class="text-center">Featured Fitness Classes</h1>
            </div>
            <div class="row">

                <div id="image-carousel" class="carousel slide" data-interval="true">
                    <!-- Indicators -->
                      <ol class="carousel-indicators">
                        @if(count($featured->hits) > 3)
                            <?php $i = 0 ?>
                            @foreach($featured->hits as $index => $featured_class)

                                @if($index % 3 === 0)
                                    <li data-target="#image-carousel" data-slide-to="{{$i}}" class="{{ $index == 0 ? 'active' : null }}"></li>
                                    <?php $i++ ?>
                                @endif

                            @endforeach
                        @endif
                      </ol>
                      <div class="carousel-inner mb50">
                            <?php $i = 0 ?>
                            @foreach($featured->hits as $index => $featured_class)
                                @if($index % 3 === 0)
                                    {{ $index > 0 ? '</div></div>' : null }}
                                    <div class="item {{ $index === 0 ? 'active' : null }}">
                                    <?php $i++ ?>
                                    <div class="row">
                                @endif
                                      <div class="col-md-4">
                                         @include('v3.classes.class_module', ['class' => $featured_class])
                                     </div>

                                @if($index == count($featured->hits) -1 )
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                      </div>

                </div>
            </div>
        </div>
    </div>
@stop