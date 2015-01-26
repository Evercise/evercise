@extends('v3.emails.template')
<?php View::share('align', 'center') ?>

@section('body')
<p>Hey {{$trainer->display_name}}</p>
<p>We&apos;re delighted you&apos;ve decided to join the Evercise Pay As You Go Fitness revolution! All you need to do now is create your first class.</p>
<p>Evercise makes it easy to create and edit classes so if you&apos;ve got a class why not set it up and see how Evercise can help to promote it.</p>
<p>With Evercise your class will reach a wide base of users looking for exciting new fitness classes just like yours. It&apos;s a great way to boost your visibility, fill classes and generate more income.</p>
<p>We&apos;ve made the class creation process as simple and user-friendly as possible, just add classes to the calendar then edit details like time, price and duration and you&apos;re good to go!</p>

@stop
@section('extra')
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
        <tr>
            <td>
                <br>
                <br>
                <div class="text-center mb30">
                    {{ Html::decode(Html::linkRoute('evercisegroups.create', image('/assets/img/email/btns/btn_create_blue.png', 'Create your first class'), null, ['class' => 'btn btn-blue'])) }}
                </div>
            </td>
        </tr>
    </table>
@stop