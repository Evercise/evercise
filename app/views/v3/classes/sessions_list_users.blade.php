<div class="modal fade" id="mail-trainer" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="icon icon-cross" aria-hidden="true"></span><span class="sr-only">Close</span></button>
        <h3 class="modal-title text-center">Users attending {{ $evercisegroup->name }} ({{ $evercisesession->date_time->format('M jS Y g:ia')}})</h3>
      </div>
      <div class="modal-body">
      @foreach($sessionmembers as $s)
            {{ $s->first_name }}  {{ $s->last_name }}   {{ $s->email }}  <br/>
      @endforeach
      </div>
    </div>
  </div>
</div>