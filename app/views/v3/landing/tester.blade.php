
<div class="modal fade" id="testerModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Welcome Tester</h4>
			</div>
			<div class="modal-body">
				<p>FYI. We are recording this session. All sensitive data like passwords and credit card info are NOT recorder.</p>
				<p style="font-size:30px">
					<input type="text" placeholder="Enter Full Name" style="text-align: center;width:100%"/></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Continue</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$(window).load(function(){
		$('#testerModal').modal('show');
	});
</script>