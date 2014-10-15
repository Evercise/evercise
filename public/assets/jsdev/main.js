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

    new Placeholder();

})


var updating_price = 0;
(function (f) {
    function l(g, h) {
        function d(a) {
            if (!e) {
                e = true;
                c.start && c.start(a, b)
            }
        }

        function i(a, j) {
            if (e) {
                clearTimeout(k);
                k = setTimeout(function () {
                    e = false;
                    c.stop && c.stop(a, b)
                }, j >= 0 ? j : c.delay)
            }
        }

        var c = f.extend({start: null, stop: null, delay: 400}, h), b = f(g), e = false, k;
        b.keypress(d);
        b.keydown(function (a) {
            if (a.keyCode === 8 || a.keyCode === 46)d(a)
        });
        b.keyup(i);
        b.blur(function (a) {
            i(a, 0)
        })
    }

    f.fn.typing = function (g) {
        return this.each(function (h, d) {
            l(d, g)
        })
    }
})(jQuery);
$(document).ready(function () {


    function removeEvents() {
        document.body.removeEventListener('click', sendInteractionEvent);
        window.removeEventListener('scroll', sendInteractionEvent);
    }

    function sendInteractionEvent(e) {

        _gaq.push(['_trackEvent', 'Inital interaction', 'scrool or click' , 'trigered']);
        removeEvents();
    }

    document.body.addEventListener('click', sendInteractionEvent);
    window.addEventListener('scroll', sendInteractionEvent);


    $("#searchform").submit(function (e) {
        e.preventDefault();
        var inp = $("#searchfield").val();
        if (inp != '') {
            var term = encodeURIComponent(inp);
            window.location.replace(baseUrl + "shop/search/name/" + term);
        }
    });
    $('select[name^=option_]').live('change', function () {
        this_select = $(this);
        var options = getOptions(this_select);
        var product_id = $(this).parents('form').find('input[name=product_id]').val();
        var updating_price = 1;
        $.ajax({url: baseUrl + 'ajax/shop/update_product_price', type: 'post', data: 'id=' + product_id + '&options=' + JSON.stringify(options), dataType: 'json', success: function (json) {
            if(json.price_old!==json.price){
                $(this_select).parents('form').find('.old_price').html('$' + json.price_old);

            }else{
                $(this_select).parents('form').find('.old_price').html('');

            }
            $(this_select).parents('form').find('.pr_price big').html('$' + json.price);
            $(this_select).parents('form').find('input[name=price]').val(json.price);
        }, complete: function () {
            var updating_price = 0;
        }});
    });
    $("#subscribe_to_newsletter").click(function () {
        var inp = $(this).prev();
        var email_check = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i;
        var email = $(this).prev().val();
        if (email != '' && email_check.test(email)) {
            $("#nlettergif").show();
            $.ajax({url: baseUrl + 'ajax/shop/insert_newsletter_user', type: 'post', data: 'email=' + email, dataType: 'json', success: function (json) {
                if (json.success) {
                    message(json.success, 'success');
                    inp.val('');
                    inp.attr('disabled', 'disabled');
                }
                else
                    message(json.warning, 'warning');
            }, complete: function () {
                $("#nlettergif").hide();
            }});
        }
        else
            message('Please enter valid email address', 'warning');
    });
    $('.close').live('click', function () {
        $(this).closest('.notification').slideUp(200);
        $(this).closest('#notification').slideUp(200);
    });
    if ($('#billing-shipping input[name=billing_to_shipping]').is(':checked')) {
        $('#billing-shipping .col-2 #shipping').hide();
        $('#billing-shipping .col-2 .step-message').show()
    } else {
        $('#billing-shipping .col-2 #shipping').show();
        $('#billing-shipping .col-2 .step-message').hide()
    }
    $('#billing-shipping input[name=billing_to_shipping]').live('click', function () {
        if ($(this).is(':checked')) {
            $('#billing-shipping .col-2 #shipping').hide();
            $('#billing-shipping .col-2 .step-message').show()
        } else {
            $('#billing-shipping .col-2 #shipping').show();
            $('#billing-shipping .col-2 .step-message').hide()
        }
    });
    $('input[name=payment_type]').live('click', function () {
        if ($(this).val() == 'authorize' || $(this).val() == 'custom_cc') {
            $('.credit_card_box').show();
        } else {
            $('.credit_card_box').hide();
        }
    });
});
function applyCouponCode(this_button) {
    var code = $(this_button).parents('.checkout_discount').find('input[name=coupon]').val();
    $.ajax({url: baseUrl + 'ajax/shop/cart_update', type: 'post', data: 'code=' + code, dataType: 'json', success: function (json) {
        if (json['success']) {
            message(json['success'], 'success');
            getCart();
            location.reload();
        }
    }});
}
function getCart() {
    var gif = $('#toploader');
    gif.show();
    $.ajax({url: baseUrl + 'ajax/shop/cart_get', type: 'post', dataType: 'json', success: function (json) {
        var total = json.total;
        var price = json.price;
        var shipping = json.shipping;
        if (total == null)total = 0;
        if (price == null)price = 0;
        $('.shop-info .item:first').html(total);
        $('.shop-info .item:last').html('$' + price);
        if ($('#shipping_price').length) {
            $('#shipping_price').html(shipping);
        }
    }, complete: function () {
        gif.hide();
    }});
}
function sortBy() {
    $.ajax({url: baseUrl + 'ajax/shop/cart_add', type: 'post', data: 'id=' + product_id + '&quantity=' + quantity, dataType: 'json', success: function (json) {
        $('.success, .warning, .attention, .information').remove();
        if (json['success']) {
            $('#notification').html('<div class="notification success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/leisure/images/close.png" alt="" class="close" /></div>');
            message(json['success'], 'success');
            $('.success').fadeIn('slow');
            $('html, body').animate({scrollTop: 0}, 'slow');
            getCart();
        }
    }});
}


