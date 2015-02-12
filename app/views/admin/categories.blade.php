@extends('admin.main')

@section('css')
    <style>
        #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
        #sortable li { margin: 10px 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
        #sortable li span { position: absolute; margin-left: -1.3em; }

        #cat-table td {width:300px;}

    </style>
@stop

@section('script')
  <script>

  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });

   $("#sortable").sortable({stop: function(event, ui) {
        console.log($("#sortable").sortable("toArray"));
        $('#order').val($("#sortable").sortable("toArray"));
  }});

  initPut('{"selector": "#update_categories"}');

  </script>
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

{{ Form::open(array('id' => 'update_categories', 'route' => 'admin.update_categories', 'method' => 'post', 'class' => '', 'style' => 'float:left;margin-right:5px')) }}
    {{ Form::hidden( 'order' , '', ['id' => 'order']) }}
    {{ Form::submit('Save Changes' , array('class'=>'btn btn-sm btn-info')) }}

<br>
<br>
<br>

<div class="row" id="category-list">
    <table id="cat-table" class="table-yuk table-categories">
        <thead>
            <tr class="table-header">
                <th>Category</th>
                <th>Visible</th>
                <th>Popular Categories</th>
                <th>Popular Groups</th>
                <th>Description</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody id="sortable">
            @foreach($cats as $category)
                <tr id="{{$category->id}}">
                    <td><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><p>{{$category->name}}</p></td>
                    <td><p>{{ Form::checkbox('visible_'.$category->id, '1', $category->visible, ['id'=>'visible_'.$category->id] )}}</p></td>
                    <td>{{$category->getPopularClassesString()}}</td>
                    <td>{{$category->getPopularSubcategoriesString()}}</td>
                    <td><p>{{$category->description}}</p></td>
                    <td><p><a  title="Edit" href="{{URL::route('admin.categories.manage', [$category->id]) }}"><span class="el-icon-edit bs_ttip" title="" data-original-title=".el-icon-edit"></span></a></p></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ Form::close() }}



@stop