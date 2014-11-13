@extends('v3.layouts.master')



@section('body')

{--
|| ARTICLE DATA ||
id
page
category_id
title
main_image
description
intro
keywords
content
permalink
template
status
published_on
created_at
updated_at


|| CATEGORY DATA ||
id
page
category_id
title
main_image
description
intro
keywords
content
permalink
template
status
published_on
created_at
updated_at

--}


    <h1>{{ $category->title }}</h1>



    @foreach($articles as $article)
        <div class="">
            <h2>{{ $article->title }}</h2>

            <img src="{{ URL::to($article->main_image)}}"/>


            {{ $article->intro }}

            {{  link_to(Articles::createUrl($article), 'Read More....', ['style' => 'color:#c00']) }}


        </div>
        <hr/>


    @endforeach
@stop