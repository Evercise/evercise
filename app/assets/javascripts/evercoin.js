function initRedeemEvercoin(params)
{

	evercoinParams = JSON.parse(params);

 	var evercoinBalance = evercoinParams.balance;
 	var priceInEvercoins = evercoinParams.priceInEvercoins;

 	trace(priceInEvercoins);
 	if (evercoinBalance > 0) {
		$(document).on('click' , '.redeem-btn.up', function(){
			var redeem = parseInt($('#redeem').val());

				if (redeem < evercoinBalance && redeem < priceInEvercoins) {
					$('#redeem').val(redeem + 1);
				};
				
		} )

		$(document).on('click' , '.redeem-btn.down', function(){
			var redeem = parseInt($('#redeem').val());
				if (redeem > 0) {
					$('#redeem').val(redeem - 1);
				}
		} )
		$('#redeem').on('keyup', function(){
			var redeem = parseInt($('#redeem').val());
			if (redeem >= evercoinBalance && redeem < priceInEvercoins) {
				$('#redeem').val(evercoinBalance);
			}
			if (redeem >= priceInEvercoins && evercoinBalance >= priceInEvercoins){
				$('#redeem').val(priceInEvercoins);
			}
			if (redeem >= priceInEvercoins && evercoinBalance < priceInEvercoins){
				$('#redeem').val(evercoinBalance);
			}
		})
	};


}

registerInitFunction('initRedeemEvercoin');

function paidWithEvercoins(data)
{
	$('.mask').hide();
    trace('paidWithEvercoins : '+data.usecoins);
    trace('amountRemaining : '+data.amountRemaining);


    $('#evercoin-redeemed').html(data.usecoins);
    $('#balance-to-pay').html(data.amountRemaining);

}