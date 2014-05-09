//Evercisegroups.js
jQuery( document ).ready( function( $ ) {

    if(typeof laracasts !== 'undefined')
    {
        if(typeof laracasts.categoryDescriptions !== 'undefined')
        {
            categoryDescriptions = JSON.parse(laracasts.categoryDescriptions);
            console.log(categoryDescriptions);
            // TODO -  This is here ready to add the little rollover descriptions to the category selections.
        }
    }

    // create a new evercisegroup
 
    $( '#evercisegroup_create' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
        // post to sontroller
        $.post(
            $( this ).prop( 'action' ),
            {
                "classname": $( '#classname' ).val(),
                "description": $( '#description' ).val(),
                "category": $( '#category' ).val(),
                "duration": $( '#duration' ).val(),
                "maxsize": $( '#maxsize' ).val(),
                "price": $( '#price' ).val(),
                "image": $( '#thumbFilename' ).val()
            },
            function( data ) {
                console.log("about to win.......");
                if (data.validation_failed == 1)
                {
                    console.log('loose');
                    // show validation errors
                    var arr = data.errors;
                    var scroll = false;
                    $.each(arr, function(index, value)
                    {
                        console.log(value);
                        if (scroll == false) {
                            //$('html, body').animate({ scrollTop: $("#" + index).offset().top }, 400);
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
                    // redirect to login page
                    $('.success_msg').show();
                    setTimeout(function() {
                        window.location.href = data;
                    }, 1000);
                    console.log(data);
                }
            },
            'json'
        );
        return false;
    });


    $('.add_session').click(function(){
        var evercisegroupId = this.id;
        //console.log(evercisegroupId);

        var url = this.href;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(
            function(data) { 
                $('.mask').show();
                $('.container').append(data);
                $('#evercisegroup').val(evercisegroupId);
                console.log('id: '+ $('#evercisegroup').val());
             }
        );
        return false;

    });



});