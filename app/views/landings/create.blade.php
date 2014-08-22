@extends('layouts.landingMaster')


@section('content')


<div class="row">

  <header class="ppc">
    <section class="logo">
      {{ HTML::image('/img/evercise_logo.png', 'evercise logo', array('class' => 'logo')); }}
    </section>
    <section class="strapline">
      <h1>{{trans('landing.header')}}</h1>
      <p>{{trans('landing.terms')}}</p>
    </section>
  </header>
  <div  class="sign-up">
    {{ Form::open(array('id' => 'send_ppc', 'url' => 'landings', 'method' => 'POST', 'class' => 'create-form milestone-form')) }}
            {{ Form::label( 'email', 'Email Address') }}
            {{ Form::hidden( 'category' , $category->id , array('id' => 'category')) }}
            {{ Form::text( 'email' , '', array('id' => 'email','placeholder' => 'example@domain.com')) }}
            {{ Form::submit('JOIN NOW' , array('class'=>'btn btn-black ')) }}
          {{ Form::close() }}

          <a href="URL()">

          {{ HTML::decode(HTML::linkRoute('ppc_fb.category', '<img src="'.url().'/img/facebook_logo.png" /> Log in with Facebook', $category->id , ['alt'=>"facebook icon", 'class' => 'btn btn-fb'] ) )}}
  </div>
  <div class="landing-body">
    <h2>{{trans('landing.bodyHeader')}}</h2>
    <aside>
      <p>{{trans('landing.whatIsEvercise')}}</p>
    </aside>
    <aside>
      <p>{{trans('landing.whyEvercise')}}</p>
    </aside>
  </div>

  <div class="landing-body grey">
    <h2>{{trans('landing.testimonialHeader')}}</h2>
     @foreach(trans('landing.testimonials') as $testimonial)
      <aside>
        <div class="testimonial-block">
          {{ HTML::image('img/'.$testimonial['image']) }}
          <strong>{{ $testimonial['name']}}</strong>
          <br>
          <i>{{ $testimonial['location']}}</i>
          <div class="content">
            <p>{{ $testimonial['content']}}</p>
          </div>
          
        </div>
      </aside>
    @endforeach
  </div>

<div class="footer-block">
  {{ HTML::linkRoute('static.terms_of_use', 'Terms of Use') }}
  {{ HTML::linkRoute('static.privacy', trans('footer.privacy_policy') ) }}
  <span>{{trans('footer.copyright')}}</span>
</div>
 
</div>

@stop

@include('layouts.laracasts')
@include('layouts.tracking')