//Sessions.js


function updateNewSessionFields()
{
  $("#session-class-price span").html( $("#s-price").val() );
  $("#session-class-duration span").html( $("#s-duration").val() );

  updateTimeFields();
}

function session_overview() {

    // update start and end time on changajaxing of tim dropdown
    
    $('select.time-box').on('change', function(){
        updateTimeFields();
    });
    // keyup on price and duration fields
    $(document).on('keyup', '#s-duration, #s-price', function(){
        updateNewSessionFields();
    })
    updateTimeFields();

    initSlider('{"name":"s-price","min":1,"max":120,"step":0.5,"value":1}');
    initSlider('{"name":"s-duration","min":10,"max":240,"step":5,"value":5, "callback":"updateNewSessionFields" }');

}

function updateTimeFields()
{
    var day = $('#s-date').val();
    var month = $('#s-month').val();
    var year = $('#s-year').val();
    var hour = $('select[name="s-time-hour"]').val();
    var min = $('select[name="s-time-minute"]').val();

    var dur = parseInt($('#session-class-duration span').html());

    var dt = year+'-'+month+'-'+day+' '+hour+':'+min+':00';
    //trace(dt);
    var date =  moment(dt);

    start_time = moment(date).format('HH:mm');

    $('#session-start-time span').html(start_time);

    end_time = moment(date).add('minutes', dur).format('HH:mm');

    $('#session-end-time span').html(end_time);

}

function initSessionListDropdown()
{
    $(document).on('click', '.session-icon-view' , function(){
        
        if ($(this).closest('ul').find('.session-members-row').length === 0) return null;
        
        var alreadyOpen = 0;
        if ($(this).closest('ul').find('.session-members-list').css('display') == 'block')
            alreadyOpen = 1; 
        
        $('.session-members-list').slideUp(400 );

        if (alreadyOpen == 0)
            $(this).closest('ul').find('.session-members-list').slideToggle(400);  

        
    })
}

registerInitFunction('initSessionListDropdown');

function mailAll()
{

    trace("mail all");
    $(document).on('submit', '#mail_all, #mail_one' , function() {
        $('.error-msg').remove();
        var thisForm = $(this);
        thisForm.addClass('disabled');
        // post to controller
        $.post(
            $( this ).prop( 'action' ),
             $( this ).serialize(),
            function( data ) {
                trace("about to win.......");
                if (data.validation_failed == 1)
                {
                    trace('loose: '+data);
                    thisForm.removeClass('disabled');
                    var arr = data.errors;
                    $.each(arr, function(index, value)
                    {
                        if (value.length != 0)
                        {
                           trace( value );
                           $("#" + index).addClass('error');
                           $("#" + index).after('<span class="error-msg">' + value + '</span>');
                        }
                    });

                    $('#ajax-loading').hide();
                }else{
                    trace(data.message, true);
                    // redirect to login page
                    $('.success_msg').show();
                    setTimeout(function() {
                        $('.mask').hide();
                        $('.modal').remove();
                    }, 1000);
                }
            },
            'json'
        );
        return false;
    });
}
registerInitFunction('mailAll');
