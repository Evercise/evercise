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
            <table class="table table-yuk2 toggle-arrow-tiny" id="footable_demo" data-filter="#textFilter" data-page-size="10">
                <thead>
                    <tr>
                        <th data-toggle="true">ID</th>
                        <th>User</th>
                        <th>Class</th>
                        <th>Sale Date</th>
                        <th>Session Date</th>
                        <th>Amount</th>
                        <th>Transaction ID</th>
                        <th>Payment method</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{ $sale['id'] }}</td>
                            <td><a href="{{ URL::route('users.edit', ['id' => $sale['user']->display_name]) }}">{{ $sale['user_id'] . ' - ' . $sale['user']->display_name }}</a></td>
                            <td><a href="{{ URL::route('class.show', ['id' => $sale['class']->slug]) }}">{{ $sale['class_id'] . ' - ' . $sale['class']->name }}</a></td>
							<td>{{ $sale['date'] }}</td>
							<td><a href="{{ URL::route('class.show', ['id' => $sale['class']->slug]) }}?t={{ $sale['session']->id}}">{{ $sale['session']->date_time->format('M jS, Y g:ia') }}</a></td>

                            <td>{{ $sale['amount'] }}</td>
                            <td>{{ $sale['transaction_id'] }}</td>
                            <td>{{ $sale['payment_method'] }}</td>

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