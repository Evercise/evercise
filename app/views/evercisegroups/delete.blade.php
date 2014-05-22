<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Delete a class</h4>
		<br>
	</div>
	
	<div class="modal-body">
		@if($deleteable == 1)
			<p>You can delete this class</p>
			{{$name}}
			{{$id}}
			{{ HTML::link('evercisegroups/delete_evercise_groups/'.$id, 'Delete Class!',array('class' => 'btn btn-red', 'id'=>'delete_evercisegroup')) }}
		@elseif ($deleteable == 2)
			<p>This Class has sessions. All sessions will be deleted</p>
			{{$name}}
			{{$id}}
			{{ HTML::link('evercisegroups/delete_evercise_groups/'.$id, 'Delete Class!',array('class' => 'btn btn-red', 'id'=>'delete_evercisegroup')) }}
		@elseif ($deleteable == 3)
			<p>This Class has members. It cannot be deleted</p>
			{{$name}}
			{{$id}}

		@endif
    </div>
<script>
	
</script>

</div>