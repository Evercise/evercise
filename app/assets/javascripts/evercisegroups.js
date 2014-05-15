// evercisegroups.js
function initEverciseGroups()
{

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

    bindCalendar();
}

registerInitFunction(initEverciseGroups);

function bindCalendar()
{

    // Bring up new session view, based on date selected
    $('#calendar .calendar-row a').click(function(){
        var year = $('#year').val();
        var month = $('#month').val();
        var href = $(this).attr('href');
        var date = href.replace('day_', '');
        var evercisegroupId = $('#evercisegroupId').val();
        var originalPrice =  $('#originalprice').val();
        var completeDate = date+'-'+month+'-'+year;


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
                $('#price').val(originalPrice);
                $('#complete-date span').html(completeDate);
             }
        );

        return false;
    });

    // Change month of calendar
    $('#calendar .calendar-head a').click(function(){
        console.log("ID: "+this.id);

        var monthyear = this.id.split("_");
        var month = monthyear[1].split("-")[0];
        var year = monthyear[1].split("-")[1];

        $('#month').val(month);
        $('#year').val(year);

        var url = 'widgets/calendar';
        $.ajax({
            url: url,
            type: 'POST',
            data: 'month='+month+'&year='+year,
            dataType: 'html'
        })
        .done(
            function(data) {
                //console.log('id: '+ data);
                $('.hub-calendar-wrapper').html(data);
                bindCalendar();
             }
        );

        return false;
    });
}
