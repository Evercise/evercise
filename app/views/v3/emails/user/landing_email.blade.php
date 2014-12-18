@extends('v3.emails.template')

@section('body')
<strong>Thanks for taking an interest in Evercise!</strong>
<p>Evercise is a fun new Pay As You Go fitness community that’s flexible enough to fit in with your life.</p>
<br>
<strong>Why join Evercise</strong>
<p>Evercise is everything old-school gym membership isn’t: It&apos;s flexible, sociable and a great way to freshen up your fitness routine.</p>

<strong>Find new fitness challenges.</strong>
<p>Explore our huge network and discover your perfect fitness class.</p>

<strong>Make new friends and get fit the fun way.</strong>
<p>The Evercise community is about getting active, getting social and getting fit together.</p>

@stop
@section('extra')
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="30" bgcolor="#ffffff">
        <tr>
            <td align="center">
                <h3 class="pink-text">Join today and grab &pound;10!</h3>
                <p>Claim &pound;5 straight away then double your money by referring a friend. </p>
                {{ Html::decode( Html::linkRoute('landing.category.code', image('assets/img/email/btns/btn_claim.png', 'claim your offer'), [$categoryId, $ppcCode], ['class' => 'btn btn-pink']) )  }}
            </td>
        </tr>
    </table>
@stop