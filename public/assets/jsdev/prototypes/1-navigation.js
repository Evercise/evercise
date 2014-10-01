
var Navigation = function(nav, hero){

    this.nav = nav;
    this.hero = hero;
    this.heroClass = 'nav-hero';
    this.scroll = 0;

    this.init();

}

    Navigation.prototype = {
    constructor: Navigation,
    init:function(){
        if(this.hero.length > 0){
            this.addHeroClass();
            this.checkScrollPosition();
        }

    },
    addHeroClass:function() {
        this.nav.addClass( this.heroClass);
    },
    removeHeroClass:function(){
        this.nav.removeClass( this.heroClass);
    },
    checkScrollPosition:function(){
        var self = this;
        $(window).scroll(function (event) {
            self.scroll = $(window).scrollTop();
            console.log(self.hero.outerHeight());
            if( self.scroll >= self.hero.outerHeight() ){
                self.removeHeroClass()
            }
            else{
                self.addHeroClass();
            }
        })
    }
}

