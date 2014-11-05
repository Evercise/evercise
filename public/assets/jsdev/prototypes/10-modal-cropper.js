function imageCropper(elem){
    this.elem = elem;
    this.modal = this.elem.find(".modal-cropper");
    this.modalImage = this.modal.find("#uploaded-image");
    this.uploadForm = this.elem.find("#image-upload-form");
    this.uploadButton = this.uploadForm.find("#image");
    this.imageSelect = this.uploadForm.find("#image-select");
    this.image = this.modal.find(".bootstrap-modal-cropper img");
    this.xInput = this.modal.find("input[name='x']");
    this.yInput = this.modal.find("input[name='y']");
    this.wInput = this.modal.find("input[name='width']");
    this.hInput = this.modal.find("input[name='height']");
    this.bwInput = this.modal.find("input[name='box-width']");
    this.bhInput = this.modal.find("input[name='box-height']");
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
    crop: function(){
        self = this;


        this.bw = self.image.cropper("getImageData").width;
        this.bh = self.image.cropper("getImageData").height;
        this.image.cropper({
            data: this.originalData,
            aspectRatio: this.ratio,
            done: function(data) {
                self.x = data.x;
                self.y = data.y;
                self.w = data.width;
                self.h = data.height;

                /*
                self.xInput.val(data.x);
                self.yInput.val(data.y);
                self.wInput.val(data.width);
                self.hInput.val(data.height);
                self.bwInput.val(self.image.cropper("getImageData").width);
                self.bhInput.val(self.image.cropper("getImageData").height);
                */
            }
        });
    },
    destroyCrop: function(){
        this.image.cropper("destroy");
        self.modalImage.attr('src',null);
        this.uploadButton.val('');
    }

}