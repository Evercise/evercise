<table width="100%" height="auto" align="center" cellspacing="0" cellpadding="20" bgcolor="#f2f2f2">

    <tr>
        <td width="100%">
            <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="10" bgcolor="#f2f2f2">
                <tr>
                    <td>
                        @if(isset($upsellText))
                            <p>{{$upsellText}}</p>
                        @else
                            <p>Looking for something in your area? We&apos;ve picked out a few local classes you might enjoy.</p>
                        @endif
                    </td>
                </tr>
            </table>
            <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="10" bgcolor="#f2f2f2">
                <tr><td></td></tr>
            </table>
            @foreach($everciseGroups as $index => $everciseGroup)
            <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="20" bgcolor="#ffffff">
                <tr>
                    <td width="100%" class="bottom-border">
                        <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="10" bgcolor="#ffffff">
                            <tr >
                                <td width="25%">
                                    {{image($everciseGroup->user->directory.'/search_'.$everciseGroup->image) }}
                                </td>
                                <td width="50%" valign="top">
                                    <table width="100%" height="100%" align="center" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                        <tr height="80px">
                                            <td width="100%">
                                                <strong>{{$everciseGroup->name}}</strong>
                                            </td>
                                        </tr>
                                        <tr height="30%">
                                            <td width="100%" valign="bottom">

                                                {{-- image('assets/img/email/stars-'.$rating.'.png', 'class rating', ['class' => 'img-original']) --}}
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td width="25%" align="right" valign="top">
                                    <table width="100%" height="100%" align="right" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                        <tr height="80px">
                                            <td width="100%" align="right">
                                                <strong class="pink-text"><b class="pink-text">&pound;{{$everciseGroup->default_price}}</b></strong>
                                            </td>
                                        </tr>
                                        <tr height="30%">
                                            <td width="100%" valign="bottom" align="right">
                                                {{ Html::decode(Html::linkRoute('class.show', image('assets/img/email/view_class_button.png', 'view class', ['class' => 'img-original']), $everciseGroup->slug)) }}
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            @endforeach
            
        </td>
    </tr>
 </table>