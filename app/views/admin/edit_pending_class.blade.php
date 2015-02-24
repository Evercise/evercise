@extends('admin.main')

@section('css')

    {{ HTML::style('assets/css/cropper.min.css') }}
    {{ HTML::style('admin/assets/css/image-cropper.css') }}

    <style>

    </style>

@stop

@section('script')

    <script src="/admin/assets/lib/select2/select2.min.js"></script>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    {{ HTML::script('/assets/js/cropper.min.js') }}

    <script>

        function categorySelect(form){
            this.form = form;
            this.select = this.form.find('.select2');
            this.keywordSelect = this.form.find('input[name="keywords"]');
            this.keywords = [];
            this.keys = [];
            this.gallery = '';
            this.maximumSelectionSize = 3;
            this.minimumResultsForSearch = 1;
            this.placeholder = 'Choose upto 3 categories';
            this.dropdownCssClass = 'select2-hidden';
            this.init();
        }
        categorySelect.prototype = {
            constructor: categorySelect,
            init: function(){
                this.select.select2({
                    maximumSelectionSize: this.maximumSelectionSize,
                    minimumResultsForSearch: this.minimumResultsForSearch,
                    placeholder: this.placeholder,
                    closeOnSelect: true,
                    openOnEnter: false,
                    formatNoMatches: function() {
                        return '';
                    },
                    dropdownCssClass: this.dropdownCssClass
                });
                this.addListener();
            },
            addListener: function () {
                this.form.on("submit", $.proxy(this.submitForm, this));
                this.select.on("select2-selecting", $.proxy(this.addToKeywords, this))
                this.select.on("select2-removing", $.proxy(this.removeFromKeywords, this))
                $(document).on('swiperight', '#image-carousel', function(){
                    $(this).carousel('next');
                })
                $(document).on('swipeleft', '#image-carousel', function(){
                    $(this).carousel('prev');
                })
            },
            submitForm: function(e){
                e.preventDefault();
                this.ajaxUpload();
            },
            ajaxUpload: function () {
                var self = this;

                $.ajax(self.form.attr("action"), {
                    type: "post",
                    data: self.form.serialize(),
                    dataType: 'json',

                    beforeSend: function () {
                        $('#gallery-row').after('<div id="gallery-loading"  class="alert alert-success text-center"><span class="icon icon-loading ml10"></span> Loading gallery based on your selected categories...</div>');
                    },

                    success: function (data) {
                        self.gallery = data.view;
                        $('#gallery-row').html(self.gallery).trigger('change');
                    },

                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
                    },

                    complete: function () {
                        self.select.prop('disabled', false);
                        $('#gallery-loading').remove();
                    }
                });
            },
            addToKeywords: function(e){
                this.keys.push(e.choice.id);
                this.keywords.push(e.choice.text);
                this.keywordSelect.val(this.keywords);
                this.updateCategoriesInput();
                this.form.submit();
            },
            removeFromKeywords: function(e){
                this.keywords = $.grep(this.keywords, function(value) {
                    return value != e.choice.text;
                });
                this.keys = $.grep(this.keys, function(value) {
                    return value != e.choice.id;
                });
                this.updateCategoriesInput();
            },
            updateCategoriesInput: function(){
                $('input[name="category_array[]"]').val(this.keywords).trigger('change');
            }
        }

        function imageCropper(elem){
            this.elem = elem;
            this.modal = this.elem.find(".modal-cropper");
            this.modalImage = this.modal.find("#uploaded-image");
            this.uploadForm = this.elem.find("#image-upload-form");
            this.galleryRow = $('#gallery-row');
            this.galleryImage = '';
            this.galleryValue = '';
            this.croppedForm = this.modal.find("#cropped-image");
            this.uploadButton = this.modal.find("input[name='file']");
            this.imageSelect = this.uploadForm.find(".image-select");
            this.image = this.modal.find(".bootstrap-modal-cropper img");
            this.xInput = this.modal.find("input[name='x']");
            this.yInput = this.modal.find("input[name='y']");
            this.wInput = this.modal.find("input[name='width']");
            this.hInput = this.modal.find("input[name='height']");
            this.bwInput = this.modal.find("input[name='box_width']");
            this.bhInput = this.modal.find("input[name='box_height']");
            this.originalData = {};
            this.ratio = ( this.modal.data('ratio')) ? this.modal.data('ratio') :  2.35;
            this.imageType = (this.ratio == 2.35 )? '/cover_' : '/medium_';
            this.x = 0;
            this.y = 0;
            this.w = 0;
            this.h = 0;
            this.bw = 0;
            this.bh = 0;
            this.init();
        }
        imageCropper.prototype = {
            constructor: imageCropper,
            init: function(){
                if(typeof(window.FileReader)!="undefined"){
                    $('#get_file_content').closest('form').remove();
                }
                else{
                    $('#image-select').remove();
                }
                this.addListener();
                if($('input[name="cloned"]').val() != ''){
                    this.galleryImage = '<img src="/'+$('input[name="cloned"]').val()+'"  alt="cover photo" class="img-responsive">';
                }

            },
            addListener: function () {
                $(document).on("click", '.image-select' ,$.proxy(this.upload, this));
                this.uploadButton.on("change", $.proxy(this.getImage, this))
                this.galleryRow.on("change", $.proxy(this.updatedRow, this))
                this.modalImage.on("load", $.proxy(this.openModal, this))
                this.modal.on("shown.bs.modal", $.proxy(this.crop, this));
                this.modal.on("hidden.bs.modal", $.proxy(this.destroyCrop, this));
                this.croppedForm.on("submit", $.proxy(this.submitForm, this));
                $(document).on("click", '.gallery-option' ,$.proxy(this.clickGalleryOption, this));
                $(document).on("change", '#get_file_content' ,$.proxy(this.getFileContent, this));
            },
            upload: function(e){
                this.uploadButton.trigger('click');
            },
            getImage: function(e){


                self = this;

                if (e.target.files && e.target.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        self.modalImage.attr('src', e.target.result);
                    }

                    reader.readAsDataURL(e.target.files[0]);
                }

            },
            getFileContent : function(e){
                var form = $(e.target).closest('form'),
                        file = $(e.target),
                        data = new FormData(form[0]),
                        self = this;
                console.log(file.val());
                $.ajax(form.attr('action'), {
                    type: "post",
                    data: data,
                    processData: false,
                    contentType: false,

                    beforeSend: function () {
                    },

                    success: function (data) {
                        file.addClass('opacity');
                        self.modalImage.attr('src','/'+data.file);
                        self.modal.find("input[name='file']").replaceWith(file);
                        self.modal.find("input[name='deletion']").val(data.file);
                    },

                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
                    }
                });


            },
            openModal: function(){
                this.modal.modal('show');
            },
            closeModal: function(){
                this.modal.modal('hide');
            },
            crop: function(){
                self = this;
                this.image = this.modal.find(".bootstrap-modal-cropper img");

                this.image.cropper({
                    data: this.originalData,
                    aspectRatio: this.ratio,
                    done: function(data) {
                        self.x = data.x;
                        self.y = data.y;
                        self.w = data.width;
                        self.h = data.height;
                    }
                });
            },
            destroyCrop: function(){
                this.image.cropper("destroy");
                self.modalImage.attr('src',null);
                this.uploadButton.val('');
                if(self.modal.find('#get_file_content').length){
                    $('#no-file-reader-form').append(self.modal.find('#get_file_content').removeClass('opacity'));
                }
            },
            submitForm: function(e){
                e.preventDefault();

                this.bw = this.image.cropper("getImageData").width;
                this.bh = this.image.cropper("getImageData").height;
                this.xInput.val(this.x);
                this.yInput.val(this.y);
                this.wInput.val(this.w);
                this.hInput.val(this.h);
                this.bwInput.val(this.bw);
                this.bhInput.val(this.bh);
                this.ajaxUpload();

            },
            ajaxUpload: function () {
                var url = this.croppedForm.attr("action"),
                        data = new FormData(this.croppedForm[0]),
                        self = this;

                $.ajax(url, {
                    type: "post",
                    data: data,
                    processData: false,
                    contentType: false,

                    beforeSend: function () {
                        self.croppedForm.find("input[type='submit']").prop('disabled', true).after('<span id="cropping-loading" class="icon icon-loading ml10"></span>');
                        self.image.cropper("disable");
                    },

                    success: function (data) {
                        self.galleryValue = data.filename;
                        self.galleryImage = '<img src="/'+data.folder + self.imageType +data.filename +'" alt="cover photo" class="img-responsive">';

                        self.croppedForm.find("input[type=submit]").prop('disabled', false);
                        self.uploadForm.append(self.galleryImage);

                        if( $('#first-img')){
                            $('#first-img').html(self.galleryImage);
                            $('#first-img').append('<div class="holder-add-more"><span class="image-select icon-lg icon-md-camera hover"></span>');
                        }
                        if($('input[name="gallery_image"]').length){
                            $('input[name="gallery_image"]').val(false);
                        }
                        $('input[name="image"]').val(self.galleryValue).trigger('change');

                    },

                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
                    },

                    complete: function () {
                        $('#cropping-loading').remove();
                        self.closeModal();
                    }
                });
            },
            clickGalleryOption: function(e){
                this.galleryValue = $(e.target).data("id");
                this.uploadForm.append('<img src="'+$(e.target).data("large")+'" alt="cover image" class="img-responsive">');
                $('input[name="image"]').val(this.galleryValue).trigger('change');
                if($('input[name="gallery_image"]').length){
                    $('input[name="gallery_image"]').val(true);
                }
            },
            updatedRow: function(){
                if(this.galleryImage != '' && this.galleryImage != '<img src="/undefined"  alt="cover photo" class="img-responsive">')
                {
                    $('#first-img').html(this.galleryImage);
                    $('#first-img').append('<div class="holder-add-more"><span class="image-select icon-lg icon-md-camera hover"></span>');
                }
            }
        }


        $(document).ready(function() {
            new imageCropper( $('#image-cropper') );
            new categorySelect( $('#find_gallery_image_by_category') );
        });


    </script>

