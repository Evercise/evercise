@extends('v3.emails.template')


@section('body')

<p>Hey <span class="blue-text">{{$name}}</span></p>

<strong>Don&apos;t forget your upcoming class is coming up tomorrow</strong>

<p>Please try to arrive 15 minutes before the specified start time. Late arrivals can be rejected.</p>
<p>Remember to bring a water bottle, a towel or two and appropriate clothing.</p>

<p>Take note of your unique booking code{{count($bookingCodes) > 1 ? 's' : ''}}</p>

@foreach($bookingCodes as $code)
    <table border="0" cellspacing="0" cellpadding="20" width="100" class="blue-rounded-box">
      <tr>
        <td background="{{URL::to('assets\img\email\btns\blue_rounded_box.png')}}">
          <p><strong>{{ $code }}</strong></p>
        </td>
      </tr>
    </table>

@endforeach
<p>Your trainer will need this - along with another form of ID - to identify you.</p>

@stop
@section('extra')

<table width="100%" height="auto" align="center" cellspacing="0" cellpadding="20" bgcolor="#f2f2f2">

    <tr>
        <td width="100%">
            <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="10" bgcolor="#f2f2f2">
                <tr>
                    <td>
                        <p>Your classes:</p>
                    </td>
                </tr>
            </table>
            <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="10" bgcolor="#f2f2f2">
                <tr><td></td></tr>
            </table>
            <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="20" bgcolor="#ffffff">
                <tr>
                    <td width="100%" class="bottom-border">
                        <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="10" bgcolor="#ffffff">
                            <tr >
                                <td width="25%">
                                    {{image($group->user->directory.'/search_'.$group->image) }}
                                </td>
                                <td width="50%" valign="top">
                                    <table width="100%" height="100%" align="center" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                        <tr height="80px">
                                            <td width="100%">
                                                <strong>{{$group->name}}</strong>
                                                <p>{{ date('M jS, g:ia', strtotime($dateTime)) }}<br>{{ ucwords($group->venue->address) }}<br>{{ ucwords($group->venue->town) . ' ' . strtoupper($group->venue->postcode) }}</p>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td width="25%" align="right" valign="top">
                                    <table width="100%" height="100%" align="right" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                        <tr height="80px">
                                            <td width="100%" align="right">
                                                <strong class="pink-text"><b class="pink-text">&pound;{{$group->default_price}}</b></strong>
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
            </table>

            <p>Have fun!</p>
            <p>Fitness is even more fun with friends! Click on the links below to share this class.</p>

            <p>Share this class on:</p>
            <a class="blue-text" href="{{ Share::load(URL::to('class/'.$group->slug)  , $group->name)->facebook()  }}" target="_blank">{{image('/assets/img/email/btns/btn_fb.png', 'Facebook', ['class'=>'img-original'])}}</a>
            <a class="blue-text" href="{{ Share::load(URL::to('class/'.$group->slug)  , $group->name)->twitter()  }}" target="_blank">{{image('/assets/img/email/btns/btn_twitter.png', 'Twitter', ['class'=>'img-original'])}}</a>
            <a class="blue-text" href="{{ Share::load(URL::to('class/'.$group->slug)  , $group->name)->gplus()  }}" target="_blank">{{image('/assets/img/email/btns/btn_gplus.png', 'Google+', ['class'=>'img-original'])}}</a>

        </td>
    </tr>
 </table>

@stop