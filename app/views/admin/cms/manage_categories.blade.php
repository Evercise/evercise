@extends('admin.main')


@section('body')

{{ Form::open(['id' => 'manage_category', 'method' => 'post', 'form-control', 'files'=> true]) }}
{{ Form::hidden('id', (!empty($category->id) ? $category->id : 0)) }}
{{ Form::hidden('parent_id', 0) }}



<div class="col-md-12">
<div class="col-lg-9">
    <div class="form-group">
        <label>Title:</label>
       <input type="text" id="title" placeholder="Category title" name="title" class="form-control" value="{{ $category->title or "" }}" />
    </div>
    <div class="form-group" id="url_box">
   		  <label>URL:<span id="full_url" class="fr">
   		  </span></label>
   		  <input type="text" id="content_url" placeholder="Category URL" name="permalink" class="form-control" value="{{ $category->permalink or "" }}" />
    </div>

    <div class="form-group">
   		   <label>Main Image:</label>
           <img src="/{{ $category->main_image or "img/default_category.jpg" }}" style="float:left;width:100px !important;margin-right:10px" width="100" heigh="100"/>
           <input type="file" id="file" placeholder="Upload main image" name="main_image" value="" class="form-control" style="width:60%" /> <br/>
           The image will be auto resized to: {{ Config::get('evercise.article_category_main_image.width') }}x{{ Config::get('evercise.article_category_main_image.height')}}
    </div><br style="clear:both"/>


    <div class="form-group">
          <label>Category status:</label>
          <select name="status" id="status"  class="form-control">

                    <option value="0">Draft</option>
                    <option value="1" {{ (!empty($category->status) && $category->status == 1 ?  'selected="selected"':'') }}>Published</option>
                    <option value="2" {{ (!empty($category->status) && $category->status == 2 ?  'selected="selected"':'') }}>Unpublished</option>

           </select>
    </div>

    <div class="form-group">
          <label>Meta description:</label>
		  <textarea id="meta_description" name="description" rows="3" cols=""  class="form-control">{{ $category->description or "" }}</textarea>

    </div>
    <div class="form-group">
          <label>Meta keywords:</label>
           <input type="text" class="form-control tokenization" name="keywords" value="{{ $category->keywords or "" }}">

    </div>

    <div class="form-group">

            <button type="submit" name="save" value="save" class="btn btn-primary btn-sm">Save</button>
            @if(!empty($article->id))
                <a href="{{ URL::to(Articles::createUrl($article)) }}" class="btn btn-default btn-sm" target="_blank">Preview</a>
            @endif

        </div>


@stop




@section('css')

<link href="/admin/assets/lib/select2/select2.css" rel="stylesheet" media="screen">

@stop

@section('script')

            <!-- select2 -->
            <script src="/admin/assets/lib/select2/select2.min.js"></script>
            <!-- datepicker -->
            <script src="/admin/assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

            <!-- wysiwg editor -->
            <script src="//cdn.ckeditor.com/4.4.5/standard/ckeditor.js"></script>
            <script type="text/javascript" src="/admin/assets/lib/ckeditor/adapters/jquery.js"></script>
            <script type="text/javascript" src="/admin/assets/lib/ckfinder/ckfinder.js"></script>


            <script>
                $(function() {
                    // select2
                    yukon_select2.p_forms_extended();
                    // datepicker
                    yukon_datepicker.p_forms_extended();

                })
            </script>


<script>


$(document).ready(function() {




$("#title").keyup(function() {
	if(!url_updated) {
	    var input = $(this),
	    text = input.val().replace(/[^a-zA-Z0-9-_\s]/g, "_");
	    if(/_|\s/.test(text)) {
	        text = text.replace(/_|\s/g, "_");
	    }
	    $("#content_url").val(text);
	    write_url(text);
	}
});



var typingTimer;                //timer identifier
var doneTypingInterval = 1000;  //time in ms, 5 second for example

$("#content_url").keyup(function() {
	url_updated = true;
	var input = $(this),
	text = input.val().replace(/[^a-zA-Z0-9-_\s]/g, "_");
	if(/_|\s/.test(text)) {
		 text = text.replace(/_|\s/g, "_");
	}
	input.val(text);
	write_url(text);


    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
}).keydown(function(){
      clearTimeout(typingTimer);
});

$("#intro").keyup(function() {

	if(!desc_updated) {
		var text = $(this).val();
	    $("#meta_description").val(text);
	}
});



$("#meta_description").keyup(function() {
	desc_updated = true;
});



if($('.tokenization').length) {
    $('.tokenization').select2({
        placeholder: "Select...",
        tags:{{json_encode(Config::get('evercise.seo_keywords'))}},
        tokenSeparators: [",", " "]
    });
}

//user is "finished typing," do something
function doneTyping () {
        $.ajax({
            url: AJAX_URL+'check_url',
            type: 'POST',
            data: 'url='+encodeURIComponent($('#content_url').val()),
            dataType: 'json'
        })
        .done(
            function(res) {
                if(!res.error) {
                    $("#url_box").addClass('has-success has-feedback');
                    $("#url_box").removeClass('has-error has-feedback');
                } else {
                    $("#url_box").addClass('has-error has-feedback');
                    $("#url_box").removeClass('has-success has-feedback');
                }
             }
        );
    }


write_url($("#content_url").val());


});

function write_url(text){

$("#full_url").html(BASE_URL+text);
}




</script>

@stop