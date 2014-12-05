@extends('v3.layouts.master')



@section('body')
<div class="container first-container">
    <div class="row text-center">
        <div class="underline">
            <h1>{{ $category->title}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
           we should put the category list here
        </div>
        <div class="col-sm-8">
             @foreach($articles as $a)
                <div class="row" >
                    <div class="col-sm-4">
                        {{ (!empty($a->thumb_image) ? image($a->thumb_image, $a->thumb_image, ['class' => 'img-responsive']) : image('files/articles/default_thumb.jpg', 'Image soon', ['class' => 'img-responsive'])) }}
                    </div>
                    <div class="col-sm-8">
                        <h3>{{ $a->title }}</h3>
                        <p>{{ $a->intro }}</p>
                        <small>published on : {{ strtotime($a->published_on) != '-62169984000' ?  date('D dS Y',strtotime($a->published_on) ) :  date('D dS Y',strtotime($a->created_at) ) }}</small>
                        <br>
                        {{ Html::link(url(Articles::createUrl($a)), 'Read More...', ['class' => 'text-primary']) }}

                    </div>

                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>