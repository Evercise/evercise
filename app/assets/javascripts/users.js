//Users.js

function initLogin()
{
    // login pop up
    $(".login").click(function(e){
        var url = this.href;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(
            function(data) { 
                $('.mask').show();
                $('.lower_footer').append(data);
                login();
             }
        );
        return false;
    });
}
registerInitFunction('initLogin', true);

function initUsers()
{

    $('.datepicker').each(function(){
        $( this ).datepicker({
          dateFormat: "yy-mm-dd" ,
          defaultDate: "-30y",
          yearRange: "-100:+0", 
          minDate: '-120y', 
          maxDate: '-16y',
          changeMonth: true,
          changeYear: true,
          showOtherMonths: true,
          selectOtherMonths: true
        });
    });
    

    // Reset password
    $( '#passwords_reset' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');

        $.post(
            $( this ).prop( 'action' ),
           /* {
                "email": $( '#email' ).val(),
                "password": $( '#password' ).val(),
                "password_confirmation": $( '#password_confirmation' ).val(),
                "code": $( '#code' ).val()
            },
            */
            $( this ).serialize(),
            function( data ) {
                trace("about to win.......");
                if (data.validation_failed == 1)
                {
                    trace('loose');
                    // show validation errors
                    var arr = data.errors;
                    var scroll = false;
                    trace(arr);
                    $.each(arr, function(index, value)
                    {
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
                    trace(data);
                    window.location.href = data;
                }
            },
            ''
        );
        return false;
    });


    $('.checkbox').on('change', function () {
      this.value = this.checked ? 'yes' : 'no';
    }).change();
}
registerInitFunction('initUsers');

/*function initChangePassword()
{
    // Change password
    $( '#password_change' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
        var form = $(this);

        $.post(
            $( this ).prop( 'action' ),
             $( this ).serialize(),
            function( data ) {
                trace("Sending data (reset password) ...");
                if (data.validation_failed == 1)
                {
                    trace('loose');
                    // show validation errors
                    var arr = data.errors;
                    var scroll = false;
                    trace(arr);
                    $.each(arr, function(index, value)
                    {
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

                    if (data['result'] == 'changed')
                    {
                        trace('success message showing');
                        form.find('.success_msg').show();
                    }
                    setTimeout(function() {
                        window.location.href = '';
                    }, 300);
                }
            },
            'json'
        );
        return false;
    });
}
registerInitFunction(initChangePassword);*/


function login(){

    // login
    $( '#login_wrap form' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
        $('textarea').removeClass('error');
        // post to controller
        $.post(
            $( this ).prop( 'action' ),
            {
                "redirect_after_login": $( '#login_wrap  #redirect_after_login' ).val(),
                "redirect_after_login_url" : $( '#login_wrap  #redirect_after_login_url' ).val(),
                "email": $( '#login_wrap #email' ).val(),
                "password": $( '#login_wrap #password' ).val()
            },
            function( data ) {
                if (data.validation_failed == 1)
                {
                    // show validation errors
                    var arr = data.errors;
                    $("#login_wrap").append('<span class="error-msg">' + arr + '</span>');
                    $('#ajax-loading').hide();
                }else{
                    // redirect to login page
                    $('.success_msg').show();
                    setTimeout(function() {
                       window.location.href = data;
                       trace(data);
                    }, 20);
                }
            },
            'json'
        );
        return false;
    });

}


