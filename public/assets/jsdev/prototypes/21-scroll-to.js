function scrollTo(nav){
    this.nav = nav;
    this.target = '';
    this.top = $('#nav').height();
    this.addListeners()
}

scrollTo.prototype = {
    constructor: scrollTo,
    addListeners : function(){
        this.nav.find('a').on('click', $.proxy(this.scroll, this));
    },
    scroll : function(e){
        e.preventDefault();
        this.target = $(e.target).attr('href');
        $('html, body').animate({ scrollTop: $(this.target).offset().top - this.top }, 300);
    }
}