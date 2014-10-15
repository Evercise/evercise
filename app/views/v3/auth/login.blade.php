{{ Form::open(['url' => '', 'method' => 'post', 'class'=>'mb10', 'role' => 'form'] ) }}

    <div class="col-sm-12">
        <li role="presentation" class="dropdown-header">Login</li>
        <div class="form-group">
            {{ Form::text('forename', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
        </div>
        <div class="form-group">
            {{ Form::text('forename', null, ['class' => 'form-control', 'placeholder' => 'Password']) }}
        </div>
        <div class="form-group">
            {{  Form::submit('Login', ['class' => 'btn btn-primary btn-block'] ) }}
            <div class="col-sm-6 text-center mb15 mt5">
                {{ HTML::linkRoute('auth.forgot', 'Forgot password?' ) }}
            </div>
            <div class="col-sm-6 text-center mb15 mt5">
                {{ HTML::linkRoute('register', 'Want to Register?' ) }}
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            {{ HTML::decode(HTML::linkRoute('users.fb', '<span class="icon icon-fb"></span>Log in with facebook', null , ['class' => 'btn btn-fb btn-block']) )}}
        </div>
    </div>


{{ Form::close() }}