@extends('admin.main')

@section('css')
    <style>
        #seo-table td {width:300px;}

    </style>
@stop

@section('script')
    <script>

        function deleteIt(id){

            currentRequest = $.ajax({
                type: "DELETE",
                url: AJAX_URL + "seourls/delete",
                cache: false,
                dataType: 'json',
                data: 'id='+id,
                beforeSend: function (json) {
                    if (currentRequest != null) currentRequest.abort();
                },
                success:function(res){

                    if(res.deleted) {
                        $('.seourl_'+id).css('background', '#ff1b7e').fadeOut('slow');
                        notify('Class Deleted.');

                    } else {
                        notify(res.message);
                    }
                }
            });
        }

    </script>


@stop


@section('body')

<div class="row" id="category_list">
    <br>
    <br>
    <br>
    <table id="seo-table" class="table-yuk table-categories">
        <thead>
            <tr class="table-header">
                <th>Location</th>
                <th>Search</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach($seourls as $url)
            <tr data-subid="{{$url->id}}" class="seourl_{{ $url->id}}">
                <td>{{$url->location}}</td>
                <td>{{$url->search}}</td>
                <td>{{$url->title}}</td>
                <td>{{$url->description}}</td>
                <td data-value="{{ $url->id }}" width="140">

                    <a  title="Edit" href="{{URL::route('admin.seourls.manage', [$url->id]) }}"><span class="el-icon-edit bs_ttip" title="" data-original-title=".el-icon-edit"></span></a>
                    <span data-confirm="Are you sure you want to delete this class?" onclick="deleteIt({{ $url->id }})" class="el-icon-remove bs_ttip cp delete_it" style="margin-left:5px" data-id="{{ $url->id }}"></span>


                </td>
            </tr>
        @endforeach
    </table>
    <a  title="new" href="{{URL::route('admin.seourls.manage', [0]) }}"><span class="bs_ttip" title="" data-original-title=".el-icon-edit">Add new entry</span></a>
    <br>
    <br>
    <br>
    <br>
</div>

@stop