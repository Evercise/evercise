<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	Session create
	{{ Form::open(array('id' => 'newsession', 'url' => 'sessions', 'method' => 'post', 'class' => '')) }}
		@include('form.hidden', array('fieldname'=>'evercisegroup', 'value'=>''))
		@include('form.hidden', array('fieldname'=>'date', 'value'=>'2014-05-02 11:13:06'))
		{{ Form::submit('Create session' , array('class'=>'btn-yellow ')) }}

    {{ Form::close() }}
</div>