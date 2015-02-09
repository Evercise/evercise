<div class="container">
    <div class="underline text-center">
        <h1>Edit your profile</h1>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group mb50">
                @include('v3.widgets.profile_image_upload', ['image' => $user->directory.'/medium_'. $user->image])
           </div>
            {{ Form::open(['route' => 'users.update', 'method' => 'post', 'class'=>'mb50', 'role' => 'form', 'id' => 'update-user-form'] ) }}
                <div class="row  mt10">
                    <div class="col-sm-6">
                       <div class="form-group mb50">
                         {{ Form::label('first_name', 'Forename', ['class' => 'mb15'] )  }}
                         {{ Form::text('first_name', $user->first_name, ['class' => 'form-control', 'placeholder' => 'Enter your first name']) }}
                       </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group mb50">
                         {{ Form::label('last_name', 'Surname' , ['class' => 'mb15'])  }}
                         {{ Form::text('last_name', $user->last_name, ['class' => 'form-control', 'placeholder' => 'Enter your second name']) }}
                       </div>
                    </div>
                </div>
                <div class="row  mt10">
                    <div class="col-sm-6">
                       <div class="form-group mb50">
                         {{ Form::label('email', 'Email Address', ['class' => 'mb15'] )  }}
                         {{ Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Enter your current email address']) }}
                       </div>
                    </div>
                </div>

                <div class="row  mt10">
                    <div class="col-sm-6 mb50">
                        <label class="mb15" for="phone">Phone Number<small> (Get alerts about classes)</small></label>

                        <div class="input-group">
                            <div class="input-group-addon custom-select">
                               {{ Form::select('areacode', Config::get('countrycodes.pretty')

                                , $user->area_code, ['class' => 'select-addon'] ) }}
                            </div>
                            {{ Form::text('phone', $user->phone, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group mb50">
                           <label class="mb15" for="forename">Gender</label>
                           <div class="custom-select">
                               {{ Form::select('gender',
                                   [
                                       'male' => 'male',
                                       'female' => 'female'
                                   ]
                                , $user->getGender(), ['class' => 'form-control'] ) }}
                           </div>
                       </div>
                    </div>
                </div>


                <div class="text-center">

                    <div class="custom-checkbox">
                        {{ Form::checkbox('newsletter', 'yes', $user->newsletter->count() > 0 ? ($user->newsletter[0] == 'yes' ? true : false) : false , ['id'=> 'newsletter']) }}
                        <label for="newsletter" class="text-grey"> Get all the latest deals and news info by signing up to our newsletter</label>
                    </div>

                </div>
                <div class="text-center form-group mt40">
                    {{ Form::hidden('image', isset($user->image) ? $user->image : null) }}
                    {{ Form::submit('Save', ['class' => 'btn btn-primary sm-btn-block'] )  }}
                </div>

            {{ Form::close() }}
        </div>
    </div>
</div>