@extends('v3.layouts.master')
@section('body')


    <div class="col-lg-12">
    <br/>
    <br/>
    <br/>

    <h1>{{ $article->title }}</h1>

    {{ $article->content }}
    </div>

@stop