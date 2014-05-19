//Sessions.js
function initSessions()
{
   // $( '#newsession' ).on( 'submit', function() {
    $(document).on('submit', '#newsession' , function() {

        // post to controller
        $.post(
            $( this ).prop( 'action' ),
            {
                "s-evercisegroupId": $( '#s-evercisegroupId' ).val(),
                "s-year": $( '#s-year' ).val(),
                "s-month": $( '#s-month' ).val(),
                "s-date": $( '#s-date' ).val(),
                "s-time-hour": $( '#s-time-hour' ).val(),
                "s-time-minute": $( '#s-time-minute' ).val(),
                "s-price": $( '#s-price' ).val()
            },
            function( data ) {
                debugOutput("about to win.......");
                if (data.validation_failed == 1)
                {
                    debugOutput('loose: '+data);
                    var arr = data.errors;
                    $.each(arr, function(index, value)
                    {
                        if (value.length != 0)
                        {
                           debugOutput( value );
                        }
                    });

                    $('#ajax-loading').hide();
                }else{
                    // redirect to login page
                    /*$('.success_msg').show();
                    setTimeout(function() {
                        window.location.href = data;
                    }, 1000);*/
                    debugOutput("data: "+data);
                }
            },
            'json'
        );
        return false;
    });

}
registerInitFunction(initSessions);