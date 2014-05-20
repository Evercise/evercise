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


function updateNewSessionFields()
{
  $("#session-class-price span").html( $("#s-price").val() );
  $("#session-class-duration span").html( $("#s-duration").val() );

  updateTimeFields();
}

function session_overview() {

    // update start and end time on changing of tim dropdown
    
    $('select.time-box').on('change', function(){
        updateTimeFields();
    });

    initSlider('{"name":"s-price","min":0,"max":99,"step":0.5,"value":1}');
    initSlider('{"name":"s-duration","min":0,"max":100,"step":5,"value":5, "callback":"updateNewSessionFields" }');

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

    var date = new Date(dt);

    date.setMinutes(date.getMinutes());

    start_time = date.getHours(date)+":"+(date.getMinutes(date)<10?"0":"") + date.getMinutes(date);

    $('#session-start-time span').html(start_time);

    date.setMinutes(date.getMinutes()+dur);

    end_time = date.getHours(date)+":"+(date.getMinutes(date)<10?"0":"") + date.getMinutes(date); 

    $('#session-end-time span').html(end_time);
}
