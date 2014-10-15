var Masonry = function (masonry) {
    this.masonry = masonry;
    this.init();
}
Masonry.prototype = {
    constructor: Masonry,
    init: function(){
        var $container = this.masonry;

        $container.masonry({
            itemSelector: '.masonry-item',
            isInitLayout: false,
            transitionDuration: 0
        });
        $container.masonry;
    }
}