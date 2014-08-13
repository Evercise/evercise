@extends('layouts.master')


@section('content')
@include('layouts.pagetitle', array('title'=>trans('class_guidelines.title'), 'subtitle'=>trans('class_guidelines.subtitle')))
    <div id="guidelines" class="center_col">
      {{trans('class_guidelines.page_content')}}
    </div>
@stop