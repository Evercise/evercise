@extends('admin.main')

@section('body')


{{ Form::open(['id' => 'manage_category', 'route' => 'admin.update_category', 'method' => 'post', 'form-control', 'files'=> true]) }}
{{ Form::hidden('id', (!empty($category->id) ? $category->id : 0)) }}

<div class="col-md-12">
    <div class="col-lg-9">
        <div class="form-group">
            <label>Title:</label>
            {{ Form::text('name', (!empty($category->name) ? $category->name : null), ['placeholder'=> 'Article title', 'class' => 'form-control', 'id'=>'title']) }}
        </div>
        <div class="form-group">
              <label>Main Content:</label>
              {{ Form::textarea('description', (!empty($category->description) ? $category->description : null), ['cols' => '30', 'rows'=> '4', 'placeholder'=> 'Main Content', 'class' => 'form-control', 'id'=>'wysiwg_editor']) }}
    
        </div>
        <div class="form-group">
              <label>Popular Subcategories:</label>
            {{ Form::select( 'popular_subcategories[]' , $subcategories,explode(',', $category->popular_subcategories), ['class'=>'popular', 'multiple'=>'multiple', 'style'=>'width:600px;background-color:#ccc']) }}
        </div>
        <div class="form-group">
              <label>Popular Classes:</label>
            {{ Form::select( 'popular_groups[]' , $groups, explode(',', $category->popular_classes), ['class'=>'popular', 'multiple'=>'multiple', 'style'=>'width:600px;background-color:#ccc']) }}
        </div>
        <div class="form-group">
        </div>
    
    </div>
</div>

<div class="col-md-12">
    {{ Form::submit('Save Changes' , array('class'=>'btn btn-sm btn-info')) }}
    {{ Form::close() }}
</div>

@stop