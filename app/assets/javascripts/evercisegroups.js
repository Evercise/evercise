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
                "gender": $( '#gender' ).val(),
                // "address": $( '#street' ).val() + ' '+ $( '#street' ).val(),
                // "city": $( '#city' ).val(),
                // "postcode": $( '#postcode' ).val(),
                // "lat": $( '#latbox' ).val(),
                // "long": $( '#lngbox' ).val()
                "venue": $( '#venue' ).val()
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
                    // redirect to login page
                    $('.success_msg').show();
                    setTimeout(function() {
                        window.location.href = data;
                    }, 1000);
                }
            },
            'json'
        );
        return false;
    });

    $('.hub-block #delete_group').click(function(){
        var url = $(this).attr('href');
        console.log('delete '+url);

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

    // Also doubles as undo function
    $(document).on('click','.session-delete', function(){
        var url = $(this).attr('href');
        var EGindex = $(this).attr('EGindex');
        //trace('EGindex: '+EGindex);

        var id = $(this).attr('id');
        var undo = $(this).data('undo');
        //trace("deleting session.. "+url);
        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'html',
            data: 'EGindex='+EGindex+'&undo='+undo
        })
        .done(
            function(data) {
                //$('#date-list-'+EGindex).html(data);
                var details = $.parseJSON(data);
                if (details.mode == 'delete')
                {
                    trace(details.user_id);
                    $('#'+id).parent().addClass('session-undo');
                    $('#'+id).html('undo');
                    $('#'+id).data('undo', data);
                }
                else if (details.mode == 'undo')
                {
                    $('#'+id).parent().removeClass('session-undo');
                    $('#'+id).attr('href', 'sessions/'+details.session_id);
                    $('#'+id).html('x');
                }
                else if (details.mode == 'hack')
                {
                   trace('Did your mother never tell you not to touch over peoples stuff');
                }
                initChart('total-members-bookings-'+EGindex);
             }
        );

        return false;
    });
}
registerInitFunction('initEvercisegroups');

function initEvercisegroupsShow()
{
    
    $('.mail_all').click(function(){

        // If no members, do not open mail dialogue
        if ($(this).closest('ul').find('.session-members-row').length === 0) return false;

        var url = this.href;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(
            function(data) {
                //trace('id: '+ data);
                $('.mask').show();
                $('.container').append(data);
             }
        );

        return false;
    });
}
registerInitFunction('initEvercisegroupsShow');

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
                var details = $.parseJSON(data);
                if (details.mode == 'hack')
                {
                    loaded();
                    alert('the class you are trying to delete does not belong to you');
                }else{
                    setTimeout(function() {
                        window.location.href = details.url;
                    }, 300); 
                }                
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

function initJoinEvercisegroup(params)
{

    if (JSON.parse(params) != '1') {
        var params = JSON.parse(params);
        var sessions = params.sessions;
        var total =  params.total;
        var price =  params.price;
    }else{
       var sessions = []; 
        var total = 0;
        var price = 0;
    }

    $(document).on('click','.btn-join-session,.undo-btn-reverse',function(){

        var sessionId = $(this).data('session');

        var sessionPrice = $(this).data('price');

        sessions.push(sessionId);
        var session = JSON.stringify(sessions);

        check = checkUrlForDev();

        // add session id's to hidden  field in form
        $('#session-ids').val(session);
        // change button to undo button depending on existing button

        if($(this).attr('class') == 'undo-btn-reverse'){
           $(this).replaceWith('<button data-price="'+sessionPrice+'" data-session="'+sessionId+'" class="btn-cancel-session btn btn-red">Cancel</button>');
        }else{
          $(this).replaceWith('<button class="undo-btn" data-price="'+sessionPrice+'" data-session="'+sessionId+'" ><img src="'+check+'/img/undo.png" alt="undo"><span>Undo</span></button>');  
        }
        
        ++total;

        price = price + parseFloat(sessionPrice);

        $('#total-sessions').html(total);
        $('#total-price').html(price);

        if (total > 0) {
            $('#session-checkout').removeClass('disabled');
        };
    });

    $(document).on('click','.undo-btn' , function(){
        var sessionId = $(this).data('session');

        var sessionPrice = $(this).data('price');
        
        $(this).replaceWith('<button data-price="'+sessionPrice+'" data-session="'+sessionId+'" class="btn-join-session btn btn-yellow">Join Session</button>')
        

        sessions = jQuery.grep(sessions, function(value) {
          return value != sessionId;
        });

        var session = JSON.stringify(sessions);

        // add session id's to hidden  field in form
        $('#session-ids').val(session);
        
        --total;

        price = price - parseFloat(sessionPrice);

        $('#total-sessions').html(total);
        $('#total-price').html(price);

        if (total == 0) {
            $('#session-checkout').addClass('disabled');
        };
    });

    $(document).on('click','.btn-cancel-session' , function(){

        var sessionId = $(this).data('session');

        var sessionPrice = $(this).data('price');

        sessions = jQuery.grep(sessions, function(value) {
          return value != sessionId;
        });

        

        var session = JSON.stringify(sessions);

        // add session id's to hidden  field in form
        $('.session-ids').val(session);
        
        --total;


        price = price - parseFloat(sessionPrice);
        evercoin = $('#evercoin-redeemed').html();

        trace(evercoin);

        $('#cart-row-'+sessionId).remove();
        $('#sub-total').html(price);
        $('#balance-to-pay').html(price - evercoin);
    });


}

registerInitFunction('initJoinEvercisegroup');

function initClassBlock(){
    $(document).on('click', '#more-sessions', function(){
        $(this).closest('div').find('.future-session-list').slideToggle(200);
    })
}
registerInitFunction('initClassBlock');

