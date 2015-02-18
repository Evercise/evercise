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


               <?php $bookingCodes = [] ?>
               @foreach ($sessionmembers as $key => $user)
                   @if (! isset($bookingCodes[$user['pivot']['transaction_id'].'_'.$user['pivot']['evercisesession_id']]) )
                       <li class="list-group-item">
                           <h4>{{ $user->first_name }}  {{ $user->last_name }}</h4>
                           <?php
                           $transaction = \Transactions::where('id', $user['pivot']['transaction_id'])->first();
                           $bookingCodes[$user['pivot']['transaction_id'].'_'.$user['pivot']['evercisesession_id']] = $transaction->makeBookingHashBySession($user['pivot']['evercisesession_id']);
                           $countCodes = 0;
                           ?>
                           <p>Tickets bought: {{ count($bookingCodes[$user['pivot']['transaction_id'].'_'.$user['pivot']['evercisesession_id']]) }}</p>
                           <p>Booking Codes:
                               @foreach($bookingCodes[$user['pivot']['transaction_id'].'_'.$user['pivot']['evercisesession_id']] as $code)
                                   {{ $code . ( $countCodes++ >= count($bookingCodes[$user['pivot']['transaction_id'].'_'.$user['pivot']['evercisesession_id']]) ? '' : ',' ) }}
                               @endforeach
                           </p>
                       </li>
                   @endif
               @endforeach
            </ul>
      </div>
    </div>
  </div>
</div>