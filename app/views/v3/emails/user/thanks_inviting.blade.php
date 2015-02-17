@extends('v3.emails.template')

@section('body')

<p>Hey <span class="pink-text">{{$referrerName}}</span></p>
<p>Thanks for referring <span class="pink-text">{{$refereeEmail}}</span>!</p>
<p>As soon as they sign up we&apos;ll update your Evercise account with a <span class="pink-text">&pound;{{Config::get('values')['milestones']['referral']['reward']}}</span> reward, giving you <span class="pink-text">&pound;{{$balanceWithBonus}}</span> available to book new classes.</p>
<p>Why not visit Evercise to check out new classes in your area.</p>
@stop
@section('extra')
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="30" bgcolor="#ffffff">
        <tr>
            <td>
                <div class="text-center mb30">
                    {{ Html::decode(Html::linkRoute('evercisegroups.search', image('/assets/img/email/btns/btn_discover.png', 'Discover classes'), null, ['class' => 'btn btn-pink'])) }}
                </div>
            </td>
        </tr>
    </table>
@stop