
function initEverciseGroups()
{
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
                    $('.success_msg').show();
                    /*setTimeout(function() {
                        window.location.href = data;
                    }, 1000);;*/
                }
            },
            'json'
        );
        return false;
    });
}
registerInitFunction(initEverciseGroups);