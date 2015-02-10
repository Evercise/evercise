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

                self.modalImage.attr('src','/'+data.file);
                self.modal.find("input[name='file']").replaceWith(file);
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
            $('#no-file-reader-form').append(self.modal.find('#get_file_content'));
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