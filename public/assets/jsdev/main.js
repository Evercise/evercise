$.ajaxSetup({
    headers: {
        'X-CSRF-Token': TOKEN
    }
});

$(function(){

    // initialise nav bar is nav bar exists
    $('#nav').exists(function() {
        new Navigation( this , $('.hero-nav-change') );
    });

    // initialise masonry if masonry container exists
    $('.masonry').exists(function() {
       new Masonry( this );
    })

    // initialise user profile if user profile exists
    /*
    $('#user-nav-bar').exists(function() {
        new Profile(this);
    });
    */

    // used to change a button on click
    $('.toggle-switch').exists(function() {
        $(document).on('click', '.toggle-switch', function(e){
            new ToggleSwitch($(e.target));
        })
    });

    $('.map_canvas').exists(function() {
        map = new Map(this);
    });
    $('.lazy').exists(function() {
        $("img.lazy").lazyload();
    });


    $('.mb-scroll').exists(function(){
        $(this).mCustomScrollbar({
            scrollSpeed: 50,
            mouseWheelPixels: 50,
            autoHideScrollbar: false,
            scrollInertia: 0
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


    $('.hide-by-class').exists(function(){
        var i = 0;
        $('.hide-by-class').each(function(){
            var self = this;

            $('.'+$(this).attr('href').substr(1)).exists(function(){
                if(i == 0){
                    $(self).addClass('active');
                    $(self).parent().removeClass('hidden-mob');
                    $(this).removeClass('hide');
                }
                else{

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

    $('.login-form').exists(function(){
        new Login(this);
    })
    $('.edit-class-inline').exists(function(){
        new EditClass(this);

        $(document).on('submit', '.add-session', function(e){
            e.preventDefault();
            new AjaxRequest($(e.target), newSessionAdded);
        })
    })

    $(document).on('submit', '.remove-session', function(e){
        e.preventDefault();
        new AjaxRequest($(e.target), removeSessionRow);
    })

    // always run cart
    cart = new Cart(this);

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
        new profileNav(this)
        /*
        window.addEventListener("popstate", function(e) {
            console.log(e);
            var activeTab = $('[href=' + location.hash + ']');
            console.log(activeTab);
            if (activeTab.length) {
                activeTab.tab('show');
            } else {
                $('.nav-tabs a:first').tab('show');
            }
        });
        */
    })
    $('.rate-it').exists(function(){
        new RateIt(this);
    })
    $('#add-topup').exists(function(){
        new topUp(this);
    })
    $('#change-password').exists(function(){
        new changePassword(this);
    })
    $('#location-auto-complete').exists(function(){
        autocomplete = new LocationAutoComplete(this);
    })
    $('#checkout').exists(function(){
        new checkout(this);
    })
    $('#voucher').exists(function(){
        new voucher(this);
    })

    $('#refer-a-friend').exists(function(){
        new Referral(this);
    })
    $('#update-user-form').exists(function(){
        new updateProfile(this);
    })
    $('#list-accordion').exists(function(){
        new listAccordion(this);
    })

    $('#hero-carousel , #image-carousel').exists(function() {
        $(this).carousel({
            interval: 5000
        })
    })
    $('.mail-popup').exists(function(){
        new MailPopup(this);
    })

    $('#withdraw-funds').exists(function(){
        new Withdrawal(this);
    })
    $('.remove-session').exists(function(){
        new RemoveSession(this);
    })


    $('.landing-popup').exists(function(){
        $(document).on('click', '.close', function(){
            $('.landing-popup').addClass('hidden');
            $('.landing-mask').addClass('hidden');
        })
    })

    $('#passwords_reset').exists(function(){
        $(document).on('submit', '#passwords_reset', function(e){
            e.preventDefault();
            new AjaxRequest($(e.target), redirectTo);
        })
    })

    $('.trapezium').exists(function(){
        new trapezium(this);
    })

    $('.category-select').exists(function(){
        new categoryAutoComplete(this);
    })

    if (navigator.geolocation) {
        new myLocation();
    }

    $(".select-box").selectbox();

    $('.sticky').exists(function(){
        var sticky = this;
        var top =  sticky.offset().top;
        $(window).scroll(function(){
            var y = $(this).scrollTop();
            if(  y >= top){
                sticky.addClass('fixed');
            }
            else{
                sticky.removeClass('fixed');
            }
        })
    })

    $('#class-calendar').exists(function(){
        //new classCalendar(this);
    })
});