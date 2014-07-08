<div class="cart-row" id="cart-row-{{$session->id }}">
	<li class="long cart-item">
		<div class="delete-block">
			{{ Form::open(array('id' => 'join-sessions', 'url' => 'sessions/join', 'method' => 'post', 'class' => '')) }}
				{{ Form::hidden( 'evercisegroup-id' , $evercisegroup_id, array('id' => 'evercisegroup-id')) }}
				{{ Form::hidden( 'session-ids' , json_encode($session_ids), array('id' => 'session-ids')) }}
				<button class="btn delete-icon" type="submit">
					{{ HTML::image('img/red-cross.png', 'delete', ['class' => 'delete-icon'])}}
				</button>

			{{ Form::close() }}
			
		</div>	
		<div class="cart-info">
			<strong>	{{$evercisegroup_name}}	</strong>
			<br>			

			<span>{{ date('M dS - H:ia' , strtotime($date_time)) }}</span>
		</div>	
		
	</li>
	<li class="cart-item">
		<br>
		1
	</li>
	<li class="cart-item">
		<br>
		&pound;{{ $session['price'] }}
	</li>
</div>