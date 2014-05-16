//Sessions.js
function initSessions()
{
   // $( '#newsession' ).on( 'submit', function() {
    $(document).on('submit', '#newsession' , function() {

        alert('dick');
        // post to sontroller
        $.post(
            $( this ).prop( 'action' ),
            {
                "evercisegroup": $( '#evercisegroup' ).val(),
                "date": $( '#date' ).val()
            },
            function( data ) {
                console.log("about to win.......");
                if (data.validation_failed == 1)
                {
                    console.log('loose');
                    $('#ajax-loading').hide();
                }else{
                    // redirect to login page
                    /*$('.success_msg').show();
                    setTimeout(function() {
                        window.location.href = data;
                    }, 1000);*/
                    console.log("data: "+data);
                }
            },
            'json'
        );
        return false;
    });

}
registerInitFunction(initSessions);