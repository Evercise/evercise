{{ Form::open(array('id' => 'trainer_create', 'url' => 'trainers', 'method' => 'post', 'class' => 'create-form')) }}
        @include('form.select', array('fieldname'=>'discipline', 'label'=>'Discipline', 'values'=>$disciplines))
        @if ($errors->has('discipline'))
            {{ $errors->first('discipline', '<p class="error-msg">:message</p>')}}
        @endif

    	@include('form.select', array('fieldname'=>'title', 'label'=>'Title', 'values'=>array('0'=>'Select a discipline')))
        @if ($errors->has('title'))
            {{ $errors->first('title', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'bio', 'placeholder'=>'between 50 and 500 characters', 'maxlength'=>500, 'label'=>'Add your bio', 'fieldtext'=>'Your biography will be visible on your profile and will give members a more personal insight into you as an instructor. (example: Kayla is a qualified pool yoga instructor with 5 years of experience helping swimmers improve strength and flexibility in the pool. She is excited to meet new swimmers and help them improve their practice while decreasing chances of injury. She loves canoeing and camping, and is very happy to be a part of the evercise team!)' ))
        @if ($errors->has('bio'))
            {{ $errors->first('bio', '<p class="error-msg">:message</p>')}}
        @endif

        @include('form.textfield', array('fieldname'=>'website', 'placeholder'=>'website address', 'maxlength'=>100, 'label'=>'Add your website', 'fieldtext'=>'(Optional) - If you want users to learn more about you and what you do, you can include your web address, which will be visible on your profile.' ))
        @if ($errors->has('website'))
            {{ $errors->first('website', '<p class="error-msg">:message</p>')}}
        @endif

        @if(basename($displayImage) != 'no-user-img.jpg')
            {{ Form::hidden( 'thumbFilename' , basename($displayImage), array('id' => 'thumbFilename')) }}
        @else
            {{ Form::hidden( 'thumbFilename' , null, array('id' => 'thumbFilename')) }}
        @endif

        <div class="center-btn-wrapper" >
    	   {{ Form::submit('Sign Up' , array('class'=>'btn-yellow ')) }}
        </div>
        {{ Form::close() }}
        