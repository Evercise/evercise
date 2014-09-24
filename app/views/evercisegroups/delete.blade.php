<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Delete class &rsquo;{{$name}}&rsquo;</h4>
	</div>
	
	<div class="modal-body modal-center">
		@if($deleteable == 1)
			{{ trans('evercisegroups-delete.message_deletable') }}
			{{ HTML::linkRoute('evercisegroups.show', 'Delete Class!', $id, array('class' => 'btn btn-red', 'id'=>'delete_evercisegroup')) }}
		@elseif ($deleteable == 2)
			{{ trans('evercisegroups-delete.message_sessions_warning') }}
			{{ HTML::linkRoute('evercisegroups.show', 'Delete Class!', $id, array('class' => 'btn btn-red', 'id'=>'delete_evercisegroup')) }}
		@elseif ($deleteable == 3)
			{{ trans('evercisegroups-delete.message_future_sessions') }}
		@elseif ($deleteable == 4)
			{{ trans('evercisegroups-delete.message_past_sessions') }}

		@endif
    </div>
<script>
	
</script>

</div>