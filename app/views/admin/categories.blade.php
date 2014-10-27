@extends('admin.main')

@section('css')
@stop

@section('script')

@stop

@section('body')

<div class="row">
    <div class="col-md-4">
        <select id="select_category_type" class="form-control">
            <option>categories</option>
            <option>subcategories</option>
        </select>
    </div>
</div>

<div class="row">
    <ul id="user_list">
        @foreach($categories as $key => $category)
            <p>{{$category->name}}</p>
        @endforeach
    </ul>
</div>


@stop