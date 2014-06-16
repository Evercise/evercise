function initAddRating()
{

	$(".list-staradd span").on({
	    mouseenter: function () {
	        var rating = $(this).data('rating');
			for (var i = 0; i <= rating ; i++) {
				$('span[data-rating='+i+']').addClass('full');
			};
	    },
	    mouseleave: function () {
	        $(".list-staradd span").removeClass('full');
	    }
	});
}

registerInitFunction(initAddRating);