@extends('admin.main')


@section('body')

{{ Form::open(['id' => 'manage_article', 'method' => 'post', 'form-control', 'files'=> true]) }}
{{ Form::hidden('id', (!empty($article->id) ? $article->id : 0)) }}



<div class="col-md-12">
<div class="col-lg-9">
    <div class="form-group">
        <label>Title:</label>
        {{ Form::text('title', (!empty($article->title) ? $article->title : null), ['placeholder'=> 'Article title', 'class' => 'form-control', 'id'=>'title']) }}
    </div>
    <div class="form-group" id="url_box">
   		  <label>URL:<span id="full_url" class="fr">
   		  </span></label>

        {{ Form::text('permalink', (!empty($article->permalink) ? $article->permalink : null), ['placeholder'=> 'Article url', 'class' => 'form-control', 'id'=>'content_url']) }}
    </div>

    <div class="form-group">
   		   <label>Main Image:</label>
   		   @if(!empty($article->main_image))
           <img src="/{{ $article->main_image or "img/default_article.jpg" }}" style="float:left;width:100px !important;margin-right:10px" width="100" heigh="100"/>
           @endif
            {{ Form::file('main_image', ['placeholder'=> 'Upload main image', 'class' => 'form-control', 'id'=>'file', 'style' => 'width:60%']) }}
           The image will be auto resized to: {{ Config::get('evercise.article_main_image.regular.width') }}x{{ Config::get('evercise.article_main_image.regular.height')}} and {{ Config::get('evercise.article_main_image.thumb.width') }}x{{ Config::get('evercise.article_main_image.thumb.height')}}
    </div><br style="clear:both"/>


    <div class="form-group">
          <label>Main Content:</label>
          {{ Form::textarea('content', (!empty($article->content) ? $article->content : null), ['cols' => '30', 'rows'=> '4', 'placeholder'=> 'Main Content', 'class' => 'form-control', 'id'=>'wysiwg_editor']) }}

    </div>

</div>

<div class="col-lg-3">


    <div class="form-group">

        <button type="submit" name="save" value="save" class="btn btn-primary btn-sm">Save</button>
        @if(!empty($article->id))
            <a href="{{ URL::to(Articles::createUrl($article)) }}" class="btn btn-default btn-sm" target="_blank">Preview</a>
        @endif

    </div>
    <div class="form-inline">
    <div class="form-group form-inline">

    <label style="display:inline-block" title="A single page is a main page. Like the about us. A single page can be without a category. If no category is selected the page is automaticly marked as a Single page">Is this a single page?</label>
        {{ Form::checkbox('page', 1, (!empty($article->page) && $article->page == 1 ? true : false) , ['id'=>'is_page']) }}
    </div>
    </div>
    <div class="form-inline">
    <div class="form-group form-inline">

    <label style="display:inline-block" title="Display on FrontPage">Display on Front page?</label>
        {{ Form::checkbox('onmain', 1, (!empty($article->onmain) && $article->onmain == 1 ? true : false) , ['id'=>'onmain']) }}
    </div>
    </div>

    <div class="form-group">
          <label>Category:</label>

          {{  Form::select('category_id', $cat_drop, ( !empty($article->category_id) ? $article->category_id : null), ['id'=>'category_id', 'placeholder' => 'Category', 'class' => 'form-control']) }}

    </div>

@if(count($templates) > 0)
    <div class="form-group">
          <label>Article template:</label>

          {{  Form::select('template', $templates, ( !empty($article->template) ? $article->template : null), ['id'=>'template', 'placeholder' => 'template', 'class' => 'form-control']) }}


