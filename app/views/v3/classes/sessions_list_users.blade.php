<div class="modal fade" id="session-members-{{$evercisesession->id}}" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal"><span class="icon icon-cross" aria-hidden="true"></span><span class="sr-only">Close</span></button>
        <h3 class="modal-title text-center">Users attending {{ $evercisegroup->name }} </h3>
        <small>({{ $evercisesession->date_time->format('M jS Y g:ia')}})</small>
      </div>
      <div class="modal-body text-left">
            <ul class="list-group">
               @foreach($sessionmembers as $s)
                   <li class="list-group-item">
                        <h4 class="list-group-item-heading">{{ $s->first_name }}  {{ $s->last_name }}</h4>
                        <p class="list-group-item-text">{{ $s->email }}</p>
                    </li>

               @endforeach
            </ul>
      </div>
    </div>
  </div>
</div>