var Profile = function (nav) {
    this.nav = nav;
    this.top = 0;
    this.speed = 400;
    this.init();
}

Profile.prototype = {
    constructor: Profile,
    // tempary switch between views

    init: function () {

        this.top = Math.floor( this.nav.offset().top  - this.nav.outerHeight(true) );

        var self = this;

        $(document).on('click', '.nav-pills li a', function(){

            destination = $(this).attr('href');
            $('.nav-pills li').removeClass('active');
            $(this).parent().addClass('active');
            $('.profile-panels').addClass('hidden');
            $(destination).removeClass('hidden');

            new Masonry( $('.masonry') );
            self.scroll();

        })
    },
    scroll: function(){
      //  $('html, body').animate({scrollTop : this.top }, this.speed);
    }
}