@extends('v3.emails.template')

@section('body')
<h1>Welcome to Evercise!</h1>
<p>We’re delighted you’ve decided to join the Evercise Pay As You Go Fitness revolution and we reckon you’ll be just as thrilled with what Evercise can do for you.</p>
<p>Trainers are the heart and soul of Evercise. We know there’s a huge variety of talented trainers and inspirational fitness programs out there and we want everyone to discover just how many unique, fun and fabulous fitness opportunities are on their doorstep. Especially yours!</p>
<p>All you need to do now is set up your profile and start enjoying the benefits of Evercise.</p>
@stop
@section('extra')
<table width="640" height="auto" align="center" cellspacing="0" cellpadding="0" bgcolor="#ff1b7e">
    <tr>
        <td align="center">
            <h1 class="white-text">How to use Evercise</h1>
        </td>
    </tr>
    <tr>
        <td>
            <div class="container">
                <div class="mb30">
                    <div class="image-left">
                        {{ image('/img/home/wie.png') }}
                    </div>
                    <h3 class="white-text">Set up your Profile.</h3>
                    <p class="white-text">Just click on the Get Started button below and we’ll guide you through the process of setting up your unique Evercise Profile.</p>
                </div>
                <div class="mb30">
                    <div class="image-right">
                        {{ image('/img/home/wie.png') }}
                    </div>

                    <h3 class="white-text">Add classes.</h3>
                    <p class="white-text">Once you’ve set up your profile you can start to list your classes.</p>
                </div>
                <div class="mb30">
                    <div class="image-left">
                        {{ image('/img/home/wie.png') }}
                    </div>
                    <h3 class="white-text">Manage your account.</h3>
                    <p class="white-text">Once you’re up and running Evercise makes it easy to manage your account manage bookings, gain insights into the progress and success of your classes and withdraw money quickly and easily.</p>
                </div>
                <br>
                <br>
                <div class="text-center mb30">
                    {{ Html::linkRoute('evercisegroups.search', 'Get Started', null, ['class' => 'btn btn-blue']) }}
                </div>
            </div>

        </td>
    </tr>
</table>
@stop