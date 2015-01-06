@extends('v3.emails.template')

@section('body')
<p>Join <span class="blue-text">{{$referrerName}}</span> and discover Evercise - the flexible new Pay As You Go fitness community that fits in with your lifestyle and doesn&apos;t tie you down to an expensive gym membership.</p>
<p><span class="blue-text">{{$referrerName}}</span> has already discovered the benefits of Evercise, why not take a look yourself?</p>
<p>Sign up using the link below and we&apos;ll even add <span class="blue-text">&pound;5</span> to your Evercise balance to get started with.</p>
<p>The Evercise network gives you access to a huge choice of fun and flexible fitness classes wherever you are and our simple three-step process means it&apos;s quick and easy to sign up and get involved.</p>

@stop
@section('extra')
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="30" bgcolor="#ff1b7e">
        <tr width="100%">
            <td valign="top" width="33%">
                <div class="mb30">
                    {{ image('/assets/img/email/Search.jpg', 'search') }}
                </div>
            </td>
            <td width="67%">
                <h3 class="white-text">Search</h3>
                <p class="white-text">Evercise makes it easy to search your area and discover the perfect class for you. With classes covering everything from aerobics to zumba you&apos;re sure to find something nearby that takes your fancy.</p>
            </td>
        </tr>
    </table>
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="30" bgcolor="#ff1b7e">
        <tr width="100%">
            <td width="67%">
                <h3 class="white-text text-right">Select</h3>
                <p class="white-text text-right">You can see reviews of all our classes, find out more about the venue and facilities and ask the trainer any questions you might have. </p>
            </td>
            <td valign="top" width="33%">
                {{ image('/assets/img/email/Select.png', 'select') }}
            </td>
        </tr>
    </table>
    <table width="100%" height="auto" align="center" cellspacing="0" cellpadding="30" bgcolor="#ff1b7e">
        <tr width="100%">
            <td valign="top" width="33%">
                {{ image('/assets/img/email/Sign_Up.png', 'sign up') }}
            </td>
            <td width="67%">
                <h3 class="white-text">Sign up</h3>
                <p class="white-text">When you&apos;ve found a class you like the look of our simple Pay As You Go booking system ensures that joining your class is as quick and easy as ordering a pizza! </p>
            </td>
        </tr>
    </table>
@stop