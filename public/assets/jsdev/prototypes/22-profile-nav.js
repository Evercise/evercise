function profileNav(nav){
    this.nav = nav;
    this.scroll = 0;
    this.top = $('#nav').height();
    this.stickyTop = (this.nav.offset().top - this.nav.height());
    this.url = document.URL;
    this.lastOfUrl = '';
    this.addListeners();
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
        var target = $(e.target).attr('href').substring(1);
        this.getUrl();

        if(this.nav.data('name') == this.lastOfUrl)
        {
            window.history.pushState(null, this.lastOfUrl+'/'+target,this.lastOfUrl+'/'+target);
        }
        else{
            window.history.pushState(null, target,target);
        }
    },
    getUrl: function(){
        var url = window.location.pathname;
        var array = url.split("/");
        array.reverse();
        this.lastOfUrl = array[0] != '' ? array[0] : array[1];
    }
}
