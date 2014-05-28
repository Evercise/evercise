function initCreateTrainer()
{

    if(typeof laracasts !== 'undefined')
    {
    	if(typeof laracasts.titles !== 'undefined')
    	{
    		titles = JSON.parse(laracasts.titles);

    	    $('#discipline').on('change', function () {
    			var currentTitles = titles[this.value];
    			$("#title").empty();

    			for(var i=0; i<currentTitles.length; i++)
    			{
    			    $("#title").append($("<option></option>").attr("value", currentTitles[i]).text(currentTitles[i]));
    			}
    	    }).change();
        }
	}

    // create a new trainer
 
    $( '#trainer_create' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
        // post to sontroller
        $.post(
            $( this ).prop( 'action' ),
            {
                "discipline": $( '#discipline' ).val(),
                "title": $( '#title' ).val(),
                "bio": $( '#bio' ).val(),
                "image": $( '#thumbFilename' ).val(),
                "website": $( '#website' ).val(),

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
                    }, 100);
                    //trace(data);
                }
            },
            'json'
        );
        return false;
    });
}
registerInitFunction(initCreateTrainer);


function initSessionNew()
{

    // Open Create Session Window
 
    $( '#session_new' ).on( 'submit', function() {
        $('.error-msg').remove();
        $('input').removeClass('error');
        // post to sontroller
        $.post(
            $( this ).prop( 'action' ),
            {
                "evercisegroup": $( '#evercisegroup' ).val()

            },
            function( data ) {
                trace("about to win.......");
                if (data.validation_failed == 1)
                {
                    trace('loose');
                    var arr = data.errors;
                }else{
                    /*setTimeout(function() {
                        window.location.href = data;
                    }, 100);*/
                    trace(data);
                }
            },
            'json'
        );
        return false;
    });

}
//registerInitFunction(initSessionNew);

