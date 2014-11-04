function CoverSelect(elem){
    this.container = elem;
    this.cover = this.container.find('#cover_image');
    this.galleryImage = this.container.find('.gallery-option');
    this.currentImage = '';
    this.init();
}
CoverSelect.prototype = {
    constructor: CoverSelect,
    init: function () {
        this.addListener();
    },

    addListener: function () {
        this.galleryImage.on("click", $.proxy(this.clickGalleryOption, this));
    },
    clickGalleryOption: function(e){
        this.cover.html( $(e.target).clone().removeClass('gallery-option') );
    }
}