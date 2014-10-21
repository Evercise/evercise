@extends('admin.main')


@section('body')

{{ Form::open(['id' => 'manage_article', 'method' => 'post', 'form-control', 'files'=> true]) }}
{{ Form::hidden('id', (!empty($article->id) ? $article->id : 0)) }}



<div class="col-md-12">
@if(isset($errors))
@foreach ($errors->all('<li>:message</li>') as $message)
    {{ $message }}
@endforeach
@endif
<div class="col-lg-9">
    <div class="form-group">
        <label>Title:</label>
       <input type="text" id="title" placeholder="Article title" name="title" class="form-control" value="{{ $article->title or "" }}" />
    </div>
    <div class="form-group" id="url_box">
   		  <label>URL:<span id="full_url" class="fr">
   		  </span></label>
   		  <input type="text" id="content_url" placeholder="Article URL" name="permalink" class="form-control" value="{{ $article->permalink or "" }}" />
    </div>

    <div class="form-group">
   		   <label>Main Image:</label>
           <img src="/{{ $article->main_image or "img/default_article.jpg" }}" style="float:left;width:100px !important;margin-right:10px" width="100" heigh="100"/>
           <input type="file" id="file" placeholder="Upload main image" name="main_image" value="" class="form-control" style="width:60%" /> <br/>
           The image will be auto resized to: {{ Config::get('evercise.article_main_image.width') }}x{{ Config::get('evercise.article_main_image.height')}}
    </div> <br/><br style="clear:both"/>


    <div class="form-group">
          <label>Intro (Excerpt):</label>
          <textarea name="intro" id="reg_textarea" cols="10" rows="2" class="form-control">{{ $article->intro or "" }}</textarea>
    </div>

    <div class="form-group">
          <label>Main Content:</label>
           <textarea name="content" id="wysiwg_editor" cols="30" rows="4" class="form-control">{{ $article->content or "" }}</textarea>
    </div>

</div>

<div class="col-lg-3">


    <div class="form-group">

        <button type="submit" name="save" value="save" class="btn btn-primary btn-sm">Save</button>
        @if(!empty($article->id))
            <a href="{{ URL::to(Articles::createUrl($article), ['preview'=>true]) }}" class="btn btn-default btn-sm" target="_blank">Preview</a>
        @endif

    </div>
    <div class="form-inline">
    <div class="form-group form-inline">

    <label style="display:inline-block" title="A single page is a main page. Like the about us. A single page can be without a category. If no category is selected the page is automaticly marked as a Single page">Is this a single page?</label>

    <input value="1" id="is_page" class="form-control" name="page" <?=(!empty($article->page) && $article->page == 1?'checked="checked"':'')?> type="checkbox"/>

    </div>
    </div>

    <div class="form-group">
          <label>Category:</label>
            <select name="category_id" id="category_id" placeholder="Category"  class="form-control">
                <option value="0">None</option>
                @foreach ($categories as $category)
                    <option value="<?php echo $category->id; ?>" {{ ( isset($article->category_id) && $article->category_id == $category->id ? 'selected="selected"':'')}}><?php echo $category->title; ?></option>
                @endforeach
           </select>
    </div>

@if(count($templates) > 0)
    <div class="form-group">
          <label>Article template:</label>
          <select name="template" id="template"  class="form-control">
              <option value="">Default</option>
              @foreach ($templates as $temp => $name)
                <option value="{{ $temp }}" {{ ( $article->template == $temp ? 'selected="selected"':'')}}>{{ $name }}</option>
              @endforeach
        </select>

</div>
@endif


    <div class="form-group">
          <label>Article status:</label>
          <select name="status" id="status"  class="form-control">

                    <option value="0">Draft</option>
                    <option value="1"  {{ (!empty($article->status) && $article->status == 1 ?  'selected="selected"':'') }}>Published</option>
                    <option value="2" {{ (!empty($article->status) && $article->status == 2 ?  'selected="selected"':'') }}>Unpublished</option>

           </select>
</div>

    <div class="form-group">
          <label>Date published:</label>
          <input type="text" name="published_on" class="form-control" id="dp_basic" value="{{ (!empty($article->published_on) ? $article->published_on->format('m/d/Y') : '') }}"/>

    </div>

    <div class="form-group">
          <label>Meta description:</label>
		  <textarea id="meta_description" name="description" rows="3" cols=""  class="form-control">{{ $article->description or "" }}</textarea>

    </div>
    <div class="form-group">
          <label>Meta keywords:</label>
           <input type="text" class="form-control tokenization" name="keywords" value="{{ $article->keywords or "" }}">

    </div>


</div>

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

var url_updated = {{ (!empty($article->id) ? 'false':'true') }};
var desc_updated = {{ (!empty($article->id) ? 'false':'true') }};


var categories = [];

@foreach($categories as $c)

	categories[{{$c->id}}] = '{{$c->permalink}}';

@endforeach

$(document).ready(function() {

    if ($('#wysiwg_editor').length) {


        var editor = $('#wysiwg_editor').ckeditor({
            filebrowserBrowseUrl : '/admin/assets/lib/ckfinder/ckfinder.html',
            filebrowserUploadUrl : '/admin/assets/lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '/admin/assets/lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        });


    }


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

$("#category_id").change(function(){
	write_url($("#content_url").val());

});

$("#is_page").click(function(){
	write_url($("#content_url").val());

	console.log(  $( "#is_page:checked" ).length );
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

	    var is_page = $( "#is_page:checked" ).length;
	    var cat = $("#category_id").val();
	    if(cat !='' && is_page == 0 && cat != 'undefined' && cat > 0){
	        var cat_name = categories[cat];
		    $("#full_url").html(BASE_URL+cat_name+'/'+text);
	    } else {
		    $("#full_url").html(BASE_URL+text);
	    }
}




</script>

@stop