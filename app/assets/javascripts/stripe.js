function initStripe()
{
	$('.stripe-button').attr('data-amount', 900000)
}

registerInitFunction('initStripe' ,true);

