jQuery(document).ready(function($) {
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
        console.log("showRequest..");       
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
        $('#image-upload').html(response.crop);
        $('#img-crop img').attr('src', response.image_url);
        //console.log(response.crop);
        initCrop();
        postCroppedImage();
        //console.log(form);
    }
}

function initCrop()
{
    $('#img-crop img').imgAreaSelect({
        handles: true,
        onSelectEnd: saveCroppedImage
    });
}



function saveCroppedImage(img, selection)
{
    $('#width').val(selection.width);
    $('#height').val(selection.height);
    $('#pos_x').val(selection.x1);
    $('#pos_y').val(selection.y1);
    $('#img_url').val(img.src);
    $('#img_height').val(img.height);
    //console.log($('#img_height').val());
}



function postCroppedImage()
{
   $( '#crop' ).on( 'submit', function() {
    // post to sontroller
    $.post(
        $( this ).prop( 'action' ),
        {
            "pos_x": $( '#pos_x' ).val(),
            "pos_y": $(  '#pos_y' ).val(),
            "width": $(  '#width' ).val(),
            "height": $(  '#height' ).val(),
            "img_url": $(  '#img_url' ).val(),
            "img_height": $(  '#img_height' ).val()
        },
        function( data ) {
            console.log("about to win.......");
            if (data.validation_failed == 1)
            {
                console.log('loose');
               
            }else{
                console.log(data);
                $('#img-crop').html(data.uploadView);
                initCrop();
                $('#img-crop img').imgAreaSelect({
                    hide: true
                });
            }
        },
        'json'
    );
    return false;
    }); 
}
