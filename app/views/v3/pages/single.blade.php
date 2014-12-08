@extends('v3.layouts.master')
@section('body')
<div class="container first-container article">
    <div class="row">


        @include('v3.pages.sidebar')


        <div class="col-sm-8">
            <div class="article-block">
                <h1>{{ $article->title }}</h1>
                {{ $article->content }}
            </div>
        </div>
    </div>




</div>

<?php
/**
    <div class="col-lg-12">
    <br/>
    <br/>
    <br/>



    {{ $article->content }}
    </div>

    <div class="col-lg-12">
<div id="disqus_thread"></div>
    <script type="text/javascript">
        var disqus_shortname = 'evercise'; // Required - Replace example with your forum shortname
        var disqus_identifier = 'page{{$article->id}}';
        var disqus_title = '{{$article->title}}';
        var disqus_url = '{{ Request::url()}}';

        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    </div>

**/
?>
@stop