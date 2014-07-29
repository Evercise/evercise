
function initVenues()
{
	//trace('initVenues');
    //$( '#new_venue_button' ).on( 'click', function() {
    $(document).on('click', '#new_venue_button' , function() {
        //trace($('#venue_create_form').css('display'));

        initToolTip();

        if ($('#venue_create_form').css('display') == 'block')
        {
            if($('#venue option').length)
                $('#edit_venue_button').removeClass('disabled');
            $('#new_venue_button').removeClass('btn-red').addClass('btn-yellow').html('Create new Venue');
            $('#venue_create_form').slideToggle(600);
        }
        else
        {
            $('#edit_venue_button').addClass('disabled');
            $('#new_venue_button').removeClass('btn-yellow').addClass('btn-red').html('Cancel');

            getView('../venues/create', function(data){
                $('#venue').val('');
                MapWidgetloadScript();
                $('#venue_create_form').html(data);
                $('#venue_create_form').slideToggle(600/*, function(){initCheckboxes();}*/);
                $('input[name=_method]').remove();
                $('#venue_create').attr('action', '../venues');
                
            });
        }
    });
	//$( '#edit_venue_button' ).on( 'click', function() {
    $(document).on('click', '#edit_venue_button' , function() {
		//trace($('#venue_create_form').css('display'));
        //trace('edit');

		if ($('#venue_create_form').css('display') == 'block')
		{
            $('#new_venue_button').removeClass('disabled');
			$('#edit_venue_button').removeClass('btn-red').addClass('btn-blue').html('Edit Venue');
        	$('#venue_create_form').slideToggle(600);
		}
		else
		{
            $('#new_venue_button').addClass('disabled');
			$('#edit_venue_button').removeClass('btn-blue').addClass('btn-red').html('Cancel');

            venueId = $('#venue').val();
            trace(venueId);
	        getView('../venues/'+venueId+'/edit', function(data){
	        	MapWidgetloadScript();
	        	$('#venue_create_form').html(data);
                $('#venue_create_form').slideToggle(600/*, function(){initCheckboxes();}*/);
                $('#venue_create').append('<input name="_method" type="hidden" value="PUT">');
	        	$('#venue_create').attr('action', '../venues/'+venueId);
	        	
	        });
	    }
	});

	$( '#venue_create' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
        $('.venue_success_msg').hide();
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
                    $('.venue_success_msg').show();
                    setTimeout(function() {
                        trace('create venue success');
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
registerInitFunction('initVenues');

