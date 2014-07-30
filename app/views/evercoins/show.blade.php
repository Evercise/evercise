<div class="dashboard-title">
	{{ HTML::image('img/evercoin.png', 'evercoin', ['class' => 'evercoin-icon'])}}
	<div class="evercoin-title-wrap">
		<h4>Your current Evercoinbalance is:</h4>
	</div>
	<div class="evercoin-balance-wrap">
		<div class="evercoin-balance-circle pounds">&pound;{{ $priceInEvercoins}}</div>
		<div class="evercoin-balance-circle">{{ $evercoinBalance }}e</div>
		
	</div>
	
</div>

<div class="dashboard-body">
	<h3>Transactions</h3>
	<br>
	<br>
	<div class="table">
		<div class="table-row">
			<div class="table-head table-field two-s align-l">
				<li>Description</li>
			</div>
			<div class="table-head table-field one-s">
				<li>Date</li>
			</div>
			<div class="table-head table-field one-s">
				<li>Amount In</li>
			</div>
			<div class="table-head table-field one-s">
				<li>Out</li>
			</div>
			<div class="table-head table-field one-s">
				<li>Balance</li>
			</div>
		</div>
		@foreach($evercoinHistory as $record)
			<div class="table-row">
				@if($record->transaction_amount > 0)
					<div class="table-field two-s align-l">
						<li>Deposit</li>
					</div>
					<div class="table-field one-s">
						<li>
							{{ date('d/m/Y', strtotime($record->created_at) ) }}
						</li>
					</div>
					<div class="table-field one-s">
						<li>
							{{ $record->transaction_amount}}e
						</li>
					</div>
					<div class="table-field one-s">
						<li>
							
						</li>
					</div>
					<div class="table-field one-s">
						<li>
							{{ $record->new_balance }}e
						</li>
					</div>
				@else
					<div class="table-field two-s align-l">
						<li>Withdrawal</li>
					</div>
					<div class="table-field one-s">
						<li>
							{{ date('d/m/Y', strtotime($record->created_at) ) }}
						</li>
					</div>
					<div class="table-field one-s">
						<li>
							
						</li>
					</div>
					<div class="table-field one-s">
						<li>
							{{ $record->transaction_amount}}e
						</li>
					</div>
					<div class="table-field one-s">
						<li>
							{{ $record->new_balance }}e
						</li>
					</div>
				@endif
			</div>
		@endforeach
	</div>
</div>

<div class="dashboard-title">
	<h3>Ways to earn Evercoins</h3>
</div>

<div class="dashboard-body">
	<div class="milestone-row">
		@if($profile < 100)
			<div id="link-profile" class="milestone-block">
				<div class="header">
					100 Evercoin
				</div>
				<div class="body">
					{{ HTML::image('img/link-user.png', 'link-user', ['class' => 'milestone-img'])}}
					
					<strong>Complete Prolife</strong>
					
				</div>
				<div class="footer">
					<p>Your profile is {{  $profile }}% complete </p>
					{{ HTML::linkRoute('users.edit.tab', 'Compete Profile', [$id, 'profile'] , array('class' => 'milestone-btn btn-yellow')) }}
				</div>
			</div>
		@else
			<div id="link-profile" class="milestone-block complete">
				<div class="header">
					100 Evercoin
				</div>
				<div class="body">
					{{ HTML::image('img/link-user.png', 'link-user', ['class' => 'milestone-img'])}}
					
					<strong>Complete Prolife</strong>
					
				</div>
				<div class="footer">
					<div class="complete">
						{{ HTML::image('img/complete-tick.png', 'complete-tick', ['class' => 'complete-img'])}}
						<strong>COMPLETE</strong>
					</div>
				</div>
			</div>
		@endif

		@if(!$fb)
			<div id="link-fb" class="milestone-block">
				<div class="header">
					100 Evercoin
				</div>
				<div class="body">
					{{ HTML::image('img/link-fb.png', 'link-user', ['class' => 'milestone-img'])}}
					
					<strong>Link Facebook</strong>
					
				</div>
				<div class="footer">
					<p>Your account is not linked</p>
					{{ HTML::linkRoute('tokens.fbtoken', 'Link to Facebook', null , array('class' => 'milestone-btn btn-yellow')) }}
				</div>
			</div>
		@else
			<div id="link-fb" class="milestone-block complete">
				<div class="header">
					100 Evercoin
				</div>
				<div class="body">
					{{ HTML::image('img/link-fb.png', 'link-user', ['class' => 'milestone-img'])}}
					
					<strong>Link Facebook</strong>
					
				</div>
				<div class="footer">
					<div class="complete">
						{{ HTML::image('img/complete-tick.png', 'complete-tick', ['class' => 'complete-img'])}}
						<strong>COMPLETE</strong>
					</div>
				</div>
			</div>
		@endif

		@if(!$tw)
			<div id="link-twitter" class="milestone-block">
				<div class="header">
					100 Evercoin
				</div>
				<div class="body">
					{{ HTML::image('img/link-twitter.png', 'link-user', ['class' => 'milestone-img'])}}
					
					<strong>Link Twitter</strong>
					
				</div>
				<div class="footer">
					<p>Your account is not linked</p>
					{{ HTML::linkRoute('twitter', 'Link to Twitter', null , array('class' => 'milestone-btn btn-yellow')) }}
				</div>
			</div>
		@else
			<div id="link-twitter" class="milestone-block complete">
				<div class="header">
					100 Evercoin
				</div>
				<div class="body">
					{{ HTML::image('img/link-twitter.png', 'link-user', ['class' => 'milestone-img'])}}
					
					<strong>Link Twitter</strong>
					
				</div>
				<div class="footer">
					<div class="complete">
						{{ HTML::image('img/complete-tick.png', 'complete-tick', ['class' => 'complete-img'])}}
						<strong>COMPLETE</strong>
					</div>
				</div>
			</div>
		@endif

		<div class="milestone-refer">
			<div class="milestone-block refer">
				<div class="header">
					500 Evercoins
				</div>
				<div class="body">
					<br>
					<strong>Refer Friends</strong>
					<br>
					<p>Refer 3 friends to claim<br> 500 Evercoins*</p>
					<span class="highlight">{{  $numReferrals }}/3</span>

					
				</div>
				<div class="footer">
					<span>Friends Referred</span>
				</div>
			</div>
			<div class="milestone-refer-wrap">
				<h4>Refer a Friend</h4>
				<p>Enter a friends email address below and they&apos;ll be sent a referral<br> code. If they then register with Evercise using the referral code,<br> they&apos;ll count towards your 500 Evercoin total. They will also recieve a evercoin for using your referral</p>
				{{ Form::open(array('id' => 'send_invite', 'url' => 'referrals', 'method' => 'POST', 'class' => 'create-form milestone-form')) }}
					{{ Form::label( 'referee_email', 'Email') }}
					{{ Form::text( 'referee_email' , '', array('id' => 'referee_email','placeholder' => 'Enter friends email address')) }}
					{{ Form::submit('Send Code' , array('class'=>'btn btn-yellow ')) }}
				{{ Form::close() }}
			</div>
			<small>*Friends must create a vaild account </small>
		</div>

	</div>
	
</div>
	

{{--
<p>Pending invites</p>
@foreach($referrals as $r_key => $referral)
	@if( ! $referral->referee_id)
		<div>
			{{ $referral->email }}
		</div>
	@endif
@endforeach
<br>
<p>Accepted invites</p>
@foreach($referrals as $r_key => $referral)
	@if($referral->referee_id)
		<div>
			{{ $referral->email }}
		</div>
	@endif
@endforeach
--}}
