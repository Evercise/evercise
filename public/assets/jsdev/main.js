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
        $(this).on('click', function(){
            new ToggleSwitch($(this) );
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
        self = this;
        new Validation(this);
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
        $(document).on('submit', login, function(e){
            e.preventDefault();
            new AjaxRequest(login, redirectTo);
        })
    })
    $('.edit-class-inline').exists(function(){
        $(this).on('submit', function(e){
            e.preventDefault();
            $(this).find('.btn-toggle-down').addClass('loading');
            new AjaxRequest($(this), editClass);
        })
    })


    $('.dropdown-cart').exists(function(){
        cart = new Cart(this);
    })









});