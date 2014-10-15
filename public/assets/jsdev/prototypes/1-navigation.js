var Navigation = function (nav, hero, stickyHeader) {

    this.nav = nav;
    this.hero = hero;
    this.sticky = stickyHeader;
    this.stickyTop = 0;
    this.height = nav.height();
    this.heroClass = 'nav-hero';
    this.scroll = 0;

    this.init();
    this.checkScrollPosition();

}

Navigation.prototype = {
    constructor: Navigation,

    init: function () {
        if (this.hero.length > 0) {
            this.addHeroClass();
        }
        if (this.sticky.length > 0) {
            this.stickyTop = this.sticky.offset().top;
            this.stick();
        }

    },
    addHeroClass: function () {
        this.nav.addClass(this.heroClass);
    },
    removeHeroClass: function () {
        this.nav.removeClass(this.heroClass);
    },
    addStickyClass: function(){
        this.sticky.addClass('navbar-fixed-top');
        this.sticky.css({'top':this.height })
        $('.sticky-wrapper').css({'margin-top': this.sticky.outerHeight(true) })
    },
    removeStickyClass: function(){
        this.sticky.removeClass('navbar-fixed-top');
        this.sticky.css({'top':0 })
        $('.sticky-wrapper').css({'margin-top':0 })
    },
    checkScrollPosition: function () {
        // refrence this for use outside of this scope
        var self = this;
        $(window).scroll(function (event) {
            self.scroll = $(window).scrollTop();
            self.stick();
            if (self.scroll + self.height >= self.hero.outerHeight()) {
                self.removeHeroClass()
            }
            else {
                self.addHeroClass();
            }
        })
    },
    stick: function(){
        var self = this;
        if (self.scroll > self.stickyTop - this.sticky.outerHeight(true)) {

            self.addStickyClass();
        }
        else{
            self.removeStickyClass();
        }
    }

}

