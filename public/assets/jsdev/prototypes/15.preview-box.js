function previewBox(box){
    this.box = box;
    this.height = this.box.height();
    this.heroTop = $('.hero').css('margin-top').replace("px", "");
    this.init();
}
previewBox.prototype ={
    constructor: previewBox,
    init: function(){
        $('#nav').css('margin-top', this.height);
        console.log( parseInt(this.heroTop) +  parseInt(this.height) );
        $('.hero').css('margin-top', parseInt(this.heroTop) +  parseInt(this.height) );
    }
}