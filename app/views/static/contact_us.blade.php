@extends('layouts.master')


@section('content')
@include('layouts.pagetitle', array('title'=>trans('contact_us.title'), 'subtitle'=>trans('contact_us.subtitle')))
    <div class="row"> 
        <div id="contact" class="col4 push4 tc">

        	<h3>{{trans('contact_us.general_title')}}</h3>
        	<br>
        	<p>{{trans('contact_us.please_contact')}}</p>
        	<p>{{trans('contact_us.general_contact')}}</p>
        	<p>Email: {{ HTML::mailto(trans('contact_us.general_email')) }}</p>
            <p>Phone: {{trans('contact_us.general_phone')}}</p>
            <br>
        	<hr>
            <br>
        	<h3>{{trans('contact_us.careers_title')}}</h3>
        	<br>
        	<p>{{trans('contact_us.please_contact')}}</p>
        	<p>{{trans('contact_us.careers_contact')}}</p>
        	<p>Email: {{ HTML::mailto(trans('contact_us.careers_email')) }}</p>
            <p>Phone: {{trans('contact_us.careers_phone')}}</p>
            <br>
        	<hr>
            <br>
        	<h3>{{trans('contact_us.business_title')}}</h3>
        	<br>
        	<p>{{trans('contact_us.please_contact')}}</p>
        	<p>{{trans('contact_us.business_contact')}}</p>
        	<p>Email: {{ HTML::mailto(trans('contact_us.business_email')) }}</p>
        	<p>Phone: {{trans('contact_us.business_phone')}}</p>

        </div>
    </div>
@stop