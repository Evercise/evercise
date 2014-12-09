@extends('v3.emails.template')
<?php View::share('align', 'center') ?>

@section('body')
<p>Hey {{$trainer->display_name}}</p>
<p>Want to know the key to achieving <strong>50% more sales</strong> on Evercise?</p>
<p>It’s easy! The better your profile is more sales you’re likely to achieve.</p>
<p>Evercise is all about optimising the visibility of your fitness classes but once you’ve got people’s attention we want to make sure you achieve as many conversions as possible by making a great first impression.</p>
<p>Completing your Evercise profile is quick and easy so why not grab a few minutes and tell the world about yourself.</p>
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
                <br>
                <div class="text-center mb30">
                    {{ Html::linkRoute('users.edit', 'Get Started', [$trainer->display_name], ['class' => 'btn btn-blue']) }}
                </div>
            </div>

        </td>
    </tr>
</table>
@stop