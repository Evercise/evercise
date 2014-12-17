@if(!isset($single))
<!DOCTYPE html>
<html>
<head>
    <title>{{ isset($title)? $title : 'Everyone exercise'}}</title>
    <meta name="description" content="{{ isset($description)? $description : 'Lower your barrier to enjoy fitness classes, Flexible schedule and multiple options across London.'}}">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta charset="UTF-8">
    <meta name="language" content="en-UK" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {{ HTML::style('assets/css/main.min.css?vs='.$version) }}
</head>
@endif
<body>
    <div class="hero landing-header mt0" style="background-image: url('{{url().'/assets/img/hero.jpg'}}')">
        <div class="container mt15 pull-left">
            {{ Html::decode( Html::linkRoute('home', image('assets/img/strapline_logo.png', 'logo', ['class' => 'img-responsive']))) }}
        </div>

        <div class="jumbotron text-center">
            <h1 class="text-primary">Get up to £10</h1>
            <h2 class="text-white">For your first {cat} class</h2>
            <h3 class="text-info">{ # of sessions} Classes to choose from</h3>
            {{ Form::open(['route' => 'home', 'method' => 'post',]) }}
                <div class="landing-form container">
                    <div class="form-group">
                            <div class="input-wrapper email">
                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email Address']) }}
                            </div>
                            <div class="input-wrapper location">
                                {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Preferred Location']) }}
                            </div>

                            {{ Form::submit('Claim the offer', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
    <div class="container-fluid bg-dark-grey landing-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 sm-mb20">
                    {{ image('assets/img/what_icon.png', 'what is evercise', ['class' => 'img-responsive']) }}
                    <h4 class="text-white">What is Evercise?</h4>
                    <p class="text-white">Pay as You go fitness access to a huge array of fitness classes</p>
                </div>
                <div class="col-sm-4 sm-mb20">
                    {{ image('assets/img/why_icon.png', 'what is evercise', ['class' => 'img-responsive']) }}

                    <h4 class="text-white">Why join evercise?</h4>
                    <p class="text-white">Fun and flexible quick and easy to sign up</p>
                </div>
                <div class="col-sm-4 sm-mb20">
                    {{ image('assets/img/how_icon.png', 'what is evercise', ['class' => 'img-responsive']) }}
                    <h4 class="text-white">How does it work?</h4>
                    <p class="text-white">Discover exiting {cat} classes find something nearby</p>
                </div>

            </div>


        </div>
    </div>
    <div class="container">
         <div class="row mt30">
            <div class="col-sm-6">
                <ul class="list-group landing-list">
                    <li class="list-group-item list-group-item-full-width">
                        {{ image('/assets/img/hero.jpg', 'what is evercise', ['class' => 'img-responsive']) }}
                    </li>
                    <li class="list-group-item">
                        <h4 class="text-center">Bootcamp</h4>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-4"><strong class="text-primary">from £90</strong></div>
                            <div class="col-sm-4 text-center"><h4>12345 classes</h4></div>
                            <div class="col-sm-4">{{ Html::linkRoute('home','Discover', null, ['class' => 'btn btn-default btn-sm btn-block']) }}</div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6">
                <ul class="list-group landing-list">
                    <li class="list-group-item list-group-item-full-width">
                        {{ image('/assets/img/hero.jpg', 'what is evercise', ['class' => 'img-responsive']) }}
                    </li>
                    <li class="list-group-item">
                        <h4 class="text-center">Bootcamp</h4>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-4 sm-text-center"><strong class="text-primary">from £90</strong></div>
                            <div class="col-sm-4 text-center"><h4>12345 classes</h4></div>
                            <div class="col-sm-4">{{ Html::linkRoute('home','Discover', null, ['class' => 'btn btn-default btn-sm btn-block']) }}</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-xs-6">
                        <ul class="list-group landing-list">
                            <li class="list-group-item list-group-item-full-width">
                                {{ image('/assets/img/hero.jpg', 'what is evercise', ['class' => 'img-responsive']) }}
                            </li>
                            <li class="list-group-item">
                                <h4 class="text-center">Bootcamp</h4>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6"><strong class="text-primary">from £90</strong></div>
                                    <div class="col-sm-6">{{ Html::linkRoute('home','Discover', null, ['class' => 'btn btn-default btn-sm btn-block']) }}</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6">
                        <ul class="list-group landing-list">
                            <li class="list-group-item list-group-item-full-width">
                                {{ image('/assets/img/hero.jpg', 'what is evercise', ['class' => 'img-responsive']) }}
                            </li>
                            <li class="list-group-item">
                                <h4 class="text-center">Bootcamp</h4>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-6"><strong class="text-primary">from £90</strong></div>
                                    <div class="col-sm-6">{{ Html::linkRoute('home','Discover', null, ['class' => 'btn btn-default btn-sm btn-block']) }}</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-xs-6">
                            <ul class="list-group landing-list">
                                <li class="list-group-item list-group-item-full-width">
                                    {{ image('/assets/img/hero.jpg', 'what is evercise', ['class' => 'img-responsive']) }}
                                </li>
                                <li class="list-group-item">
                                    <h4 class="text-center">Bootcamp</h4>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-6"><strong class="text-primary">from £90</strong></div>
                                        <div class="col-sm-6">{{ Html::linkRoute('home','Discover', null, ['class' => 'btn btn-default btn-sm btn-block']) }}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-6">
                            <ul class="list-group landing-list">
                                <li class="list-group-item list-group-item-full-width">
                                    {{ image('/assets/img/hero.jpg', 'what is evercise', ['class' => 'img-responsive']) }}
                                </li>
                                <li class="list-group-item">
                                    <h4 class="text-center">Bootcamp</h4>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-6"><strong class="text-primary">from £90</strong></div>
                                        <div class="col-sm-6">{{ Html::linkRoute('home','Discover', null, ['class' => 'btn btn-default btn-sm btn-block']) }}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>