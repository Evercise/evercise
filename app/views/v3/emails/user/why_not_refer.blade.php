@extends('v3.emails.template')

@section('body')
    <p>Hey <span class="blue-text">{{isset($user->first_name) ? $user->first_name : $user->display_name }}</span></p>
    <p>If you&apos;re enjoying your Evercise experience then why not share it with your <span class="blue-text">friends!</span></p>
    <p>Evercise is all about making <span class="blue-text">fitness fun and social</span> and many of our classes can be even more enjoyable and fulfilling if you share the experience with a few friends.</p>
    <p>It&apos;s good to share and we&apos;ll even sweeten the deal with a <b class="bluen-text">£5 reward</b>  for every referral!</p>
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