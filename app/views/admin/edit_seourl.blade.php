@extends('admin.main')

@section('body')


{{ Form::open(['id' => 'manage_seourl', 'route' => 'admin.update_seourl', 'method' => 'post', 'form-control', 'files'=> true]) }}
{{ Form::hidden('id', (!empty($seoUrl->id) ? $seoUrl->id : 0)) }}

<div class="col-md-12">
    <div class="col-lg-9">
        <div class="form-group">
            <label>Location:</label>
            {{ Form::text('location', (!empty($seoUrl->location) ? $seoUrl->location : null), ['placeholder'=> 'location', 'class' => 'form-control', 'id'=>'title']) }}
        </div>
        <div class="form-group">
            <label>Search:</label>
            {{ Form::text('search', (!empty($seoUrl->search) ? $seoUrl->search : null), ['placeholder'=> 'search', 'class' => 'form-control', 'id'=>'title']) }}
        </div>
        <div class="form-group">
            <label>Title:</label>
            {{ Form::text('title', (!empty($seoUrl->title) ? $seoUrl->title : null), ['placeholder'=> 'title', 'class' => 'form-control', 'id'=>'title']) }}
        </div>
        <div class="form-group">
            <label>Description:</label>
            {{ Form::text('description', (!empty($seoUrl->description) ? $seoUrl->description : null), ['placeholder'=> 'description', 'class' => 'form-control', 'id'=>'title']) }}
        </div>

    </div>
</div>

<div class="col-md-12">
    {{ Form::submit('Save Changes' , array('class'=>'btn btn-sm btn-info')) }}
    {{ Form::close() }}
</div>

@stop