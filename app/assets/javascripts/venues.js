
function initVenues()
{
	trace('initVenues');
	$( '#new_venue_button' ).on( 'click', function() {
		//trace($('#venue_create_form').css('display'));

		if ($('#venue_create_form').css('display') == 'block')
		{
			$('#new_venue_button').removeClass('btn-red').addClass('btn-blue').html('Create new Venue');
        	$('#venue_create_form').slideToggle(600);
		}
		else
		{
			$('#new_venue_button').removeClass('btn-blue').addClass('btn-red').html('Cancel');

			if ($('#venue_create_form').html() == '')
			{
		        getView('../venues/create', function(data){
		        	MapWidgetloadScript();
		        	$('#venue_create_form').html(data);
		        	$('#venue_create_form').slideToggle(600/*, function(){initCheckboxes();}*/);
		        	
		        });
		    }
		    else
		    {
				$('#venue_create_form').slideToggle(600);
			}
	    }
	});

	$( '#venue_create' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
        // post to controller
        $.post(
            $( this ).prop( 'action' ),
            $( this ).serialize(),
            function( data ) {
                if (data.validation_failed == 1)
                {
                    // show validation errors
                    var arr = data.errors;
                    var scroll = false;
                    $.each(arr, function(index, value)
                    {
                        //trace(value);
                        if (scroll == false) {
                            $('html, body').animate({ scrollTop: $("#" + index).offset().top }, 400);
                            scroll = true;
                        };
                        if (value.length != 0)
                        {
                           $("#" + index).addClass('error');
                           $("#" + index).after('<span class="error-msg">' + value + '</span>');
                        }
                    });
                    $('#ajax-loading').hide();
                }else{
                	//trace(data.venue_id);
                   // $('.success_msg').show();
                    setTimeout(function() {
        				$('#venue_create_form').slideToggle(1000, function(){
        					$('#venue_create_form').hide();
                        	$('#venue_create_form').html('');
                        });
                        // Refresh Venues dropdown
                        getView('../venues', function(data1){
				        	$('#venue_select').html(data1);
				        	//trace(data.venue_id);
                			$('#venue').val(data.venue_id);
                			$('#new_venue_button').html('Create new Venue');
				        });
                    }, 1000);
                }
            },
            'json'
        );
        return false;
    });
}
registerInitFunction(initVenues);

