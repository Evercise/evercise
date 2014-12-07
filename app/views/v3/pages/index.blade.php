@extends('v3.layouts.master')
@section('body')
<div class="container first-container">
    <div class="row text-center">
        <div class="underline">
            <h1>{{ $title }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">

            <div class="list-group-accordion" id="accordion">

                <div class="panel panel-default">
                  <div class="list-group-item">
                      <a data-toggle="collapse" data-parent="#accordion" href="#categories" class="">Categories</a>
                  </div>
                  <div id="categories" class="panel-collapse collapse in">
                    <div class="list-group">
                        <li class="list-group-item bg-grey"><a href="#">cat 1</a> </li>
                        <li class="list-group-item bg-grey"><a href="#">cat 2</a> </li>
                        <li class="list-group-item bg-grey"><a href="#">cat 3</a> </li>
                        <li class="list-group-item bg-grey"><a href="#">cat 4</a> </li>
                        <li class="list-group-item bg-grey"><a href="#">cat 5</a> </li>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="list-group-item">
                      <a data-toggle="collapse" data-parent="#accordion" href="#posts" class="">posts</a>
                  </div>
                  <div id="posts" class="panel-collapse collapse">
                    <div class="list-group">
                        <li class="list-group-item bg-grey"><a href="#">cat 1</a> </li>
                        <li class="list-group-item bg-grey"><a href="#">cat 2</a> </li>
                        <li class="list-group-item bg-grey"><a href="#">cat 3</a> </li>
                        <li class="list-group-item bg-grey"><a href="#">cat 4</a> </li>
                        <li class="list-group-item bg-grey"><a href="#">cat 5</a> </li>
                  </div>
                </div>

              </div>
            </div>
            <!--
            <div class="list-group">
                @foreach($categories as $c)
                    {{ Html::link(url($c->permalink), $c->title, ['class'=>'list-group-item']) }}
                @endforeach
            </div>
            -->
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
@stop