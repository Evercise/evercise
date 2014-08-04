
var user_ratio = 1;
var group_ratio = 2.35;
var ratio = 1;
var previewHeight = 100;

function setRatio(r)
{
    trace('setting ratio: '+window[r])
    ratio = window[r];
    $('.frame, .preview, .preview img').css('width', ratio*previewHeight);
}

function initImage(params)
{
    //trace('initImage ratio: '+JSON.parse(params).ratio );
    setRatio(JSON.parse(params).ratio);
    var options = { 
        beforeSubmit:  showRequest,
        success:       showResponse,
        dataType: 'json' 
        };

    /* reset image value to null */
     $(document).on('click', '#image', function(){
        trace('nulling input: '+$(this).val());  
        
     }); 


     $(document).on('change', '#image', function(){
        trace("uploading image ... "+ratio);
        $('#upload').ajaxForm(options).submit(); 
         
     }); 

}        
registerInitFunction('initImage');

function showRequest(formData, jqForm, options) { 
   // $("#validation-errors").hide().empty();
   // $("#output").css('display','none'); 
    trace("showRequest..");  
    $('.error-msg').remove();     
    return true; 
    
} 
function showResponse(response, statusText, xhr, form)  { 

    if(response.success == false)
    {
        trace(response.errors, true);
        var arr = response.errors;
        //trace(arr, true);
        $.each(arr, function(index, value)
        {
            if (value.length != 0)
            {
                trace(value);
                $("#image-upload").append('<span class="error-msg">'+ value +'</span>');
            }
        });
    } else {
        $('#image-upload').html(response.crop);
        $('.preview img').attr('src', response.image_url);
        $('#img-crop img').attr('src', response.image_url);
        $('#upload').attr('action', response.postCrop);
        $('.frame, .preview, .preview img').css('width', ratio*previewHeight);

        trace('img_url= '+response.image_url);
        $('#img_url').val(response.image_url);

        initCrop(ratio);
        postCroppedImage();
        trace("init postCroppedImage");
    }
}

function initCrop(ratio)
{
    trace('initcrop');
    $('#img-crop img').imgAreaSelect({
        aspectRatio: ratio + ':1',
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

    trace(previewX+' - '+previewY);
    
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
    trace('saveCroppedImage'+selection.width+' : '+img.src);
    $('#width').val(selection.width);
    $('#height').val(selection.height);
    $('#pos_x').val(selection.x1);
    $('#pos_y').val(selection.y1);
    $('#img_url').val(img.src);
    $('#img_height').val(img.height);
    //trace($('#img_height').val());
}



function postCroppedImage()
{
    //TODO - implement cancel button here.
    /*$('#cancel_upload').click(function(){
        trace("cancel");

        var url = '../widgets/upload';
        $.ajax({
            url: url,
            type: 'GET',
            data: '',
            dataType: 'html'
        })
        .done(
            function(data) {
                trace(data);
                $('#upload_wrapper').html(data);
             }
        );
        return false;
    });*/

   $( '#upload' ).on( 'submit', function() {
    trace('postCroppedImage: ');
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
            trace("about to win.......");
            if (data.validation_failed == 1)
            {
                trace('loose');
               
            }else{
                //trace(data, true);
                $('#img-crop img').imgAreaSelect({
                    remove: true
                });

                $("#create_class").removeClass('disabled');
                $('#upload_wrapper').html(data.uploadView);

                $('.frame, .preview, .preview img').css('width', ratio*previewHeight);
                //$('.preview img').attr('src', data.newImage);
                $('#thumbFilename').val(data.thumbFilename);
               
            }
        },
        'json'
    );
    return false;
    }); 
}
