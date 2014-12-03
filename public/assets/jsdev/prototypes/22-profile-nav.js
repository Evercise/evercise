function profileNav(nav){
    this.nav = nav;
    this.scroll = 0;
    this.top = $('#nav').height();
    this.stickyTop = (this.nav.offset().top - this.nav.height());
    this.url = document.URL;
    this.addListeners();
    console.log( this.url);
}

profileNav.prototype = {
    constructor: profileNav,
    addListeners : function(){
        $(window).scroll($.proxy(this.checkScrollPosition, this) );
        this.nav.find('a').on('click', $.proxy( this.changeTabs, this));
    },
    checkScrollPosition : function(e){
        this.scroll = $(e.target).scrollTop();
        if (this.scroll > this.stickyTop ) {
            this.addStickyClass();
        }
        else{
            this.removeStickyClass();
        }
    },
    addStickyClass: function(){
        this.nav.addClass('navbar-fixed-top');
        this.nav.css({'top': this.top })
        $('.profile-panels').css({'margin-top': this.nav.outerHeight(true) })
    },
    removeStickyClass: function(){
        this.nav.removeClass('navbar-fixed-top');
        this.nav.css({'top':0 })
        $('.profile-panels').css({'margin-top':0 })
    },
    changeTabs: function(e){
        e.preventDefault()
        var history = $(e.target).attr('href').substring(1);
        window.history.pushState(null, history,history);
    }
}
