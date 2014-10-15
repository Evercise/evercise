

<div class="row">
    <div class="col-md-4">
        <select id="select_user_type" class="form-control">
            <option>users</option>
            <option selected="selected">trainers</option>
        </select>
    </div>
    <div class="col-md-4">
        <div class="input-group" id="search">
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button"><span class="icon_search"></span></button>
            </span>
        </div>
    </div>
</div>

<div class="row">
    <ul id="user_list">
       @foreach($users as $key => $theUser)
            <li>
                <h3 class="ul_userName">
                    <span class="ul_firstName">{{ $theUser->id .' : '.$theUser->first_name }}</span>
                    <span class="ul_lastName">{{ $theUser->last_name }} </span>
                    <span>({{ $theUser->display_name }})</span>
                    <small class="text-red">{{ $theUser->trainer->confirmed ? '' : ' not approved'}}</small>
                </h3>

                <p>
                    <small class="text-muted">Phone:</small> <span class="ul_phone">{{ $theUser->phone }}</span>;
                    <small class="text-muted">Email:</small> <span class="ul_email">{{ $theUser->email }}</span>
                </p>
                <p>{{ count($theUser->evercisegroups) .' Class'. (count($theUser->evercisegroups) == 1 ? '' : 'es') }}</p>
                <div class="user-table" style="display:none;">
                    <table class="table-condensed" >
                    @foreach($theUser->evercisegroups as $evercisegroup)
                        <tr>
                            <th class="indent"> {{'<a href="../../evercisegroups/'.$evercisegroup->id.'/edit" >' . $evercisegroup->name . '</a>' }} </th>
                        </tr>
                    @endforeach
                    </table>
                </div>
                <div class="buttons">
                    {{ Form::open(array('id' => 'log_in_'.$theUser->id, 'url' => 'admin/log_in_as', 'method' => 'post', 'class' => '')) }}
                        {{ Form::hidden( 'user_id' , $theUser->id) }}
                        {{ Form::submit('Log in as user' , array('class'=>'btn-yellow ')) }}
                    {{ Form::close() }}

                    {{ Form::open(array('id' => 'reset_password_'.$theUser->id, 'url' => 'admin/reset_password', 'method' => 'post', 'class' => 'reset_password')) }}
                        {{ Form::hidden( 'user_id' , $theUser->id) }}
                        {{ Form::submit('Reset Password' , array('class'=>'btn-yellow ')) }}
                    {{ Form::close() }}

                    {{ Form::open(array('id' => 'unapprove_trainer'.$theUser->id, 'url' => 'admin/unapprove_trainer', 'method' => 'post', 'class' => 'unapprove_trainer')) }}
                        {{ Form::hidden( 'user_id' , $theUser->id) }}
                        {{ Form::submit('Unapprove' , array('class'=>'btn-yellow ')) }}
                    {{ Form::close() }}
				</div>
            </li>
        @endforeach
    </ul>
</div>