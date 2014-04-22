jQuery( document ).ready( function( $ ) {
 
    $( '#user_create' ).on( 'submit', function() {
        $('.error_msg').remove();
        $('input').removeClass('error');
 
        $.post(
            $( this ).prop( 'action' ),
            {
                "display_name": $( '#display_name' ).val(),
                "first_name": $( '#first_name' ).val(),
                "last_name": $( '#last_name' ).val(),
                "email": $( '#email' ).val(),
                "password": $( '#password' ).val(),
                "password_confirmation": $( '#password_confirmation' ).val(),
                "gender": $( '#gender' ).val()
            },
            function( data ) {
                if (data.validation_failed == 1)
                {
                    var arr = data.errors;
                    $.each(arr, function(index, value)
                    {
                        if (value.length != 0)
                        {
                           $("#" + index).addClass('error');
                           $('html, body').animate({ scrollTop: $("#" + index).offset().top }, 400);;
                           $("#" + index).after('<span class="error_msg">' + value + '</span>');
                        }
                    });
                    $('#ajax-loading').hide();
                }else{
                    console.log(data);
                }
            },
            'json'
        );
        return false;
    });
});


