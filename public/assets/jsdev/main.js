$.ajaxSetup({
    headers: {
        'X-CSRF-Token': TOKEN
    }
});

$(function(){

    // initialise nav bar is nav bar exists
    $('.navbar').exists(function() {
        new Navigation( this , $('.hero-nav-change') );
    });

    // initialise masonry if masonry container exists
    $('.masonry').exists(function() {
       new Masonry( this );
    })

    // initialise user profile if user profile exists
    $('#user-nav-bar').exists(function() {
        new Profile(this);
    });

    // used to change a button on click
    $('.toggle-switch').exists(function() {
        $(document).on('click', '.toggle-switch', function(e){
            new ToggleSwitch($(e.target));
        })
    });

    $('.map_canvas').exists(function() {
        map = new Map(this);
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
        new registerUser(this);
    })
    $('#register-trainer').exists(function(){
        new registerTrainer(this);
    })

    $('.class-preview').exists(function(){
         new PreviewClassBox(this);
    })

    $('.hide-by-class').exists(function(){
        var i = 0;
        $('.hide-by-class').each(function(){
            var self = this;

            $('.'+$(this).attr('href').substr(1)).exists(function(){
                if(i == 0){
                    $(self).addClass('active');
                    $(this).removeClass('hide');
                }
                $(self).removeClass('disabled');
                i++;
            })

        })
        this.click(function(){
            $('.hide-by-class').removeClass('active');
            $(this).addClass('active');
            $('.hide-by-class-element').addClass('hide');
            $('.'+ $(this).attr('href').substr(1)).removeClass('hide');
        })
    })

    $('#login-form').exists(function(){
        login = this;
        $(document).on('submit', '#login-form', function(e){
            e.preventDefault();
            new AjaxRequest(login, redirectTo);
        })
    })
    $('.edit-class-inline').exists(function(){
        $(document).on('submit', '.edit-class-inline', function(e){
            e.preventDefault();
            $(e.target).find('.btn-toggle-down').addClass('loading');
            new AjaxRequest($(e.target), editClass);
        })
        $(document).on('submit', '.add-session', function(e){
            e.preventDefault();
            new AjaxRequest($(e.target), newSessionAdded);
        })
        $(document).on('submit', '.update-session', function(e){
            e.preventDefault();
            new AjaxRequest($(e.target), updateHubRow);
        })

        $(document).on('submit', '.remove-session', function(e){
            e.preventDefault();
            new AjaxRequest($(e.target), removeSessionRow);
        })
    })

    $(document).on('submit', '.remove-session', function(e){
        e.preventDefault();
        new AjaxRequest($(e.target), removeSessionRow);
    })


    $('.dropdown-cart').exists(function(){
        cart = new Cart(this);
    })
    $('#find_gallery_image_by_category').exists(function(){
        new categorySelect($(this) );
    })


    $('#image-cropper').exists(function(){
        new imageCropper(this);
    })
    $('#create-venue').exists(function(){
        new createVenue(this);
    })

    $('#add-session').exists(function(){
       // new AddSessions(this);
        new AddSessionsToCalendar(this);
    })
    $('#update-sessions').exists(function(){
        new UpdateSessions(this);
    })
    $('#create-class').exists(function(){
        new createClass(this);
    })
    $('#preview').exists(function(){
        new previewBox(this);
    })
    $('#publish-class').exists(function(){
        new publishClass(this);
    })
    $('#register-fb').exists(function(){
        new facebookRedirect(this);
    })

    $('#scroll-to').exists(function(){
        new scrollTo(this);
    })
    $('#profile-nav').exists(function(){
        new profileNav(this);
    })
    $('.rate-it').exists(function(){
        new RateIt(this);
    })
    $('#location-auto-complete').exists(function(){
        autocomplete = new LocationAutoComplete(this);
    })


});