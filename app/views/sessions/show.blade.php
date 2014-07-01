
<ul>
	<div class="session-list-row-past">
		<li>{{ date('M-dS' , strtotime($session['date_time'])) }}</li>
		<li>{{ date('h:ia' , strtotime($session['date_time'])) }}</li>
		
		@if((new DateTime($session['date_time'])) > (new DateTime('now')))
			<li>
				{{ date('h:ia' , strtotime($session['date_time']) + ( $session['duration'] * 60)) }}
			</li>
		@endif
		
		<li>&pound;{{ $session['price'] }}</li>
		<li> <strong>{{$members[$s_key]}}</strong>/{{ $evercisegroup->capacity }} </li>
		@if((new DateTime($session['date_time'])) < (new DateTime('now')))
			<li>
				{{count($session->sessionpayment) ? ($session->sessionpayment->processed ? 'Processed' : 'Processing' ) : 'Pending' }}
			</li>
			<li>
				{{ count($session->sessionpayment) ? ( '£'.( $session->sessionpayment->total - $session->sessionpayment->total_after_fees). ' @ ' .($session->sessionpayment->commission * 100).'%') : '0' }}
			</li>
			<li>
				&pound;{{ $session['price'] * $members[$s_key] }}
			</li>
		@endif
		<li class="session-list-controls">
			{{ HTML::decode(HTML::linkRoute('sessions.mail_all', '<img src="/img/mail_icon_green.png"></img>', array('id'=>$session['id']), array('class'=>'mail_all session-icon '.($session['Sessionmembers']->isEmpty() ? 'session-no-members' : ''))) ) }}
			{{ Form::open(array('id' => 'download_members', 'url' => 'postPdf', 'method' => 'post', 'class' => '')) }}
				{{ Form::hidden( 'postMembers' , $session['Sessionmembers'] , array('id' => 'postMembers')) }}
				<button type="submit">
					{{ HTML::image('/img/download_icon_blue.png', 'download icon' , array('class' => 'session-icon '.($session['Sessionmembers']->isEmpty() ? 'session-no-members' : ''))); }}
				</button>
				 
			{{ Form::close() }}
			
			{{ HTML::image('/img/view_icon_yellow.png', 'view icon' , array('id'=> 'view-session' ,'class' => 'session-icon session-icon-view '.($session['Sessionmembers']->isEmpty() ? 'session-no-members' : ''))); }} 
		</li>
	</div>
	
	<div class="session-members-list">
		@foreach($session['Sessionmembers'] as $sm_key => $sessionmember)

			@if ($sm_key % 3 === 2) 
				</div>
			@endif
			@if ($sm_key % 2 === 0) 
				<div class="session-members-row">
			@endif
			<div class="session-members-col">
				@if($sessionmember->users->image != '')
					{{ HTML::image('profiles/'.$sessionmember->users->directory.'/'. $sessionmember->users->image, $sessionmember->users->display_name , array('title' => $sessionmember->users->display_name ,'class' => 'session-list-profile')) }}
				@else
					{{ HTML::image('img/no-user-img.jpg', $sessionmember->users->display_name , array('title' => $sessionmember->users->display_name ,'class' => 'session-list-profile')) }}
				@endif
				<div class="session-list-info">
					<p>{{ $sessionmember['Users']['display_name'] }}</p>
					<p>Joined on the {{ date('dS-M', strtotime($sessionmember['created_at']) )  }}</p>

				</div>
				{{ HTML::decode(HTML::linkRoute('sessions.mail_one', '<img src="/img/mail_icon_green.png"></img>', array('sessionId'=>$session['id'], 'userId'=> $sessionmember['Users']['id']), array('class'=>'mail_all session-icon')) ) }}
				
			</div>
		@endforeach
		@if(! $session['Sessionmembers']->isEmpty())
			</div>
			
		@endif

		<div class="session-members-footer">
			<aside>
				{{ HTML::decode(HTML::linkRoute('sessions.mail_all', 'Message All Users', array('id'=>$session['id']), array('class'=>'mail_all btn btn-green session-icon')) ) }}
				{{ Form::open(array('id' => 'download_members', 'url' => 'postPdf', 'method' => 'post', 'class' => '')) }}
					{{ Form::hidden( 'postMembers' , $session['Sessionmembers'] , array('id' => 'postMembers')) }}
					<button class="btn btn-blue" type="submit">Download List</button>
					 
				{{ Form::close() }}
			</aside>
			
		</div>
	</div>
</ul>