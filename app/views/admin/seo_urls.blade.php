@extends('admin.main')

@section('css')
@stop

@section('script')
    <script>

        var newEntries = 0;

        $( document ).ready( function(){

            $('.new_entry').on('click',function() {

                console.log(newEntries);

                $('.table-seourls tbody').append('<tr>' +
                '<td><input name="location_new_'+newEntries+'" type="text" value=""></td>' +
                '<td><input name="search_new_'+newEntries+'" type="text" value=""></td>' +
                '<td><input name="title_new_'+newEntries+'" type="text" value=""></td>' +
                '<td><input name="description_new_'+newEntries+'" type="text" value=""></td>' +
                '</tr>');

                newEntries++;
            });
        });

    </script>


@stop


@section('body')

<div class="row" id="category_list">
    <br>
    {{ Form::open(array('id' => 'edit_subcategories', 'route' => 'admin.edit_subcategories', 'method' => 'post', 'class' => '')) }}
    {{ Form::hidden('update_categories', NULL, ['id'=>'update_categories'] )}}
    {{ Form::hidden('update_associations', NULL, ['id'=>'update_associations'] )}}
    {{ Form::submit('Save changes' , array('class'=>'btn')) }}
    <br>
    <br>
    <table class="table-yuk table-seourls">
        <thead>
            <tr class="table-header">
                <th>Location</th>
                <th>Search</th>
                <th>Title</th>
                <th>Description</th>
            </tr>
        </thead>
        @foreach($seourls as $url)
            <tr data-subid="{{$url->id}}" class="sub_{{ $url->id}}">
                <td>{{Form::text('location_'.$url->id, $url->location, [])}}</td>
                <td>{{Form::text('search_'.$url->id, $url->search, [])}}</td>
                <td>{{Form::text('title_'.$url->id, $url->title, [])}}</td>
                <td>{{Form::text('description_'.$url->id, $url->description, [])}}</td>
            </tr>
        @endforeach
    </table>
    <span class="new_entry btn"  style="color:#c00;padding:4px" title="" >Add new entry</span>
    <br>
    <br>
    <br>
    {{ Form::submit('Save changes' , ['class'=>'btn']) }}
    {{ Form::close() }}
    <br>
</div>

@stop