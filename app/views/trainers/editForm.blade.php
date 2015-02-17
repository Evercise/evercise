
{{ Form::open(array('id' => 'trainer_edit', 'route' => ['trainers.update', $trainer->id],  'method' => 'PUT', 'class' => 'create-form mt20')) }}


    @include('form.textfield', array('fieldname'=>'profession', 'placeholder'=>'Your profession', 'maxlength'=>50, 'label'=>'Add your profession', 'class' => '', 'fieldtext'=>'Add your profession', 'default'=>$profession ))
    @if ($errors->has('profession'))
        {{ $errors->first('profession', '<p class="error-msg">:message</p>')}}
    @endif

    @include('form.textarea', array('fieldname'=>'bio', 'placeholder'=>'between 50 and 500 characters', 'maxlength'=>500, 'label'=>'Add your bio', 'fieldtext'=>'This is the bio that is displayed to our users', 'default'=>$bio ))
    @if ($errors->has('bio'))
        {{ $errors->first('bio', '<p class="error-msg">:message</p>')}}
    @endif

    @include('form.textfield', array('fieldname'=>'website', 'placeholder'=>'website address', 'maxlength'=>100, 'label'=>'Add your website', 'fieldtext'=>'(Optional) - If you want users to learn more about you and what you do, you can include your web address, which will be visible on your profile.' ))
    @if ($errors->has('website'))
        {{ $errors->first('website', '<p class="error-msg">:message</p>')}}
    @endif

    <div class="center-btn-wrapper" >
        {{ Form::submit('Save changes' , array('class'=>'btn-yellow ')) }}
    </div>
    <div class="success_msg">Details updated</div>
{{ Form::close() }}
        