timeuntillnextcall = null;


function doaddtocart(this_button) {
    var id = $(this_button).parents('form').find('input[name=product_id]').val();
    var qty = $(this_button).parents('form').find('input[name=qty]').val();
    var price = $(this_button).parents('form').find('input[name=price]').val();
    var options = getOptions(this_button);
    var gif = $('.smallgif');
    gif.show();


    if ($(this_button).attr('disabled')) {

    } else {
        $(this_button).attr('disabled', 'disabled');

        $.ajax({url: baseUrl + 'ajax/shop/cart_add', type: 'post', data: 'id=' + id + '&qty=' + qty + '&price=' + price + '&options=' + JSON.stringify(options), dataType: 'json', success: function (json) {
            if (json['success']) {
                clearTimeout(timeuntillnextcall);
                _gaq.push(['_trackPageview', '/add_product_to_cart.html']);
                _gaq.push(['_trackEvent', 'Add to Cart', 'Sum', json['name'], Number(qty * price)]);
                _gaq.push(['_trackEvent', 'Add to Cart', 'Items', json['name'], Number(qty)]);
                message(json['success'], 'success');
                getCart();
            } else {
                message(json['warning'], 'warning');
            }
        }, complete: function (json) {
            $(this_button).removeAttr('disabled');

            gif.hide();
        }});


    }


}
$(document).ajaxStop(function () {
    var updating_price = 0;
});


function addToCart(this_button) {


    if (updating_price == 1) {
        timeuntillnextcall = setTimeout(addToCart(this_button), 1000);
    } else {

        doaddtocart(this_button);
        clearTimeout(timeuntillnextcall);
    }


}
function getOptions(this_button) {
    var options = [];
    $(this_button).parents('form').find('select[name^=option_]').each(function () {
        var option_id = $(this).attr('name').split('_')[1];
        var option_value = $(this).val();
        if (option_value != '') {
            var new_option = {option_id: option_id, option_value: option_value};
            options.push(new_option);
        }
    });
    return options;
}
function removeFromCart(rowid) {
    var gif = $(this).parent().parent().find('.qtyloader');
    gif.show();
    $.ajax({url: baseUrl + 'ajax/shop/cart_update', type: 'post', data: 'rowid=' + rowid + '&qty=0', dataType: 'json', success: function (json) {
        if (json['success']) {
            message(json['success'], 'success');
            getCart();
            $('.full_page').html(json.data.page);
        }
    }});
}
function addToWishList(product_id) {
    $.ajax({url: baseUrl + 'ajax/shop/wishlist_add', type: 'post', data: 'id=' + product_id, dataType: 'json', success: function (json) {
        if (json['success']) {
            message(json['success'], 'success');
            $('#wishlist-total').html(json['total']);
        }
        if (json['error']) {
            message(json['error'], 'error');
        }
    }});
}
function removeFromWishList(product_id) {
    $.ajax({url: baseUrl + 'ajax/shop/wishlist_remove', type: 'post', data: 'id=' + product_id, dataType: 'json', success: function (json) {
        if (json['success']) {
            message(json['success'], 'success');
            $('#wishlist-total').html(json['total']);
            $('#product-' + product_id).fadeOut('slow', function () {
                $(this).remove();
            });
        }
    }});
}
function message(message, type) {
    if (type == undefined) {
        type = 'info';
    }
    $('#notification').hide();
    $('#notification').html('<div class="notification ' + type + '">' + message + '<img src="' + themeUrl + 'img/close.png" alt="" class="close" /></div>');
    $('#notification').fadeIn('hide');
    $('html, body').animate({scrollTop: 0}, 'slow');
}

$(function () {
    if ($('div').hasClass('triger_dropdown_event')) {
        $(document).on('click', 'div.triger_dropdown_event', function (e) {
            e.preventDefault();

            openSelect($(this).siblings("select"));


        })
    }
});


var openSelect = function (selector) {
    var element = $(selector)[0], worked = false;
    if (document.createEvent) { // all browsers
        var e = document.createEvent("MouseEvents");
        e.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
        worked = element.dispatchEvent(e);
    } else if (element.fireEvent) { // ie
        worked = element.fireEvent("onmousedown");
    }
    if (!worked) { // unknown browser / error

    }
}

