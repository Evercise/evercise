var PreviewClassBox = function (box) {
    this.box = box;
    this.boxClass = box.attr('class');
    this.id = box.attr('id');
    //this.init();
}
/*
PreviewClassBox.prototype = {
    constructor: PreviewClassBox,
    init: function(){
        $("[data-target='" + this.id + "']").on('click', function(e) {
            alert('clicked');
        });
       var test = $("[data-target='" + this.id + "']").attr('class');
        console.log(test);
    }
}
    */