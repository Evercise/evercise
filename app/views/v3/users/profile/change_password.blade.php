<div class="container">
    <div class="underline text-center">
        <h1>Change your password</h1>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="row  mt10">
                {{ Form::open(['route' => 'home','method' => 'post',  'role' => 'form', 'id' => 'change-password']) }}
                <div class="col-sm-6">
                   <div class="form-group mb50">
                     {{ Form::label('new_password', 'Password' , ['class' => 'mb15'])  }}
                     {{ Form::password('new_password',['class' => 'form-control', 'placeholder' => 'Enter a password']) }}
                   </div>
                </div>
                <div class="col-sm-6">
                   <div class="form-group mb50">
                     {{ Form::label('new_password_confirmation', 'Confirmed Password' , ['class' => 'mb15'])  }}
                     {{ Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => 'confirm your password']) }}
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>