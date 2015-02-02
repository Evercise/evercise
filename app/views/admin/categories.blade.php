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
        //console.log($("#sortable").sortable("toArray"));
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
{{ Form::close() }}

<br>
<br>
<br>

<div class="row" id="category-list">
    <table id="cat-table">
        <thead>
            <td><p>Category</p></td>
            <td><p>visible</p></td>
            <td><p>popular</p></td>
            <td><p>description</p></td>
            <td><p>options</p></td>
        </thead>
        <tbody id="sortable">
            @foreach($cats as $category)
                <tr>
                    <td><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><p>{{$category->name}}</p></td>
                    <td><p>{{ Form::checkbox('visible', $category->id, $category->visible )}}</p></td>
                    <td><p>{{$category->popular}}</p></td>
                    <td><p>{{$category->description}}</p></td>
                    <td><p><a  title="Edit" href=""><span class="el-icon-edit bs_ttip" title="" data-original-title=".el-icon-edit"></span></a></p></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



@stop