</div>
@endif


    <div class="form-group">
          <label>Article status:</label>

          {{  Form::select('status', ['0' => 'Draft', '1'=> 'Published', '2' => 'Unpublished'], ( !empty($article->status) ? $article->status : 0), ['id'=>'status', 'placeholder' => 'status', 'class' => 'form-control']) }}

    </div>

    <div class="form-group">
          <label>Date published:</label>
           {{ Form::text('published_on', (!empty($article->published_on) ? $article->published_on->format('d/m/Y') :  date('d/m/Y')), ['placeholder'=> 'Date published', 'class' => 'form-control datetime', 'id'=>'dp_basic']) }}


    </div>



    <div class="form-group">
          <label>Intro (Excerpt):</label>

          {{ Form::textarea('intro', (!empty($article->intro) ? $article->intro : null), ['rows'=> '2', 'placeholder'=> 'Intro', 'class' => 'form-control', 'id'=>'reg_textarea']) }}

    </div>

    <div class="form-group">
          <label>Meta description:</label>
          {{ Form::textarea('description', (!empty($article->description) ? $article->description : null), ['rows'=> '3', 'placeholder'=> 'Meta Desc', 'class' => 'form-control', 'id'=>'meta_description']) }}

    </div>
    <div class="form-group">
          <label>Meta keywords:</label>
          {{ Form::text('keywords', (!empty($article->keywords) ? $article->keywords :  null), ['placeholder'=> 'keywords', 'class' => 'form-control tokenization']) }}


    </div>


    <div class="form-group">
          <label>Widgets</label>

          <select id="widget" class="form-control">
            <option value="">-- SELECT --</option>
            <option value="single_class">Single Class</option>
          </select>
          <div class="row_single_class row_widgets ">
                <label>Display Type</label>
                <div class="form-group">
                     <label class="radio-inline">
                         <input type="radio" class="display_type" name="row_single" value="id">
                         Specific Class
                     </label>
                     <label class="radio-inline">
                         <input type="radio" class="display_type" name="row_single" value="search">
                         Keyword Search
                     </label>
                </div>


                <div class="single_class_id form-group ">
                    <select id="single_class_id" class="form-control">
                                <option value="">-- SELECT --</option>
                          @foreach($evercisegroup as $g)
                                <option value="{{ $g->id }}">{{ $g->id }} | {{ $g->name }}</option>
                          @endforeach
                    </select>
                </div>

                <div class="single_class_search form-group ">
                    <div class="input-group sepH_b">
                        <span class="input-group-addon">Search keyword</span>
                        <input type="text" id="single_class_search" class="form-control" value="">
                     </div>

                    <label class="checkbox-inline">
                            <input type="checkbox" id="single_class_nearme" value="true"> NearMe
                     </label>
                </div>


          </div>


<br/>
<br/>
                <div class="form-group ">
                    <span class="btn btn-success" id="generate">GENERATE</span>
                    <textarea id="generated"  class="form-control">

                    </textarea>
                </div>

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
            <script type="text/javascript" src="/admin/assets/lib/ckeditor/ckeditor.js"></script>
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

var widget_type = '';
var check_type = '';


function widgets_reset() {


	$('.row_widgets').hide();
	$('.single_class_id').hide();
	$('.single_class_search').hide();


}

function copyToClipboard() {
        if (document.body.createControlRange) {
            var htmlContent = document.getElementById('generated');
            var controlRange;

            var range = document.body.createTextRange();
            range.moveToElementText(htmlContent);

            //Uncomment the next line if you don't want the text in the div to be selected
            range.select();

            controlRange = document.body.createControlRange();
            controlRange.addElement(htmlContent);

            //This line will copy the formatted text to the clipboard
            controlRange.execCommand('Copy');

            console.log('copied');
        }
    }
$(document).ready(function() {
widgets_reset();

/** This will be crap!!! */
$("#widget").change(function(){
	widget_type = $(this).val();

	widgets_reset();

	console.log(widget_type);

	switch(widget_type) {
        case 'single_class':
            $('.row_single_class').show();
            break;
    }

});


$('.display_type').click(function(){
    check_type = $(this).val();


    switch(check_type) {
        case 'id':
            $('.single_class_id').show();
            $('.single_class_search').hide();
            break;
        case 'search':
            $('.single_class_search').show();
            $('.single_class_id').hide();
            break;
    }
});



$('#generate').click(function() {

	switch(widget_type) {
        case 'single_class':

            if(check_type == 'id') {
                var check_type_id = $('#single_class_id').val();


                $('#generated').val('[single_class type=id param='+check_type_id+']');

            }


            if(check_type == 'search') {
                var check_type_search = $('#single_class_search').val();
                $('#generated').val('[single_class type=search param='+check_type_search+' '+( $('#single_class_nearme').prop('checked') ? 'nearme=true':'')+']');
            }



            break;

}

});

$('#generated').click(function() {
    $('#generated').select();
    copyToClipboard();
});


    if ($('#wysiwg_editor').length) {


        var editor = $('#wysiwg_editor').ckeditor({
            filebrowserBrowseUrl : '/admin/assets/lib/ckfinder/ckfinder.html',
            filebrowserUploadUrl : '/admin/assets/lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '/admin/assets/lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            height : '600px',
            stylesSet : 'my_style:{{URL::to('/')}}/assets/js/article_styles.js',
            extraAllowedContent : 'div(*)'
        });

    }


$("#title").keyup(function() {
	if(!url_updated) {
	    var input = $(this),
	    text = input.val().replace(/[^a-zA-Z0-9-_\s]/g, "-");
	    if(/_|\s/.test(text)) {
	        text = text.replace(/_|\s/g, "-");
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
	text = input.val().replace(/[^a-zA-Z0-9-_-\s]/g, "-");
	if(/_|\s/.test(text)) {
		 text = text.replace(/_-|\s/g, "-");
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