@extends('v3.emails.template')

@section('body')
    <p><strong>No worries, it happens! Here&apos;s how to reset it.</strong></p>
    <p>Hi <span class="pink-text">{{ $user->first_name }}</span> </p>
    <p>Simply click the link below.</p>
@stop
@section('extra')
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
        <tr>
            <td>
                <br>
                <br>
                <div class="text-center mb30">
                    {{ Html::decode(Html::link($link_url , image('/assets/img/email/btns/btn_get_started.png', 'reset password'), ['class' => 'btn btn-blue'])) }}
                </div>
            </td>
        </tr>
    </table>
@stop