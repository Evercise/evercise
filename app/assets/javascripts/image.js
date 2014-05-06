/*$(document).ready(function() {

    $( '#upload' ).on( 'submit', function() {

        // post to sontroller
            console.log($( '#image' ).val());
        $.post(
            $( this ).prop( 'action' ),
            {
                "image": $( '#image' ).val()
            },
            function( data ) {
                console.log("about to win.......");
                if (data.validation_failed == 1)
                {
                    console.log('loose');
                }else{
                    // redirect to login page
                    //$('.success_msg').show();
                    //setTimeout(function() {
                    //    window.location.href = data;
                    //}, 1000);
                    console.log(data);
                }
            },
            'json'
        );
        return false;
    });
});
*/


$(document).ready(function() {
    var options = { 
        beforeSubmit:  showRequest,
        success:       showResponse,
        dataType: 'json' 
        }; 
     $('body').delegate('#image','change', function(){
         $('#upload').ajaxForm(options).submit();   
        console.log("uploading..");       
     }); 
});        
function showRequest(formData, jqForm, options) { 
   // $("#validation-errors").hide().empty();
   // $("#output").css('display','none');
    return true; 
} 
function showResponse(response, statusText, xhr, form)  { 
    if(response.success == false)
    {
        var arr = response.errors;
        $.each(arr, function(index, value)
        {
            if (value.length != 0)
            {
                $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
            }
        });
        $("#validation-errors").show();
    } else {
        // $("#output").html("<img src='"+response.file+"' />");
        // $("#output").css('display','block');
        console.log(response);
        //console.log(form);
    }
}


