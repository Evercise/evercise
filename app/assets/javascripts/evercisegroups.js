// evercisegroups.js

function initEvercisegroups()
{
    trace('initEvercisegroups');

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
                        trace(value);
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

    $('.hub-block .btn-red').click(function(){
        var href = $(this).attr('href');

        console.log('delete '+href);

        var url = href;
        $.ajax({
            url: url,
            type: 'POST',
            data: '',
            dataType: 'html'
        })
        .done(
            function(data) {
                trace(data);
                $('.mask').show();
                $('.container').append(data);
                bindDelete();
             }
        );

        return false;
    });

    bindCalendar();

    //$('.date-list a.session-delete').click(function(){
    $(document).on('click','.date-list a.session-delete', function(){
        var url = $(this).attr('href');
        var EGindex = $(this).attr('EGindex');
        //trace('EGindex: '+EGindex);
        //trace("deleting session.. "+url);
        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'html',
            data: 'EGindex='+EGindex
        })
        .done(
            function(data) {
                $('#date-list-'+EGindex).html(data);
             }
        );

        return false;
    });
}
registerInitFunction(initEvercisegroups);

function bindDelete()
{
    $('#delete_evercisegroup').click(function(){
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'html'
        })
        .done(
            function(data) {
                trace(data);
                //$('.mask').show();
                //$('.container').append(data);

                setTimeout(function() {
                    window.location.href = data;
                }, 1000);
             }
        );

        return false;
    });
}

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
        //var completeDate = date+'-'+month+'-'+year;
        var session_class_name = $('#evercisegroupName').val();
        var evercisegroupDuration = $('#evercisegroupDuration').val();


        var url = 'sessions/create';
        $.ajax({
            url: url,
            type: 'GET',
            data: 'year='+year+'&month='+month+'&date='+date+'&evercisegroupId='+evercisegroupId+'',
            dataType: 'html'
        })
        .done(
            function(data) {
                $('.mask').show();
                $('.container').append(data);
                // $('#s-year').val(year);
                // $('#s-month').val(month);
                // $('#s-date').val(date);
                //$('#s-evercisegroupId').val(evercisegroupId);
                //$('#s-evercisegroupDuration').val(evercisegroupDuration);
                //$('#price').val(originalPrice);
                //$('#complete-date span').html(completeDate);
                //$('#session-class-name span').html(session_class_name);
                //$('#session-class-price span').html(originalPrice);
                session_overview();
             }
        );

        return false;
    });

    // Change month of calendar
    $('#calendar .calendar-head a').click(function(){
        var monthyear = this.id.split("?")[1];
        var year = monthyear.split("&")[0].split("=")[1];
        var month = monthyear.split("&")[1].split("=")[1];
        //trace("ID: "+month);

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
                //trace('id: '+ data);
                $('#calendar-wrapper').html(data);
                bindCalendar();
             }
        );

        return false;
    });
}

//1400235562274 
