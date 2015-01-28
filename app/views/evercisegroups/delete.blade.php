<div class='modal'>
	<div id="cancel_login" class="cancel">x</div>
	<div class="modal-head">
		<h4>Delete class &rsquo;{{$name}}&rsquo;</h4>
	</div>
	
	<div class="modal-body modal-center">
		@if($deleteable == 1)
			<p>Would you really like to delete this class?</p>
			<br/>
			{{ HTML::linkRoute('class.show', 'Delete Class!', $id, array('class' => 'btn btn-red', 'id'=>'delete_evercisegroup')) }}
		@elseif ($deleteable == 2)
			<p>This Class has sessions. If you delete it, all sessions will also be deleted</p>
			<br/>
			{{ HTML::linkRoute('class.show', 'Delete Class!', $id, array('class' => 'btn btn-red', 'id'=>'delete_evercisegroup')) }}
		@elseif ($deleteable == 3)
			<p>You can not delete a class that has members that have joined upcoming sessions</p>
			<br>
			<p>If there is a issue with this class please {{ HTML::linkRoute('static.contact_us', 'Contact Us') }}</p>

		@endif
    </div>
<script>
	
</script>

</div>