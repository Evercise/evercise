function profileNav(nav){
    this.nav = nav;
    this.scroll = 0;
    this.stickyTop = this.nav.offset().top;
    this.url = document.URL;
    this.lastOfUrl = '';
    this.init();
    this.addListeners();
}

profileNav.prototype = {
    constructor: profileNav,
    init : function(){
        new Masonry( $('.masonry') );
    },
    addListeners : function(){
        $(window).scroll($.proxy(this.checkScrollPosition, this) );
        $(window).on('popstate',$.proxy(this.checkHistoryState, this) );
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
    checkHistoryState: function(e){
        if(e.type == 'popstate'){
            this.getUrl()
            $('.nav-pills li').removeClass('active');
            $('a[href="#'+this.lastOfUrl+'"]').parent().addClass('active');
            $('.profile-panels').addClass('hidden');
            $('#'+this.lastOfUrl).removeClass('hidden');
            new Masonry( $('.masonry') );
        }
    },
    addStickyClass: function(){
        this.nav.addClass('navbar-fixed-top');
        $('.profile-panels').css({'margin-top': this.nav.outerHeight(true) })
    },
    removeStickyClass: function(){
        this.nav.removeClass('navbar-fixed-top');
        $('.profile-panels').css({'margin-top':0 })
    },
    changeTabs: function(e){
        e.preventDefault()
        var target = $(e.target).attr('href').substring(1);
        $('.nav-pills li').removeClass('active');
        $(e.target).parent().addClass('active');
        $('.profile-panels').addClass('hidden');
        $('#'+target).removeClass('hidden');


        this.getUrl();

        if(this.nav.data('name') == this.lastOfUrl)
        {
            window.history.pushState(null, this.lastOfUrl+'/'+target,this.lastOfUrl+'/'+target);
        }
        else{
            window.history.pushState(null, target,target);
        }
        new Masonry( $('.masonry') );
    },
    getUrl: function(){
        var url = window.location.pathname;
        var array = url.split("/");
        array.reverse();
        this.lastOfUrl = array[0] != '' ? array[0] : array[1];
    }
}
