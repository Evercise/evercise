$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
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

    $('#map_canvas').exists(function() {
        map = new Map();
    });

    $('.mb-scroll').exists(function(){
        $(this).mCustomScrollbar();
    })

})

