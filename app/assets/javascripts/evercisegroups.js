//Evercisegroups.js
jQuery( document ).ready( function( $ ) {

    if(typeof laracasts !== 'undefined')
    {
        if(typeof laracasts.categoryDescriptions !== 'undefined')
        {
            categoryDescriptions = JSON.parse(laracasts.categoryDescriptions);
            // TODO -  This is here ready to add the little rollover descriptions to the category selections.
        }
    }

    // create a new evercisegroup
 
    $( '#evercisegroup_create' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
        // post to controller
        $.post(
            $( this ).prop( 'action' ),
            {
                "classname": $( '#classname' ).val(),
                "description": $( '#description' ).val(),
                "category": $( '#category' ).val(),
                "duration": $( '#duration' ).val(),
                "maxsize": $( '#maxsize' ).val(),
                "price": $( '#price' ).val(),
                "image": $( '#thumbFilename' ).val(),
                "address": $( '#street' ).val() + ' '+ $( '#street' ).val(),
                "city": $( '#city' ).val(),
                "postcode": $( '#postcode' ).val(),
                "lat": $( '#latbox' ).val(),
                "long": $( '#lngbox' ).val()
            },
            function( data ) {
                if (data.validation_failed == 1)
                {
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
                    }, 1000);;
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
             }
        );
        return false;

    });


    //$('#calendar a').attr('href', 'sessions/create');

    $('#calendar a').click(function(){
        console.log(this.id);
        var year = $('#year').val();
        var month = $('#month').val();
        var date = this.id.replace('day_', '');
        var evercisegroupId = $('#evercisegroupId').val();

        var completeDate = date+'-'+month+'-'+year;

        console.log(completeDate);

        var url = 'sessions/create';
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(
            function(data) {
                $('.mask').show();
                $('.container').append(data);
                $('#s-year').val(year);
                $('#s-month').val(month);
                $('#s-date').val(date);
                $('#s-evercisegroupId').val(evercisegroupId);
                $('#complete-date').html(completeDate);
                console.log('id: '+ evercisegroupId);
             }
        );
        return false;
    });



});