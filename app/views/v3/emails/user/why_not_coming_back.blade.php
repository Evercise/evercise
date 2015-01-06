@extends('v3.emails.template')

@section('body')
    <p>Hey <span class="pink-text">{{isset($user->first_name) ? $user->first_name : $user->display_name }}</span></p>
    <p>We&apos;ve noticed that you haven’t taken advantage of your introductory <span class="pink-text">&pound;5 Evercise balance</span> yet.</p>
    <p>Why not book your first<span class="pink-text"> Evercise class</span> using your existing balance? It&apos;s easy to search for classes in your area and booking is as simple as ordering a pizza!</p>
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
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="30" bgcolor="#ffffff">
        <tr>
            <td>
                <p>Looking for something in your area? We&apos;ve picked out a few local classes you might enjoy.</p>
            </td>
        </tr>
    </table>
     <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="20" bgcolor="#ffffff">
        <tr>
            <td width="100%">
                <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="10" bgcolor="#ffffff">
                    <tr>
                        <td width="25%">
                            <!-- {{image($everciseGroups->user->directory.'/search_/'.$everciseGroups->image) }}-->
                            {{image('/files/u/59/62/search_strikelab-fitnesslondonwingchun51.jpg')}}
                        </td>
                        <td width="50%" valign="top">
                            <table width="100%" height="100%" align="center" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                <tr height="80px">
                                    <td width="100%">
                                        <strong>{{$everciseGroups->name}}</strong>
                                    </td>
                                </tr>
                                <tr height="30%">
                                    <td width="100%" valign="bottom">
                                        {{ image('assets/img/email/stars_0.png') }}
                                    </td>
                                </tr>
                            </table>

                        </td>
                        <td width="25%" align="right" valign="top">
                            <table width="100%" height="100%" align="right" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                <tr height="80px">
                                    <td width="100%" align="right">
                                        <strong class="pink-text">&pound;16</strong>
                                    </td>
                                </tr>
                                <tr height="30%">
                                    <td width="100%" valign="bottom" align="right">
                                        button
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>

            </td>

        </tr>
    </table>
@stop