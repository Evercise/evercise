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
					$('#redeem').val(redeem + 10);
				};
				
		} )

		$(document).on('click' , '.redeem-btn.down', function(){
			var redeem = parseInt($('#redeem').val());
				if (redeem > 0) {
					$('#redeem').val(redeem - 10);
				}
		} )
		$('#redeem').on('keypress', function(e){
            var redeem = parseInt($('#redeem').val());

            if(e.which != 8 && isNaN(String.fromCharCode(e.which))){
                event.preventDefault();
            };
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

        $('#p_first').keypress(function(event){
            console.log(event.which);
            if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                event.preventDefault();
            }});
	};


}

registerInitFunction('initRedeemEvercoin');

function isInteger(n) {
    return /^[0-9]+$/.test(n);
}

function paidWithEvercoins(data)
{
	$('.mask').hide();
    trace('paidWithEvercoins : '+data.usecoins);
    trace('amountRemaining : '+data.amountRemaining);


    $('#evercoin-redeemed').html(data.usecoins);
    $('#balance-to-pay').html(data.amountRemaining);

}