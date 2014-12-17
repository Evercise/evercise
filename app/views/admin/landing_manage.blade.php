@extends('admin.main')


@section('body')

{{ Form::open(['id' => 'landing_manage', 'method' => 'post', 'form-control', 'files'=> true]) }}
{{ Form::hidden('id', (!empty($page->id) ? $page->id : 0)) }}



<div class="col-md-12">
<div class="col-lg-9">
    <div class="form-group">
        <label>Category:</label>
        {{  Form::select('category', $categories, ( !empty($page->category) ? $page->category : 0), ['id'=>'status', 'placeholder' => 'status', 'class' => 'form-control']) }}

    </div>
    <div class="form-group" id="url_box">
   		  <label>URL:<span id="full_url" class="fr">
   		  </span></label>

        {{ Form::text('slug', (!empty($page->slug) ? $page->slug : null), ['placeholder'=> 'Page url', 'class' => 'form-control', 'id'=>'content_url']) }}
    </div>

    <div class="form-group">
   		   <label>Setup</label>
    </div>


    <div class="col-lg-6">test</div>
    <div class="col-lg-6">test</div>
    <div class="col-lg-3">test</div>
    <div class="col-lg-3">test</div>
    <div class="col-lg-3">test</div>
    <div class="col-lg-3">test</div>






</div>

<div class="col-lg-3">


    <div class="form-group">

        <button type="submit" name="save" value="save" class="btn btn-primary btn-sm">Save</button>

    </div>



    <div class="form-group">
          <label>Intro (Excerpt):</label>

          {{ Form::textarea('intro', (!empty($page->intro) ? $page->intro : null), ['rows'=> '2', 'placeholder'=> 'Intro', 'class' => 'form-control', 'id'=>'reg_textarea']) }}

    </div>

    <div class="form-group">
          <label>Meta description:</label>
          {{ Form::textarea('description', (!empty($page->description) ? $page->description : null), ['rows'=> '3', 'placeholder'=> 'Meta Desc', 'class' => 'form-control', 'id'=>'meta_description']) }}

    </div>
    <div class="form-group">
          <label>Meta keywords:</label>
          {{ Form::text('keywords', (!empty($page->keywords) ? $page->keywords :  null), ['placeholder'=> 'keywords', 'class' => 'form-control tokenization']) }}

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

var url_updated = {{ (!empty($page->id) ? 'false':'true') }};
var desc_updated = {{ (!empty($page->id) ? 'false':'true') }};


var categories = [];


var widget_type = '';
var check_type = '';


function widgets_reset() {


	$('.row_widgets').hide();
	$('.single_class_id').hide();
	$('.single_class_search').hide();


}

$(document).ready(function() {


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