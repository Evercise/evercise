@extends('v3.emails.template')



@section('body')

<strong>Hey <span class="pink-text">{{$trainer->display_name}}</span> </strong>
<p><span class="pink-text">{{$user->display_name}}</span> has joined your class</p>

@stop
@section('extra')

<table width="100%" height="auto" align="center" cellspacing="0" cellpadding="20" bgcolor="#f2f2f2">
    <tr>
        <td width="100%">
          @foreach($classes as $evercisegroupId => $sessionDetails)
          <?php $session = $sessionDetails['session']; $group = $session->evercisegroup; ?>
            <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="20" bgcolor="#ffffff">
                <tr>
                    <td width="100%" class="bottom-border">
                        <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="10" bgcolor="#ffffff">
                            <tr >
                                <td width="25%">
                                    <a href="{{route('class.show', $group->slug)}}">{{image($group->user->directory.'/search_'.$group->image) }}</a>
                                </td>
                                <td width="50%" valign="top">
                                    <table width="100%" height="100%" align="center" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                        <tr height="80px">
                                            <td width="100%">
                                                <a href="{{route('class.show', $group->slug)}}"><strong>{{$group->name}}</strong></a>
                                                <p>{{ date('M jS, g:ia', strtotime($session->date_time)) }}<br>{{ ucwords($group->venue->address) }}<br>{{ ucwords($group->venue->town) . ' ' . strtoupper($group->venue->postcode) }}</p>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td width="25%" align="right" valign="top">
                                    <table width="100%" height="100%" align="right" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                        <tr height="80px">
                                            <td width="100%" align="right">
                                                <strong class="pink-text"><b class="pink-text">&pound;{{$session->price}}</b></strong>
                                            </td>
                                        </tr>
                                        <tr height="30%">
                                            <td width="100%" valign="bottom" align="right">
                                                {{ Html::decode(Html::linkRoute('class.show', image('assets/img/email/view_class_button.png', 'view class', ['class' => 'img-original']), $group->slug)) }}
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>{{$user->display_name}} has booked {{ count($sessionDetails) }} ticket{{ count($sessionDetails) > 1 ? 's' : '' }}.  Booking codes are below.</p>
                        <table border="0" cellspacing="0" cellpadding="20" class="text-center">
                            <tr>
                      <?php $count=0 ?>
                      @foreach($sessionDetails['codes'] as $code)
                          @if($count%3 == 0)
                            </tr><tr>
                          @endif
                                <td class="p0" width="90">
                                    <table border="0" cellspacing="0" cellpadding="20" class="blue-rounded-box">
                                      <tr>
                                        <td background="{{URL::to('assets/img/email/blue_rounded_box.png')}}">
                                          <p><strong>{{ $code }}</strong></p>
                                        </td>
                                      </tr>
                                    </table>
                                </td>
                      <?php $count++ ?>
                      @endforeach
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
          @endforeach
        </td>
    </tr>
    <tr>
        <td class="text-center">
            {{ Html::decode(Html::linkRoute('trainer', image('/assets/img/email/btns/btn_manage_blue.png', 'Manage your class'), [], ['class' => 'btn btn-blue'])) }}
        </td>
    </tr>
 </table>


@stop