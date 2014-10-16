

<div class="row">
    <div class="col-md-4">
        <select id="select_user_type" class="form-control">
            <option>users</option>
            <option>trainers</option>
        </select>
    </div>
</div>

<div class="row">
    <ul id="user_list">
        @foreach($users as $key => $theUser)
            @if( ! $sentryUsers[$key]->inGroup(Sentry::findGroupByName('Trainer')) )
                <li>
                    <h3 class="ul_userName"><span class="ul_firstName">{{ $theUser->first_name }}</span> <span class="ul_lastName">{{ $theUser->last_name }}</span></h3>

                    <p>
                        <small class="text-muted">Phone:</small> <span class="ul_phone">{{ $theUser->phone }}</span>;
                        <small class="text-muted">Email:</small> <span class="ul_email">{{ $theUser->email }}</span>
                    </p>
                    <div class="buttons">
                        {{ Form::open(array('id' => 'log_in_'.$theUser->id, 'url' => 'admin/log_in_as', 'method' => 'post', 'class' => '')) }}
                            {{ Form::hidden( 'user_id' , $theUser->id) }}
                            {{ Form::submit('Log in as user' , array('class'=>'btn-yellow ')) }}
                        {{ Form::close() }}

                        {{ Form::open(array('id' => 'reset_password_'.$theUser->id, 'url' => 'admin/reset_password', 'method' => 'post', 'class' => 'reset_password')) }}
                            {{ Form::hidden( 'user_id' , $theUser->id) }}
                            {{ Form::submit('Reset Password' , array('class'=>'btn-yellow ')) }}
                        {{ Form::close() }}
					</div>
                </li>
            @endif
        @endforeach
    </ul>
</div>