<div class="pay-with-evercoins">
	<div class="evercoin-block" >
		{{ HTML::image('img/evercoin.png', 'evercoin', ['class' => 'evercoin-icon'])}}
	</div>
	<div class="evercoin-wrap">
		<p>Your current Evercoin balance is : <span class="evercoin-highlight">{{ HTML::image('img/evercoin.png', 'evercoin', ['class' => 'evercoin-icon'])}} {{ $evercoins }} Evercoins</span></p>
		{{ Form::open(array('id' => 'paywithevercoinsform', 'url' => 'sessions/'.$evercisegroupId.'/paywithevercoins', 'method' => 'POST', 'class' => 'update-form')) }}
			
			<div class="evercoin-redeem">
				
				
					{{ Form::label( 'redeem', 'Evercoins to redeem against this purchase') }}
					<div class="redeem-btn up">
						{{ HTML::image('img/up-arrow.png', 'evercoin', ['class' => 'up-arrow'])}}
					</div>

					{{ Form::text( 'redeem' ,0  , array(  'placeholder' => 'redeem' ,'id' => 'redeem')) }}
					<div class="redeem-btn down">
						{{ HTML::image('img/down-arrow.png', 'evercoin', ['class' => 'down-arrow'])}}
					</div>

			</div>
			{{ Form::submit('Redeem Evercoins' , array('class'=>'btn btn-yellow ')) }}
		{{ Form::close() }}
	</div>
	

</div>

