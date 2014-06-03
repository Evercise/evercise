@extends('layouts.master')


@section('content')
@include('layouts.pagetitle', array('title'=>'Contact us', 'subtitle'=>'There are several ways to get in contact depending on the nature of your enquiry.'))
    <div id="contact" class="center_col">

    	<h3>General enquiries</h3>
    	<br>
    	<p>please contact</p>
    	<p>Naseeim Bangura (participants) or Tanaïs Gustave (trainers)</p>
    	<p>Email: {{ HTML::mailto('contact@evercise.com') }}</p>
    	<p>Phone: +44(0)2072 537000</p>
    	<hr>

    	<h3>Careers</h3>
    	<br>
    	<p>please contact</p>
    	<p>Jie Sun</p>
    	<p>Email: {{ HTML::mailto('jie@evercise.com') }}</p>
    	<p>Phone: +44(0)2072 537000</p>
    	<hr>

    	<h3>Business collaboration</h3>
    	<br>
    	<p>please contact</p>
    	<p>Liqiang Fan</p>
    	<p>Email: {{ HTML::mailto('fan@evercise.com') }}</p>
    	<p>Phone: +44(0)2072 537000</p>

    </div>

@stop