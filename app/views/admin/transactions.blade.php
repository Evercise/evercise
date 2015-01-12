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
            <select class="form-control input-sm" id="userStatus">
                <option></option>
                <option value="user">User</option>
                <option value="trainer">Trainer</option>
            </select>
            <span class="help-block">Status</span>
        </div>
        <div class="col-md-3">
            <a class="btn btn-default btn-sm" id="clearFilters">Clear</a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-default btn-sm" href="{{ URL::route('admin.users.trainerCreate') }}">Create new Trainer</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-yuk2 toggle-arrow-tiny" id="footable_demo" data-filter="#textFilter" data-page-size="10">
                <thead>
                    <tr>
                        <th data-toggle="true">ID</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>After fees</th>
                        <th>Payment method</th>
                        <th>Token</th>
                        <th>3rd party ID</th>
                        <th>Processed</th>
                        <th>Date / Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction['id'] }}</td>
                            <td>{{ $transaction['user_id'] . ' - ' . $transaction['user_name'] }}</td>
                            <td>{{ $transaction['total'] }}</td>
                            <td>{{ $transaction['total_after_fees'] }}</td>
                            <td>{{ $transaction['payment_method'] }}</td>
                            <td>{{ $transaction['token'] }}</td>
                            <td>{{ $transaction['transaction'] }}</td>
                            <td>{{ $transaction['processed'] }}</td>
                            <td>{{ $transaction['date_time'] }}</td>
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