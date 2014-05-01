jQuery( document ).ready( function( $ ) {

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

    // login pop up
    $("#login").click(function(e){
        $.ajax({
            url: "/auth/login",
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

    $(document).on('click','#cancel_login',function(){
        $('.mask').hide();
        $('.login_wrap').remove();
    })

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
                console.log("about to win.......");
                if (data.validation_failed == 1)
                {
                    console.log('loose');
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
                    //console.log(data);
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
                console.log("about to win.......");
                if (data.validation_failed == 1)
                {
                    console.log('loose');
                    // show validation errors
                    var arr = data.errors;
                    var scroll = false;
                    console.log(arr);
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
                    console.log(data);
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
});

function login(){
    // login
    $( '#login_wrap form' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
        // post to controller
        $.post(
            $( this ).prop( 'action' ),
            {
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
                    }, 2000);
                }
            },
            'json'
        );
        return false;
    });

}