@stop


@section('body')


{{ Form::open(['id' => 'manage_seourl', 'route' => 'admin.update_seourl', 'method' => 'post', 'form-control', 'files'=> true]) }}
{{ Form::hidden('id', (!empty($pendinggroup->id) ? $pendinggroup->id : 0)) }}


<div class="col-md-12">
    <div class="col-lg-9">

        <div class="form-group mb15">
            {{ Form::open(['route' => 'ajax.gallery.getdefaults', 'method' => 'post', 'id' => 'find_gallery_image_by_category']) }}
            {{ Form::label('category-select', 'Category', ['class' => 'mb15'] ) }}
            {{ Form::select('keywords-select', $subcategories, isset($cloneGroup) ? $cloneGroup->getSubcategoryIds() : '', ['class' => 'form-control mb40 select2', 'multiple' ] ) }}
            {{ Form::hidden('keywords',null) }}
            {{ Form::close() }}
        </div>
        <div class="form-group mb50">
            @include('v3.widgets.class_image_upload')
        </div>

        <div class="form-group">
            <label>Location:</label>
            {{ Form::text('location', $pendinggroup->evercisegroup_id, ['multiple'=>true, 'placeholder'=> 'Start typing location', 'class' => 'form-control', 'id'=>'location']) }}
        </div>
        <div class="form-group">
            <label>Name:</label>
            {{ Form::text('name', (!empty($pendinggroup->name) ? $pendinggroup->name : null), ['placeholder'=> 'search', 'class' => 'form-control', 'id'=>'title']) }}
        </div>
        <div class="form-group">
            <label>Description:</label>
            {{ Form::text('description', (!empty($pendinggroup->description) ? $pendinggroup->description : null), ['placeholder'=> 'description', 'class' => 'form-control', 'id'=>'title']) }}
        </div>
        <div class="form-group">
            <label>Image:</label>
            {{ Form::text('image', (!empty($pendinggroup->image) ? $pendinggroup->image : null), ['placeholder'=> 'title', 'class' => 'form-control', 'id'=>'title']) }}
        </div>

    </div>
</div>

<div class="col-md-12">
    {{ Form::submit('Save Changes' , array('class'=>'btn btn-sm btn-info')) }}
    {{ Form::close() }}
</div>

@stop