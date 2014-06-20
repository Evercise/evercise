<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Delete class &rsquo;{{$name}}&rsquo;</h4>
		<br>
	</div>
	
	<div class="modal-body">
		@if($deleteable == 1)
			<p>You can delete this class</p>
			<br/>
			{{ HTML::link('evercisegroups/'.$id, 'Delete Class!',array('class' => 'btn btn-red', 'id'=>'delete_evercisegroup')) }}
		@elseif ($deleteable == 2)
			<p>This Class has sessions. If you delete it, all sessions will also be deleted</p>
			<br/>
			{{ HTML::link('evercisegroups/'.$id, 'Delete Class!',array('class' => 'btn btn-red', 'id'=>'delete_evercisegroup')) }}
		@elseif ($deleteable == 3)
			<p>This Class has members. It cannot be deleted</p>
			<br/>

		@endif
    </div>
<script>
	
</script>

</div>