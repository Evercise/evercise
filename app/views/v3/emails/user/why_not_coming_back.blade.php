@extends('v3.emails.template')

@section('body')
    <p>Hey <span class="pink-text">{{isset($user->first_name) ? $user->first_name : $user->display_name }}</span></p>
    <p>We&apos;ve noticed that you haven&apos;t taken advantage of your introductory <span class="pink-text">&pound;5 Evercise balance</span> yet.</p>
    <p>Why not book your first <span class="pink-text">Evercise class</span> using your existing balance? It&apos;s easy to search for classes in your area and booking is as simple as ordering a pizza!</p>
    <p>Click on the link below to give it a whirl.</p>

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

    @include('v3.emails.classes_upsell', ['everciseGroups' => $everciseGroups, 'upsellText' => 'Looking for trendy fitness classes? We&apos;ve picked out a few popular classes you might enjoy.'])
@stop