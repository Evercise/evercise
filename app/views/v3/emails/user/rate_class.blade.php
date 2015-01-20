@extends('v3.emails.template')

@section('body')
    <p>Hey <span class="pink-text">{{isset($user->first_name) ? $user->first_name : $user->display_name }}</span></p>
    <p>We hope you enjoyed your latest class? Why not take a moment to share your experience by leaving a review.</p>
    <p>Sharing your thoughts with the Evercise community is a great way to enhance  everyone&apos;s Evericse experience and help trainers to improve their service.</p>

@stop