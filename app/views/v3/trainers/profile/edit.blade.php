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
                    <div class="col-sm-6">
                       <div class="form-group mb50">
                         {{ Form::label('password', 'Password' , ['class' => 'mb15'])  }}
                         {{ Form::password('password',['class' => 'form-control', 'placeholder' => 'Enter a password']) }}
                       </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group mb50">
                         {{ Form::label('password_confirmation', 'Confirmed Password' , ['class' => 'mb15'])  }}
                         {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'confirm your password']) }}
                       </div>
                    </div>
                </div>
                <div class="row  mt10">
                    <div class="col-sm-6">
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

               <!-- TRAINER BIT START-->
               <div class="form-group mb50">
                    {{ Form::label('profession', 'Profession', ['class' => 'mb15'] )  }}
                    {{ Form::text('profession', $user->trainer->profession, ['class' => 'form-control', 'placeholder' => 'Max 50 Characters', 'maxlength' => 50]) }}
               </div>
               <div class="form-group mb50">
                    {{ Form::label('bio', 'Bio', ['class' => 'mb15'] )  }}
                    {{ Form::textarea('bio', $user->trainer->bio, ['class' => 'form-control', 'placeholder' => 'Between 50 and 500 characters', 'maxlength' => 500, 'rows'=> 7]) }}
               </div>
               <div class="form-group mb50">
                <label class="mb15" for="phone">website</label>
                <div class="input-group">
                    <div class="input-group-addon">
                      <span class="ml10 mr10">http://</span>
                    </div>
                    {{ Form::text('website', $user->trainer->website, ['class' => 'form-control']) }}
                </div>
                </div>
                <!-- TRAINER BIT END -->

                <div class="text-center mb50">

                    <div class="custom-checkbox">
                        {{ Form::checkbox('newsletter', 'yes', $user->newsletter->count() > 0 ? ($user->newsletter[0] == 'yes' ? true : false) : false , ['id'=> 'newsletter']) }}
                        <label for="newsletter" class="text-grey"> Get all the latest deals and news info by signing up to our newsletter</label>
                    </div>

                </div>
                <div class="text-center form-group mt40">
                    {{ Form::hidden('image', isset($user->image) ? $user->image : null) }}
                    {{ Form::submit('Save', ['class' => 'btn btn-primary'] )  }}
                </div>

            {{ Form::close() }}
        </div>
    </div>
</div>