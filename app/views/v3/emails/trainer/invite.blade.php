@extends('v3.emails.template')
<?php View::share('align', 'center') ?>

@section('body')

<p>Join <span class="blue-text">{{$referrerName}}</span> and discover why Evercise is set to revolutionise Pay As You Go Fitness.</p>
<p><span class="blue-text">{{$referrerName}}</span> has already discovered the benefits of Evercise, why not take a look yourself?</p>

<p><strong>What is Evercise?</strong></p>
<p>Evercise is an exciting new platform designed to help trainers maximise promotional reach, fill classes and generate more income. It&apos;s quick to join, easy to manage and absolutely FREE.</p>
<p>From Aerobics to Zumba, whatever your specialism Evercise will connect you to a growing community of eager participants. </p>
<p>Evercise is here to lead a fitness revolution and we want YOU to be part of it.</p>

<p><strong>Why Join Evercise?</strong></p>
<p>Evercise makes it easier for trainers to fill classes and helps everyone to discover fun new ways to keep fit.</p>
<p>Our platform gives users a simple, intuitive way to search for Evercise registered classes and personal trainers in their area. Then, once they&apos;ve found you, our simple Pay As You Go booking system ensures that joining your class is as quick and easy as ordering a pizza!</p>
<p>Evercise can help you to realise your potential as a professional trainer by improving your promotional reach and simplifying your booking process.</p>

<p><strong>Signing up as an Evercise trainer is quick and free so what are you waiting for! Just click on the Get Started button and find out for yourself what all the fuss is about!</strong></p>

@stop
@section('extra')
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
        <tr>
            <td>
                <br>
                <br>
                <div class="text-center mb30">
                    {{ Html::decode(Html::linkRoute('register', image('/assets/img/email/btns/btn_get_started_nobg.png', 'Join Evercise'), [], ['class' => 'btn btn-blue'])) }}
                </div>
            </td>
        </tr>
    </table>
@stop