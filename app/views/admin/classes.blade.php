@extends('admin.main')

@section('css')
<link href="/admin/assets/lib/footable/css/footable.core.min.css" rel="stylesheet" media="screen">
<link href="/admin/assets/lib/jBox-0.3.0/Source/jBox.css" rel="stylesheet" media="screen">
<link href="/admin/assets/lib/jBox-0.3.0/Source/themes/NoticeBorder.css" rel="stylesheet" media="screen">
@stop

@section('script')
  <!-- footable -->
<script src="/admin/assets/lib/footable/footable.min.js"></script>
<script src="/admin/assets/lib/footable/footable.paginate.min.js"></script>
<script src="/admin/assets/lib/footable/footable.filter.min.js"></script>
<script src="/admin/assets/lib/footable/footable.sort.min.js"></script>
<script src="/admin/assets/lib/jBox-0.3.0/Source/jBox.min.js"></script>


<script>
var currentRequest;

    $(function() {
        yukon_footable.p_plugins_tables_footable();


        $('.feature_it').click(function(e){

            var id = $(this).data('id');

                var row = $(this);

                currentRequest = $.ajax({
                        type: "POST",
                        url: AJAX_URL + "featureClass",
                        cache: false,
                        dataType: 'json',
                        data: 'id='+id,
                        beforeSend: function (json) {
                            if (currentRequest != null) currentRequest.abort();
                        },
                        success:function(res){
                            console.log(res);
                            if(res.featured) {
                                row.css('color', '#d58512');
                            } else {

                                row.css('color', '#222');
                            }
                        }
                })

        });
    })

</script>

@stop

@section('body')
<div class="row">
        <div class="col-md-3">
            <input id="textFilter" type="text" class="form-control input-sm">
            <span class="help-block">Filter</span>
        </div>

        <div class="col-md-3">
            <a class="btn btn-default btn-sm" id="clearFilters">Clear</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-yuk2 toggle-arrow-tiny" id="footable_demo" data-filter="#textFilter" data-page-size="50">
                <thead>
                    <tr>
                        <th data-toggle="true">ID</th>
                        <th>Name</th>
                        <th>Capacity</th>
                        <th>Default price</th>
                        <th>Future Sessions</th>
                        <th>Status</th>
                        <th data-sort-initial="descending" >Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $a)

                    <tr>
                        <td>{{ $a->id }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->capacity }}</td>
                        <td>{{ $a->default_price }}</td>
                        <td>{{ $a->futuresessions()->count() }}</td>
                        <td>
                        @if($a->published == 1)
                        <span class="label label-warning status-active" title="Active">Published</span></td>
                        @endif
                        @if($a->published == 0)
                        <span class="label label-default status-disabled" title="Unpublished">Unpublished</span></td>
                        @endif
                        </td>

                        <?php
                        $featured_count = $a->featuredClasses()->count();
                        ?>
                        <td data-value="{{ $featured_count }}">

                        <span class="el-icon-star bs_ttip cp feature_it" data-id="{{ $a->id }}" style="{{ ($featured_count == 1 ? 'color:#d58512':'')}}"></span>


                        </td>

                   </tr>


                    @endforeach

                </tbody>
                <tfoot class="hide-if-no-paging">
                    <tr>
                        <td colspan="5">
                            <ul class="pagination pagination-sm"></ul>
                        </td>
                    </tr>
                </tfoot>
            </table>
</div>
</div>



@stop