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

    $('.hub-block #delete_group').click(function(){
        var url = $(this).attr('href');

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
                //initChart('total-members-bookings-'+EGindex); // This was causing an error
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

/*    $(document).on('click','.btn-join-session,.undo-btn-reverse',function(){

        var sessionId = $(this).data('session');

        var sessionPrice = $(this).data('price');

        sessions.push(sessionId);
        var session = JSON.stringify(sessions);

        // add session id's to hidden  field in form
        $('#session-ids').val(session);
        // change button to undo button depending on existing button

        if($(this).attr('class') == 'undo-btn-reverse'){
           $(this).replaceWith('<button data-price="'+sessionPrice+'" data-session="'+sessionId+'" class="btn-cancel-session btn btn-red">Cancel</button>');
        }else{
          $(this).replaceWith('<button class="undo-btn" data-price="'+sessionPrice+'" data-session="'+sessionId+'" ><img src="/img/undo.png" alt="undo"><span>Undo</span></button>');
        }
        
        ++total;

        price = price + parseFloat(sessionPrice);

        $('#total-sessions').html(total);
        $('#total-price').html(price);

        if (total > 0) {
            $('#session-checkout').removeClass('disabled');
        };
    });*/

    $(document).on('click','.btn-join-session,.undo-btn-reverse',function(){

        var sessionId = $(this).data('session');

        var sessionPrice = $(this).data('price');

        // add session id's to hidden  field in form
        $('#session-id').val(sessionId);
        // change button to undo button depending on existing button

        if($(this).attr('class') == 'undo-btn-reverse'){
           $(this).replaceWith('<button data-price="'+sessionPrice+'" data-session="'+sessionId+'" class="btn-cancel-session btn btn-red">Cancel</button>');
        }else{
          $(this).replaceWith('<button class="undo-btn" data-price="'+sessionPrice+'" data-session="'+sessionId+'" ><img src="/img/undo.png" alt="undo"><span>Undo</span></button>');
        }

        ++total;

        price = price + parseFloat(sessionPrice);

        $('#total-sessions').html(total);
        $('#total-price').html(price);

        if (total > 0) {
            $('#session-checkout').removeClass('disabled');
        };

        $('#add-to-cart').submit();
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

     $(document).on('click','#expand-sessions' , function(){
        $(this).find('.extra').toggleClass('hidden');
        $('.session-list-row.extra').toggleClass('hidden');

        /* remove click event so that the offsets dont stack for the page scrolling */
         $('a[href*=#]').each(function() {
            $(this).unbind('click');
         });

       initScrollAnchor();
    });



     $('#join-sessions').submit(function(event){
        event.preventDefault();


        var url = '/auth/checkout';
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'html',
            data: $( this ).serialize()
        })
        .done(
            function(data) {
                try
                {
                    var parsedData = JSON.parse(data);
                    trace(parsedData.status);
                    if (parsedData.status == 'logged_in')
                    {
                        $(event.currentTarget).unbind('submit');
                        event.currentTarget.submit();
                    }
                }
                catch(e)
                {
                    $('.mask').show();
                    $('.lower_footer').append(data);
                    login();
                }
             }
        );
        return false;
    });
}

registerInitFunction('initJoinEvercisegroup');

function initClassBlock(){
    $(document).on('click', '#more-sessions', function(){

        $(this).closest('div').find('.future-session-list').slideToggle(300);
        $(this).closest('div').find('#block-body-wrap').slideToggle(300);
        $(this).toggleClass('active');
    })
}
registerInitFunction('initClassBlock');

