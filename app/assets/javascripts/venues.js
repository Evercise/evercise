
function initVenues()
{
	$( '#new_venue_button' ).on( 'click', function() {
		trace('new venue button');

        getView('../venues/create', function(data){
        	$('#venue_create_form').html(data);
        	MapWidgetloadScript();
        });

        /*var url = '../venues/create';
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(
            function(data) {
                //trace('data: '+ data);
                $('#venue_create_form').html(data);
                MapWidgetloadScript(); // Initialise map js after map widget has been placed
             }
        );

        return false;*/
	});

	$( '#venue_create' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
        // post to controller
        trace("venue create");
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
                        trace(value);
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
                	trace(data.success);
                   // $('.success_msg').show();
                    setTimeout(function() {
                        $('#venue_create_form').html('');
                        getView('../venues', function(data1){
				        	$('#venue_select').html(data1);
				        	MapWidgetloadScript();
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

function getView(url, callback)
{
    //var url = '../venues/create';
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html'
    })
    .done(
        function(data) {
            //trace('data: '+ data);
            //$('#venue_create_form').append(data);
            //MapWidgetloadScript();
            //trace('get venue select');
            //trace(data);
            //$(selector).html(data);
            callback(data);
         }
    );

    return false;
}