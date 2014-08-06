
var user_ratio = 1;
var group_ratio = 2.35;
var ratio = 1;
var previewHeight = 100;

var cropping = false;
var submitAfterCrop = false;

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
        $( '#upload' ).unbind('submit');
     }); 


     $(document).on('change', '#image', function(){
        trace("uploading image ... "+ratio);
        $('#upload').ajaxForm(options).submit(); 
         
     }); 

    $( '.create-form .btn-yellow' ).on( 'click', function(event) {
        event.preventDefault();
        trace('save changes clicked');

        if (cropping)
        {
            trace('cropping first');
            submitAfterCrop = true;
            $( '#upload' ).submit();
        }
        else
        {
            $('#user_edit').submit();
        }

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
        trace("init postCroppedImage");
        initCrop(ratio);
        postCroppedImage();
        
    }
}

function initCrop(ratio)
{
    cropping = true;
    var defaultMargin = 30;

    setTimeout(function() {
        var height = $('#img-crop img').height();
        var width = $('#img-crop img').width();
        if (height < width)
        {
            var left = ((width - height) / 2) + defaultMargin;
            var top = defaultMargin;
            var right = width - left;
            var bottom = height - top;
        }
        else
        {
            var top = ((height - width) / 2) + defaultMargin;
            var left = defaultMargin;
            var right = width - left;
            var bottom = height - top;
        }

        // trace('height: '+height);
        // trace('width: '+width);

        $('#img-crop img').imgAreaSelect({
            aspectRatio: ratio + ':1',
            fadeSpeed: 300,
            handles: true,
            onSelectEnd: saveCroppedImage,
            onSelectChange: preview,
            onInit: function(img, selection){preview(img, selection); saveCroppedImage(img, selection);},
            x1: left, y1: top, x2: right, y2: bottom
        });

        

    }, 500);


}

function preview(img, selection) {
    trace($('#img-crop img') + ' : '+ selection);
    
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
    $('.image-form .btn-yellow').removeClass('hidden');
}



function postCroppedImage()
{
    //TODO - implement cancel button here.

   $( '#upload' ).on( 'submit', function() {
    
    $('.image-form .btn-yellow').addClass('hidden');
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
            trace("cropping image...");
            cropping = false;
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

                if (submitAfterCrop)
                {
                     $( '#user_edit').submit();
                }
                
            }
        },
        'json'
    );
    return false;
    }); 

}
