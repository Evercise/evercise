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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered</th>
                        <th>Type</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(User::orderBy('id', 'desc')->get() as $user)
                    <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                            @if($user->isTrainer())
                                <a href="{{ URL::route('trainer.show', [$user->display_name]) }}" target="_blank">
                            @endif
                            {{ (!empty($user->first_name) ? $user->first_name.' '.$user->last_name : $user->display_name) }}

                            @if($user->isTrainer())
                                </a>
                            @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                <span class="label status-
                                {{ ($user->isTrainer() ? 'trainer label-success ':'user label-warning') }} status-all" title="Active">
                                {{ ($user->isTrainer() ? 'Trainer':'User') }}</span></td>

                            </td>

                            <td>

                                {{ Form::open(array('id' => 'log_in_'.$user->id, 'url' => 'admin/log_in_as', 'method' => 'post', 'class' => '', 'style' => 'float:left;margin-right:5px')) }}
                                    {{ Form::hidden( 'user_id' , $user->id) }}
                                    {{ Form::submit('Log in as user' , array('class'=>'btn btn-sm btn-info')) }}
                                {{ Form::close() }}

                                {{ Form::open(array('id' => 'reset_password_'.$user->id, 'url' => 'ajax/admin/reset_password', 'method' => 'post', 'class' => 'reset_password', 'style' => 'float:left')) }}
                                    {{ Form::hidden( 'user_id' , $user->id) }}
                                    {{ Form::submit('Reset Password' , array('class'=>'btn btn-sm btn-warning')) }}
                                {{ Form::close() }}

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