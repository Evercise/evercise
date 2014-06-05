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
                $('.container').append(data);
                login();
             }
        );
        return false;
    });
}
registerInitFunction(initLogin, true);

function initUsers()
{
    trace('initUsers');

    $( ".datepicker" ).datepicker({
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

    // create a new user
 
    $( '#user_create' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
        // post to sontroller
        $.post(
            $( this ).prop( 'action' ),
            {
                "display_name": $( '#display_name' ).val(),
                "first_name": $( '#first_name' ).val(),
                "last_name": $( '#last_name' ).val(),
                "dob": $( '#Dob' ).val(),
                "email": $( '#email' ).val(),
                "password": $( '#password' ).val(),
                "password_confirmation": $( '#password_confirmation' ).val(),
                "gender": $( '#gender' ).val(),
                "userNewsletter": $( '#userNewsletter' ).val()
            },
            function( data ) {
                trace("about to win.......");
                if (data.validation_failed == 1)
                {
                    trace('loose');
                    // show validation errors
                    var arr = data.errors;
                    var scroll = false;
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
                    $('.success_msg').show();
                    setTimeout(function() {
                        window.location.href = data;
                    }, 1000);
                    //trace(data);
                }
            },
            'json'
        );
        return false;
    });



    // Reset password
 
    $( '#passwords_reset' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
        // post to sontroller
        $.post(
            $( this ).prop( 'action' ),
            {
                "email": $( '#email' ).val(),
                "password": $( '#password' ).val(),
                "password_confirmation": $( '#password_confirmation' ).val(),
                "code": $( '#code' ).val()
            },
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

    $('#userNewsletter').on('change', function () {
      this.value = this.checked ? 'yes' : 'no';
    }).change();
}
registerInitFunction(initUsers);

function login(){

    // login
    $( '#login_wrap form' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
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


