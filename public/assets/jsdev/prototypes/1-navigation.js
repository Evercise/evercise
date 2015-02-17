var Navigation = function (nav, hero) {

    this.nav = nav;
    this.hero = hero;
    this.height = nav.height();
    this.heroClass = 'nav-hero';
    this.scroll = 0;
    this.init();
}

Navigation.prototype = {
    constructor: Navigation,

    init: function () {
        if (this.hero.length > 0) {
            this.addHeroClass();
            //this.checkScrollPosition();
        }
    },
    addHeroClass: function () {
        this.nav.addClass(this.heroClass);
    },
    removeHeroClass: function () {
        this.nav.removeClass(this.heroClass);
    },
    checkScrollPosition: function () {
        // refrence this for use outside of this scope
        var self = this;
        $(window).scroll(function (event) {
            self.scroll = $(window).scrollTop();
            if (self.scroll + self.height >= self.hero.outerHeight()) {
                self.removeHeroClass()
            }
            else {
                self.addHeroClass();
            }
        })
    }
}

