function initImage()
{
    var options = { 
        beforeSubmit:  showRequest,
        success:       showResponse,
        dataType: 'json' 
        }; 
     $('body').delegate('#image','change', function(){
         $('#upload').ajaxForm(options).submit();   
        debugOutput("uploading..");
     }); 
}        
registerInitFunction(initImage);

function showRequest(formData, jqForm, options) { 
   // $("#validation-errors").hide().empty();
   // $("#output").css('display','none'); 
        debugOutput("showRequest..");       
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

    $('#img-crop .btn-yellow').removeClass('disabled');
    
    if (!selection.width || !selection.height)
        return;

    var previewX = $('.preview').width();
    var previewY = $('.preview').height();

    debugOutput(previewX+' - '+previewY);
    
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
    //debugOutput($('#img_height').val());
}



function postCroppedImage()
{
    $('#cancel_upload').click(function(){
        debugOutput("cancel");

        var url = '../widgets/upload';
        $.ajax({
            url: url,
            type: 'GET',
            data: 'uploadImage='+Laracasts.uploadImage,
            dataType: 'html'
        })
        .done(
            function(data) {
                debugOutput(data);
                $('#upload_wrapper').html(data);
             }
        );
        return false;
    });

   $( '#upload' ).on( 'submit', function() {
    debugOutput('postCroppedImage: ');
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
            "fieldtext": $(  '#fieldtext' ).val(),
            "img_height": $(  '#img_height' ).val()
        },
        function( data ) {
            debugOutput("about to win.......");
            if (data.validation_failed == 1)
            {
                debugOutput('loose');
               
            }else{
                debugOutput(data);
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
