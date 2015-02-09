<div class="container">
    <div class="underline text-center">
        <h1>Change your password</h1>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
        {{ Form::open(['route' => 'users.changepassword.post','method' => 'post',  'role' => 'form', 'id' => 'change-password']) }}
            <div class="row  mt10">
                <div class="col-sm-6">
                   <div class="form-group mb50">
                     {{ Form::label('old_password', 'Current Password' , ['class' => 'mb15'])  }}
                     {{ Form::password('old_password',['class' => 'form-control', 'placeholder' => 'Enter you current password']) }}
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                   <div class="form-group mb50">
                     {{ Form::label('new_password', 'New Password' , ['class' => 'mb15'])  }}
                     {{ Form::password('new_password',['class' => 'form-control', 'placeholder' => 'Enter a new password']) }}
                   </div>
                </div>
                <div class="col-sm-6">
                   <div class="form-group mb50">
                     {{ Form::label('new_password_confirmation', 'Confirmed new Password' , ['class' => 'mb15'])  }}
                     {{ Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => 'confirm your new password']) }}
                   </div>
                </div>
            </div>
            <div class="row mb40">
                <div class="col-sm-4 col-sm-offset-4">
                    {{ Form::submit('Save', ['class' => 'btn btn-primary btn-block'] )  }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>