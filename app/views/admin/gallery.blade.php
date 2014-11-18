@extends('admin.main')


@section('css')

    <link href="/admin/assets/lib/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css" rel="stylesheet" media="screen">
    <link href="/admin/assets/lib/magnific-popup/magnific-popup.css" rel="stylesheet" media="screen">

@stop


@section('script')

    <script src="/admin/assets/lib/plupload/js/plupload.full.min.js"></script>
    <script src="/admin/assets/lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>
    <script src="/admin/assets/lib/magnific-popup/jquery.magnific-popup.min.js"></script>



<script>

    var currentRequest;
    $(function () {

        yukon_gallery.search_gallery();
        yukon_magnific.p_components_gallery();

        if($('#upload_galery').length) {
            $("#upload_galery").pluploadQueue({
                // General settings
                runtimes : 'html5,flash,silverlight,html4',
                url : "{{ URL::route('admin.ajax.gallery_upload') }}",

                chunk_size : '100mb',
                rename : true,
                dragdrop: true,

                filters : {
                    // Maximum file size
                    max_file_size : '10mb',
                    // Specify what files to browse for
                    mime_types: [
                        {title : "Image files", extensions : "jpg,gif,png"}
                    ]
                },

                multipart_params : {
                   "_token" : TOKEN
                },

                // Flash settings
                flash_swf_url : '/admin/assets/lib/plupload/js/Moxie.swf',

                // Silverlight settings
                silverlight_xap_url : '/admin/assets/lib/plupload/js/Moxie.xap',
                 // Post init events, bound after the internal events
                init : {
                    FileUploaded: function(up, file, info) {


                        var row = '<li class="boxing">'+
                                    '<a href="{{ URL::to('/') }}'+info.response+'" class="img_wrapper">'+
                                       '<img src="{{ URL::to('/') }}'+info.response+'" alt=""/>' +
                                      ' <span class="gallery_image_zoom">' +
                                           '<span class="arrow_expand"></span>' +
                                       '</span>' +
                                       '<span class="hide gallery_image_tags">' +
                                       '</span>' +
                                   '</a>' +
                               '</li>';
                        // Called when file has finished uploading
                        console.log(row);

                        $('.gallery_grid').prepend(row);
                    },
          
                    Error: function(up, args) {
                        // Called when error occurs
                        console.log(args);
                    }
                }
            });
        }




        if($('.image_tags').length) {
            $('.image_tags').select2({
                placeholder: "Keywords...",
                tags:{{ json_encode(array_values($categories)) }},
                tokenSeparators: [",", " "]
            });

            $(".image_tags").on("change", function(e) {

                var data = {
                        'tags' : e.val,
                        'id'  : $(this).data('id')
                };
                currentRequest = $.ajax({
                            type: "POST",
                            url: AJAX_URL + "saveTags",
                            cache: false,
                            dataType: 'json',
                            data: data,
                            beforeSend: function (json) {
                                if (currentRequest != null) currentRequest.abort();
                            },
                            success:function(res){
                                console.log(res);
                                console.log(res.deleted);
                                if(res.deleted) {
                                    $('.img_'+res.id).remove();
                                }
                            }
                    }).done(
                          function(res){
                              console.log(res);
                              console.log(res.deleted);
                              if(res.deleted) {
                                  $('.img_'+res.id).remove();
                              }
                           }
                      );



            });
        }



            $(".delete_image").on("click", function(e) {

                var data = {
                    'id'  : $(this).data('id')
                };
                currentRequest = $.ajax({
                            type: "POST",
                            url: AJAX_URL + "deleteGalleryImage",
                            cache: false,
                            dataType: 'json',
                            data: data,
                            beforeSend: function (json) {
                                if (currentRequest != null) currentRequest.abort();
                            },
                            success: function (res) {
                                if(res.deleted) {
                                    $('.img_'+res.id).hide();
                                }
                            }
                });


            });

    });

</script>

@stop

@section('body')




@include('admin.gallery_upload')
<br/>
<br/>

<div class="gallery_filer">
                        <div class="row">
                            <div class="col-sm-6">
                                <input class="form-control" type="text" placeholder="Filter by name, tag etc..." id="gallery_search" />
                                <span class="help-block">Eg. business, creative, photoshop</span>
                            </div>
                        </div>
</div>
<hr/>
<div class="row">
    <ul class="gallery_grid">
        @foreach($images as $img)
        <li class="boxing img_{{ $img->id }}" style="position: relative">
            <span data-id="{{ $img->id }}" class="delete_image icon_ul el-icon-remove" style="color:#c00; position: absolute;top:5px; right:5px; z-index:1000;cursor: pointer"></span>
            <a href="{{ URL::to('/files/gallery_defaults/main_'.$img->image) }}" class="img_wrapper" title="{{ $img->image }}">
                <img src="{{ URL::to('/files/gallery_defaults/thumb_'.$img->image) }}" alt=""/>
                <span class="gallery_image_zoom">
                    <span class="arrow_expand"></span>
                </span>
                <span class="hide gallery_image_tags">

                    @foreach(explode(',', $img->keywords) as $key)
                    <span> {{ $key }} </span>
                    @endforeach
                </span>
            </a>

            <input class="image_tags form-control"  data-id="{{ $img->id }}" value="{{ $img->keywords }}"/>
        </li>
        @endforeach

</div>


@stop