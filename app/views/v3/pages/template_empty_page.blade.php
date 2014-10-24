@extends('v3.layouts.master')
@section('body')
    <h2>{{ $article->title }}</h2>

    {{ $article->content }}
@stop