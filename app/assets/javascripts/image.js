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
        $('#image-upload').html(response.crop);
        $('.preview img').attr('src', response.image_url);
        $('#img-crop img').attr('src', response.image_url);
        $('#upload').attr('action', response.postCrop);
        initCrop();
        postCroppedImage();
    }
}

function initCrop()
{
    $('#img-crop img').imgAreaSelect({
        aspectRatio: '1:1',
        fadeSpeed: 300,
        handles: true,
        onSelectEnd: saveCroppedImage,
        onSelectChange: preview
    });
}

function preview(img, selection) {
    if (!selection.width || !selection.height)
        return;

    var previewX = $('.preview').width();
    var previewY = $('.preview').height();

    console.log(previewX+' - '+previewY);
    
    var scaleX = previewX / selection.width;
    var scaleY = previewY / selection.height;

    $('.preview img').css({
        width: Math.round(scaleX * img.width),
        height: Math.round(scaleY * img.height),
        marginLeft: -Math.round(scaleX * selection.x1),
        marginTop: -Math.round(scaleY * selection.y1)
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
   $( '#upload' ).on( 'submit', function() {

    // post to sontroller
    $.post(
        $( this ).prop( 'action' ),
        {
            "pos_x": $( '#pos_x' ).val(),
            "pos_y": $(  '#pos_y' ).val(),
            "width": $(  '#width' ).val(),
            "height": $(  '#height' ).val(),
            "img_url": $(  '#img_url' ).val(),
            "label": $(  '#label' ).val(),
            "img_height": $(  '#img_height' ).val()
        },
        function( data ) {
            console.log("about to win.......");
            if (data.validation_failed == 1)
            {
                console.log('loose');
               
            }else{
                $('#img-crop img').imgAreaSelect({
                    remove: true
                });
                $('#upload_wrapper').html(data.uploadView);
                $('.preview img').attr('src', data.newImage);
                $('#thumbFilename').val(data.thumbFilename);
               
            }
        },
        'json'
    );
    return false;
    }); 
}
