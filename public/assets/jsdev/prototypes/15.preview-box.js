function previewBox(box){
    this.box = box;
    this.height = this.box.height();
    this.init();
}
previewBox.prototype ={
    constructor: previewBox,
    init: function(){
        $('#nav').css('margin-top', this.height);
    }
}