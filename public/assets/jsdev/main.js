$.ajaxSetup({
    headers: {
        'X-CSRF-Token': TOKEN
    }
});

$(function(){

    // initialise nav bar is nav bar exists
    $('.navbar').exists(function() {
        new Navigation( this , $('.hero-nav-change'), $('.sticky-fixed-nav') );
    });

    // initialise masonry if masonry container exists
    $('.masonry').exists(function() {
       new Masonry( this );
    })

    // initialise user profile if user profile exists
    $('#user-nav-bar').exists(function() {
        new Profile(this);
    });

    $('.toggle-switch').exists(function() {
        new ToggleSwitch(this);
    });

    $('.map-wrapper').exists(function() {
       // map = new Map();
      //  console.log(laracasts.mapResults);
    });


    $('.mb-scroll').exists(function(){
        $(this).mCustomScrollbar({
            scrollSpeed: 10,
            autoHideScrollbar: true
        });
    })

    $('.holder').exists(function(){
        new ImagePlaceholder();
    })

    $('#register-form').exists(function(){
        self = this;
        new Validation(this);
    })

    $('.class-preview').exists(function(){
         new PreviewClassBox(this);
    })
    $('#login-form').exists(function(){
        login = this;
        $(document).on('submit', this, function(e){
            e.preventDefault();
            new AjaxRequest(login, redirectTo);
        })
    })


});