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

     @include('v3.layouts.tracking')
</head>
@endif
<body>
    <div class="hero landing-header mt0" style="background-image: url('{{url().'/assets/img/landings/trainer_landing/bg.png'}}')">
        <div class="container mt15 pull-left">
            {{ Html::decode( Html::linkRoute('home', image('assets/img/strapline_logo.png', 'logo', ['class' => 'img-responsive']))) }}
        </div>
        <div class="jumbotron text-center">
            <h1 class="text-primary">Struggling to fill your classes?</h1>
            <p class="text-white mt20">Evercise can help you to realise your potential as a professional trainer<br> by connecting you to a growing community of eager participants <br>and simplifying your booking process.</p>
            {{ Form::open(['route' => 'landings.enquiry', 'method' => 'post',]) }}
                <div class="landing-form container mt50">
                    <div class="form-group">

                            <div class="input-wrapper person pull-left">
                                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required']) }}
                            </div>
                            <div class="input-wrapper email pull-left">
                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email Address', 'required']) }}
                                 @if ($errors->has('email'))
                                    {{ $errors->first('email')}}
                                @endif
                            </div>

                            {{ Form::submit('Send enquiry', ['class' => 'btn btn-primary']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
    <div class="container-fluid bg-dark-grey landing-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 sm-mb20">
                    {{ image('assets/img/landings/trainer_landing/classes_copie.png', 'fill your class', ['class' => 'img-responsive']) }}
                    <h4 class="text-white">Fill your classes</h4>
                    <ul class="text-white">
                        <li>Improve your promotional reach</li>
                        <li>Generate more income</li>
                    </ul>
                </div>
                <div class="col-sm-4 sm-mb20">
                    {{ image('assets/img/landings/trainer_landing/join_copie.png', 'free to join', ['class' => 'img-responsive']) }}

                    <h4 class="text-white">Free to join</h4>
                    <ul class="text-white">
                        <li>No hidden fees</li>
                        <li>No membership costs</li>
                    </ul>
                </div>
                <div class="col-sm-4 sm-mb20">
                    {{ image('assets/img/landings/trainer_landing/commission_copie.png', 'low commision', ['class' => 'img-responsive']) }}
                    <h4 class="text-white">only 10% commission</h4>
                    <ul class="text-white">
                        <li>Pay when you earn</li>
                        <li>Get paid within 3 days</li>
                    </ul>
                </div>

            </div>


        </div>
    </div>
    <div class="container">
         <div class="row mt30">
            <div class="col-sm-12">
                <h3>Dont just take our word for it...</h3>
            </div>
         </div>
         <div class="row mt30">
            <div class="col-sm-3">
                {{ image('assets/img/male.png', 'trainer image', ['class' => 'img-responsive img-circle']) }}
            </div>
            <div class="col-sm-9">
                <strong>Krystian</strong>
                <p class="text-primary">Thai Boxing instructor</p>
                <p>I have registered our classes with Evercise few months ago and my experience of the services provided by the management was very positive right from the beginning.
                   When I had problem with my computer and while trying to book my classes on the Evercise website, one phone call was enough to get extra support from Evercise management to schedule my classes for me.
                   We often keep in touch and I constantly receive  informations about new options to help my business running from Evercise. I found Evercise has a bunch of very energetic and helpful people.</p>
            </div>
         </div>
         <hr>
         <div class="row">
            <div class="col-sm-9 text-right">
                <strong>Go Mammoth</strong>
                <p class="text-primary">Fitness club</p>
                <p>A great concept you have there. Evercise is an excellent marketing partner for us.</p>
            </div>
            <div class="col-sm-3">
                {{ image('assets/img/male.png', 'trainer image', ['class' => 'img-responsive img-circle']) }}
            </div>
         </div>
         <hr>
         <div class="row mb40">
            <div class="col-sm-3">
                {{ image('assets/img/male.png', 'trainer image', ['class' => 'img-responsive img-circle']) }}
            </div>
            <div class="col-sm-9">
                <strong>Aqua Fit Pro</strong>
                <p class="text-primary">Aqua Cycling instrutor</p>
                <p>The team who took me through the whole process was professional, I felt I had great support and expertise when needed. Evercise is really easy to understand and manage. Also, not having to pay until I make money is a real plus.</p>
            </div>
         </div>
     </div>

    @include('v3.layouts.stripped_footer')

</body>