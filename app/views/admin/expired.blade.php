@extends('admin.main')

@section('css')
<link href="/admin/assets/lib/footable/css/footable.core.min.css" rel="stylesheet" media="screen">
@stop

@section('script')
  <!-- footable -->
<script src="/admin/assets/lib/footable/footable.min.js"></script>
<script src="/admin/assets/lib/footable/footable.paginate.min.js"></script>
<script src="/admin/assets/lib/footable/footable.filter.min.js"></script>

<script>
    $(function() {
        // footable
        yukon_footable.p_plugins_tables_footable();
    })
</script>

@stop

@section('body')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-yuk2 toggle-arrow-tiny" id="footable_demo" data-filter="#textFilter" data-page-size="25">
                <thead>
                    <tr>
                        <th data-toggle="true">ID</th>
                        <th>DATE</th>
                        <th>members</th>
                        <th>price</th>
                        <th>user_id</th>
                        <th>name</th>
                        <th>email</th>
                        <th>first_name</th>
                        <th>last_name</th>
                        <th>phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expired as $a)

                    <tr>
                        <td>{{ $a->id }}</td>
                        <td>{{ $a->date_time }}</td>
                        <td>{{ $a->members }}</td>
                        <td>{{ $a->price }}</td>
                        <td>{{ $a->user_id }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->email }}</td>
                        <td>{{ $a->first_name }}</td>
                        <td>{{ $a->last_name }}</td>
                        <td>{{ $a->phone }}</td>
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