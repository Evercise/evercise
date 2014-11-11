@extends('v3.layouts.master')
@section('body')
    <div class="container first-container article">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1>{{ $article->title }}</h1>

                {{ $article->content }}
            </div>
        </div>
    </div>
@stop