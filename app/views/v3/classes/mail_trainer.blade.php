<div class="modal fade" id="mail-trainer-{{$sessionId}}" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon icon-cross" aria-hidden="true"></span><span class="sr-only">Close</span></button>
        <h3 class="modal-title text-center">Mail the trainer</h3>
      </div>
      <div class="modal-body">
        {{ Form::open(array('id' => 'mail_trainer', 'url' => 'sessions/'.$sessionId.'/mail_trainer/'.$trainerId, 'method' => 'POST', 'class' => 'create-form')) }}
            <div class="form-group">
                {{ Form::label('mail_body', 'Mail Body', ['class' => 'mb15']) }}
                {{ Form::textarea('mail_body',null, ['placeholder'=>'Type your mail here', 'maxlength'=>1000, 'class' => 'form-control', 'rows' => 6] ) }}
            </div>
            <div class="form-group text-center">
                {{ Form::submit('Send Email' , ['class'=>'btn btn-primary']) }}
            </div>

        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>