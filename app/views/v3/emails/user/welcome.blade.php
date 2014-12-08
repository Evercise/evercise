@extends('v3.emails.template')

@section('body')
<p>
Thank you for joining our community.
</p>
<p>
<span>Hi {{{ $user->first_name }}}.</span>
<br>
<br>
<span>You have just been connected with a network of great trainers and likeminded keep-fitters.</span>
<br>
<span>Evercise is an online network that gives everyone wanting to exercise access to fitness instructors and classes across London and soon the Uk.</span>
</p>
<p>
Thanks for joining Evercise!
</p>

@stop