function initAddRating()
{
	var base = this;
	this.checkButton = function(id){
		if ($('#classlist_'+id+' #stars').val() > 0 && $('#classlist_'+id+' #feedback_text').val().length > 0 )
		{
			$('#classlist_'+id+' form#feedback input.btn').removeClass('disabled');
		}
		else
		{
		    $('#classlist_'+id+' form#feedback input.btn').addClass('disabled');
		}
	};

	$(".class-list-box").on({
		keyup: function () {
			var id = $(this).find('.list-staradd span').data('id');
			base.checkButton(id);
		},
		mousedown: function () {
			var id = $(this).find('.list-staradd span').data('id');
			base.checkButton(id);
		}
	});


	$(".list-staradd span").on({
	    mouseenter: function () {
	    	var id = $(this).data('id');
	    	if ($('#classlist_'+id+' #stars').val() == 0)
	    	{
	    		//trace($(this).data('id'));
		        var rating = $(this).data('rating');
				for (var i = 0; i <= rating ; i++) {
					$('#classlist_'+id+' span[data-rating='+i+']').addClass('full');
				}
			}
	    },
	    mouseleave: function () {
	    	var id = $(this).data('id');
	    	if ($('#classlist_'+id+' #stars').val() == 0)
	    	{
		        $('#classlist_'+id+' .list-staradd span').removeClass('full');
		    }
	    },
	    mousedown: function () {
	    	var id = $(this).data('id');
	    	if ($('#classlist_'+id+' #stars').val() == 0)
	    	{
		    	var rating = $(this).data('rating');
		    	$('#classlist_'+id+' #stars').val(rating);
		    	//base.checkButton(id);
		    }
			else
			{
				$('#classlist_'+id+' .list-staradd span').removeClass('full');
				var rating = $(this).data('rating');
				for (var i = 0; i <= rating ; i++) {
					$('#classlist_'+id+' span[data-rating='+i+']').addClass('full');
				}
				$('#classlist_'+id+' #stars').val(0);
		    	//base.checkButton(id);
			}
	    }
	});
	//this.checkButton(2);
}


registerInitFunction('initAddRating');
