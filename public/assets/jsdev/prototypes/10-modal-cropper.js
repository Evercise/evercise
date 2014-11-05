function imageCropper(elem){
    this.elem = elem;
    this.modal = this.elem.find(".modal-cropper");
    this.modalImage = this.modal.find("#uploaded-image");
    this.uploadForm = this.elem.find("#image-upload-form");
    this.galleryImage = $('.gallery-option');
    this.croppedForm = this.modal.find("#cropped-image");
    this.uploadButton = this.modal.find("input[name='file']");
    this.imageSelect = this.uploadForm.find("#image-select");
    this.removeButton = this.uploadForm.find("#cover-remove");
    this.image = this.modal.find(".bootstrap-modal-cropper img");
    this.xInput = this.modal.find("input[name='x']");
    this.yInput = this.modal.find("input[name='y']");
    this.wInput = this.modal.find("input[name='width']");
    this.hInput = this.modal.find("input[name='height']");
    this.bwInput = this.modal.find("input[name='box_width']");
    this.bhInput = this.modal.find("input[name='box_height']");
    this.originalData = {};
    this.ratio = 2.35;
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
        this.addListener();

    },
    addListener: function () {
        this.imageSelect.on("click", $.proxy(this.upload, this) );
        this.uploadButton.on("change", $.proxy(this.getImage, this))
        this.modalImage.on("load", $.proxy(this.openModal, this))
        this.modal.on("shown.bs.modal", $.proxy(this.crop, this));
        this.modal.on("hidden.bs.modal", $.proxy(this.destroyCrop, this));
        this.croppedForm.on("submit", $.proxy(this.submitForm, this));
        this.galleryImage.on("click", $.proxy(this.clickGalleryOption, this));
        this.removeButton.on("click", $.proxy(this.removeCover, this));
    },
    upload: function(){
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
            },

            success: function (data) {
                self.croppedForm.find("input[type=submit]").prop('disabled', false);
                self.uploadForm.append('<img src="/'+data.file +'" alt="cover photo" class="img-responsive">')
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                $('#cropping-loading').remove();
                self.displayRemove();
                self.closeModal();
            }
        });
    },
    clickGalleryOption: function(e){
        this.uploadForm.append( $(e.target).clone().removeClass('gallery-option') );
    },
    removeCover: function(){
        this.hideRemove();
        this.uploadForm.find("img").remove();
    },
    displayRemove: function(){
        this.removeButton.removeClass('hidden');
    },
    hideRemove: function(){
        this.removeButton.addClass('hidden');
    }


}