@extends('v3.emails.template')

@section('body')

<p>Hi <span class="pink-text">{{isset($user->first_name) ? $user->first_name : $user->display_name }}</span>it&apos;s been too long!</p>
<p>We&apos;re delighted you decided to join the Evercise Pay As You Go Fitness revolution and we&apos;d love to see a more of you!</p>
<p>We couldn&apos;t help but notice that it&apos;s been a while since you last visited Evercise. If there&apos;s anything we can help you with we&apos;re always eager to lend a hand and we&apos;d love to help you make the most of Evercise.</p>
<p>Trainers like you are the heart and soul of Evercise. We know there&apos;s a huge variety of talented trainers and inspirational fitness programs out there and we want everyone to discover just how many unique, fun and fabulous fitness opportunities are on their doorstep. Especially yours!</p>
<p>Evercise can help you to realise your potential as a professional trainer by improving your promotional reach, helping you to achieve more bookings and generate more income.</p>
<p>Why not start by creating your first class? We&apos;ve made the class creation process as simple and user-friendly as possible, just add classes to the calendar then edit details like time, price and duration and you&apos;re good to go!</p>

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