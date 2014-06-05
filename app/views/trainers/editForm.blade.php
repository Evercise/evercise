
{{ Form::open(array('id' => 'trainer_create', 'url' => 'trainers/'.$trainer->id, 'method' => 'post', 'class' => 'create-form')) }}

    @include('form.select', array('fieldname'=>'discipline', 'label'=>'Discipline', 'values'=>$disciplines))
    @if ($errors->has('discipline'))
        {{ $errors->first('discipline', '<p class="error-msg">:message</p>')}}
    @endif

    @include('form.select', array('fieldname'=>'title', 'label'=>'Title', 'values'=>array('0'=>'Select a discipline')))
    @if ($errors->has('title'))
        {{ $errors->first('title', '<p class="error-msg">:message</p>')}}
    @endif

    @include('form.textfield', array('fieldname'=>'bio', 'placeholder'=>'between 50 and 500 characters', 'maxlength'=>500, 'label'=>'Add your bio', 'fieldtext'=>'This is the bio that is displayed to our users', 'default'=>$bio ))
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
        