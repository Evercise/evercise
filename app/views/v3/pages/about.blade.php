@extends('v3.layouts.master')
<?php
    View::share('title', 'Know about Evercise Fitness Trainers Community');
    View::share('metaDescription', ' Evercise is the exciting new Pay As You Go fitness community. Evercise unites talented trainers for who want more fun and flexibility from their fitness routine.')
?>
@section('body')
<div class="container first-container">
    <div class="row mb40">
        <div class="col-sm-4">
            <ul id="scroll-to" class="list-group list-group-no-border">
                <li class="list-group-item">
                     <a class="" href="#what">What is Evercise<span href="#what" class="icon icon-grey-right-arrow pull-right mt5 hover"></span></a>
                </li>
                <li class="list-group-item">
                     <a class="" href="#why">Why Join Evercise<span href="#why" class="icon icon-grey-right-arrow pull-right mt5 hover"></span></a>
                </li>
                <li class="list-group-item">
                     <a class="" href="#how">How it works<span href="#how" class="icon icon-grey-right-arrow pull-right mt5 hover"></span></a>
                </li>
            </ul>

        </div>
        <div class="col-sm-7 col-sm-offset-1">
            <div id="what">
                 <h1 class="mb25"><a name="what"></a>What is evercise?</h1>
                 <p>Evercise is the exciting new Pay As You Go fitness community that’s flexible enough to fit in with modern lifestyles. Evercise unites talented trainers with an active community who want more fun and flexibility from their fitness routine.</p>
                 <p>The Evercise network offers access to a huge array of fun and effective fitness classes and our simple three-step process means it’s a doddle to sign up and get involved.</p>
                 <p>If you’re a trainer Evercise has the power to put you on the map. Sign up to instantly boost you online visibility and market yourself to our growing community. Evercise also gives trainers a smart, intuitive platform to manage bookings and money with as little hassle as possible.</p>
            </div>
            <div id="why">
                 <h1 class="mb25"><a name="why"></a>Why join evercise?</h1>
                 <p>Evercise transforms the fitness landscape, empowering trainers and liberating our community from the expensive limitations of gym membership. We want fitness to be fun and flexible rather than routine and restricted. By bringing together trainers and a keen community of fitness enthusiasts Evercise really does benefit everyone.</p>
            </div>
            <div id="how">
                 <h1 class="mb25"><a name="how"></a>How it works</h1>
                 <p>Convenience is key to the Evercise experience so we’ve made sure signing up and getting started is quick and hassle-free. Whether you’re a trainer or a participant you’ll be up and running on Evercise in no time.</p>

                 <div class="how-it-work-trainer mt15">
                    <strong class="large">Trainer</strong>
                    <div class="mt50 mb50">
                        {{ image('assets/img/screenshots/1.signuptrainer.png', 'sign up a atrainer', ['class'=>'img-responsive center-block']) }}
                    </div>
                    <b>1. Sign up</b>
                    <p>Evercise allows you to create a unique profile with the minimum of fuss.</p>
                    <div class="mt50 mb50">
                        {{ image('assets/img/screenshots/2Createaclass.png', 'create a class', ['class'=>'img-responsive center-block']) }}
                    </div>
                    <b>2. Create a class</b>
                    <p>Once you’ve set up your profile you can start to list your classes. Evercise gives you the tools to make your class stand out from the crowd.</p>
                    <div class="mt50 mb50">
                        {{ image('assets/img/screenshots/3.Train.png', 'train', ['class'=>'img-responsive center-block']) }}
                    </div>
                    <b>3. Train</b>
                    <p>The main event! Evercise aims to help you fill your classes and spend more time doing what you do best – train!</p>
                    <div class="mt50 mb50">
                        {{ image('assets/img/screenshots/4.Withdraw.png', 'screen shot', ['class'=>'img-responsive center-block']) }}
                    </div>
                    <b>4. Withdraw your money</b>
                    <p>Managing your Evercise account couldn’t be easier. Evercise makes the whole process - from handling bookings to collecting your payment – effortless.</p>

                 </div>
                 <div class="how-it-work-user mt50">
                     <strong class="large">Participant</strong>
                     <div class="mt50 mb50">
                         {{ image('assets/img/screenshots/usersignup.png', 'sign up participants', ['class'=>'img-responsive center-block']) }}
                     </div>
                     <b>1. Sign up</b>
                     <p>It’s quick and easy to create an Evercise profile.</p>
                     <div class="mt50 mb50">
                         {{ image('assets/img/screenshots/lookforclass.png', 'look for a class', ['class'=>'img-responsive center-block']) }}
                     </div>
                     <b>2. Find a class</b>
                     <p>Discovering exciting new fitness classes in your area is easy. Evercise allows you to search your area and discover the perfect class for you. With classes covering everything from aerobics to zumba you’re sure to find something nearby that takes your fancy.</p>
                     <div class="mt50 mb50">
                         {{ image('assets/img/screenshots/3.bookaclass.png', 'book a class', ['class'=>'img-responsive center-block']) }}
                     </div>
                     <b>3. Book class</b>
                     <p>When you’ve found a class you like the look of our simple Pay As You Go booking system allows you to complete your booking in just three clicks.</p>
                     <div class="mt50 mb50">
                         {{ image('assets/img/screenshots/4.GetActive.png', 'screen shot', ['class'=>'img-responsive center-block']) }}
                     </div>
                     <b>4. Get active!</b>

                 </div>
            </div>
        </div>

    </div>
</div>
@stop