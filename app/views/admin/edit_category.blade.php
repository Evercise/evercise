@extends('admin.main')


@section('body')

{{ Form::open(['id' => 'manage_article', 'method' => 'post', 'form-control', 'files'=> true]) }}
{{ Form::hidden('id', (!empty($category->id) ? $category->id : 0)) }}



<div class="col-md-12">
    <div class="col-lg-9">
        <div class="form-group">
            <label>Title:</label>
            {{ Form::text('title', (!empty($category->name) ? $category->name : null), ['placeholder'=> 'Article title', 'class' => 'form-control', 'id'=>'title']) }}
        </div>
        <div class="form-group">
              <label>Main Content:</label>
              {{ Form::textarea('content', (!empty($category->description) ? $category->description : null), ['cols' => '30', 'rows'=> '4', 'placeholder'=> 'Main Content', 'class' => 'form-control', 'id'=>'wysiwg_editor']) }}
    
        </div>
    
    </div>
</div>

@stop