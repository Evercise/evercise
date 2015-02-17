function scrollTo(nav){
    this.nav = nav;
    this.target = '';
    this.top = $('#nav').outerHeight();
    this.addListeners()
}

scrollTo.prototype = {
    constructor: scrollTo,
    addListeners : function(){
        this.nav.find('a[target!="_blank"]').on('click', $.proxy(this.scroll, this));
    },
    scroll : function(e){
        e.preventDefault();
        this.target = $(e.target).attr('href');
        $('html, body').animate({ scrollTop: $(this.target).offset().top - this.top }, 300);
    }
}