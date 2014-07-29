<div id="upload_wrapper" class="mt30">
    @include('widgets.upload-form', array('uploadImage' => $userImage, 'default_image' => HTML::image( '/img/add_users.png', 'preview image', array('class' => 'class-block-img')) , 'label' => 'Upload you user image', 'fieldtext'=>'<span class="tooltip" data-tooltip="You must own the image or have the permission of the image owner to use it. <br>The image you choose for your profile and/or class must not contain any of the following:<li>Trademarks or company names – eg, images marked with ® or ™ signs</li> <li>mages or text protected by copyright – eg, images marked with © or other watermarks or notations</li><li>Contact information – telephone numbers, URLs or email addresses</li><li>Political statements or images relating to ethnicity or religion</li><li>Provocative, lewd or sexual images or content</li><li>Offensive material – images, signs, symbols or text relating to violence, death, injury, racism, cruelty, profanity, obscenity, weapons, firearms, ammunition or terrorism</li><li>Content where drinking, being drunk, smoking or gambling is the focus</li>">Choose a suitable image to represent your class.<br> Uploaded images must conform to the following guidelines: (* click to see guidelines)</span>'))
</div>
	{{ Form::open(array('id' => 'user_edit', 'url' => 'users/'.$user->id, 'method' => 'PUT', 'class' => 'create-form')) }}

        @include('form.textfield', array('fieldname'=>'first_name', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>20, 'label'=>'first name', 'tooltip'=>'This is your first name.', 'default'=>$firstName ))
        @if ($errors->has('first_name'))
            {{ $errors->first('first_name', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'last_name', 'placeholder'=>'Between 3 and 15 characters', 'maxlength'=>20, 'label'=>'last name', 'tooltip'=>'your last name.', 'default'=>$lastName ))
        @if ($errors->has('last_name'))
            {{ $errors->first('last_name', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.datepicker', array('fieldname'=>'dob', 'placeholder'=>'Date of birth', 'maxlength'=>20, 'label'=>'Date of birth', 'default'=>date('Y-m-d',strtotime($dob))))
        @if ($errors->has('last_name'))
            {{ $errors->first('last_name', '<p class="error-msg">:message</p>')}}
        @endif
        @include('form.phone', array('fieldname'=>'phone', 'placeholder'=>'Add you phone number', 'maxlength'=>32,  'label'=>'Add you phone number', 'tooltip'=>'(Optional) - Your phone number will only be used in case of emergency (cancellations, etc.)', 'default_area'=>$area_code, 'default'=>$phone))
        @if ($errors->has('password'))
            {{ $errors->first('password', '<p class="error-msg">:message</p>')}}
        @endif

    	@include('form.select', array('fieldname'=>'gender', 'label'=>'gender', 'values'=>array(1=>'Male', 2=>'Female'), 'selected'=>$gender))


        @if(basename($user->image) != '')
            {{ Form::hidden( 'thumbFilename' , basename($user->image), array('id' => 'thumbFilename')) }}
        @else
            {{ Form::hidden( 'thumbFilename' , null, array('id' => 'thumbFilename')) }}
        @endif

        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Save changes' , array('class'=>'btn btn-yellow ')) }}
        </div>
        <div class="success_msg">Details updated</div>
	{{ Form::close() }}
