function Cart(cart) {
    this.cart = cart;
    this.form = '';
    this.maxQty = '2000';

    this.addListeners();
    if($('.checkout').length){
        this.step = 0;
        this.viewPrice = VIEWPRICE;
        console.log(this.viewPrice);
        this.checkout();
    }
}
Cart.prototype = {
    constructor: Cart,
    addListeners: function(){
        $(document).on('submit', '#empty-cart', $.proxy(this.submit, this));
        $(document).on('submit', '.remove-row', $.proxy(this.submit, this));
        $(document).on('submit', '.add-to-class', $.proxy(this.submit, this));
        $(document).on('change', '.btn-select', $.proxy(this.changeSelectDropdown, this));
        $(document).on('click', '.toggle-select .switch a', $.proxy(this.switchQty, this));
        $(document).on('click','#stripe-button' ,$.proxy(this.openStripe, this));
        $(window).on('popstate', $.proxy(this.closeStripe, this));
    },
    changeSelectDropdown: function(e){
        if($(e.target).hasClass('select-box') ){
            $(e.target).closest('.add-to-class').trigger('submit');
        }
        else if( $(e.target).val() ){
            $(e.target).css('z-index', 1);
            $(e.target).closest('.add-to-class').trigger('submit');
        }else{
            $(e.target).css('z-index', 0);
        }

    },
    switchQty: function(e){
        e.preventDefault();
        e.stopPropagation();
        var toggle = $(e.target).closest('.toggle-select');
        this.maxQty = $(toggle).data('qty');
        var trigger = $(toggle).data('trigger');

        var type = $(e.target).attr('href').substring(1);
        var currentQty = $(toggle).find('#toggle-quantity').val();
        if(type == 'plus'){
            if(currentQty < this.maxQty){
                var qty = Math.max(parseInt(currentQty ) + 1)
                $(toggle).find('#toggle-quantity').val( qty );
                $(toggle).find('#qty').text( qty );
            }
        }
        else{
            if(currentQty > 1){
                var qty = Math.max(parseInt(currentQty ) - 1)
                $(toggle).find('#toggle-quantity').val( qty );
                $(toggle).find('#qty').text( qty );
            }
        }

        if(trigger){
            $(e.target).closest('.add-to-class').trigger('submit');
        }

    },
    submit: function(e){
        e.preventDefault();
        e.stopPropagation();
        this.form = $(e.target);
        this.ajaxSubmit();
    },
    ajaxSubmit: function(){
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                if(self.form.find('input[type="submit"]').hasClass('add-btn') ){
                    self.form.find("input[type='submit']").prop('disabled', true);;
                }
                else{
                    self.form.find("input[type='submit']").replaceWith('<span id="cart-loading" class="icon icon-loading"></span>');
                }
                self.form.find(".switch").addClass('disabled');

            },

            success: function (data) {
                if(data.view){
                    self.updateCart(data);
                }
                else if(data.refresh){
                    location.reload();
                }
                else if(data.validation_failed == 1){
                    self.failedValidation(data);
                }
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type=submit]").prop('disabled', false);
                $('#cart-loading').remove();
                self.form.find(".switch").removeClass('disabled');
            }
        });
    },
    updateCart: function(data){
        $('.cart-dropdown:visible').addClass('open');
        $('.cart-dropdown.open .dropdown-cart').replaceWith(data.view);
        $('#cart-items').html(data.items);
    },
    failedValidation: function(data){
        $('body').append('<div class="mt10 alert alert-danger alert-dismissible fixed" >'+data.errors.custom+'<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>');
    },
    checkout: function(){
        $('#step-2').on('shown.bs.collapse', function (e) {
            console.log(e);
            $('#step-1').find('.switch').addClass('hidden');
            $('#step-1').find('.switch-back').removeClass('hidden');
            $('.cart-progress').find('#progress-2').addClass('complete');
            /*setTimeout(function(){
                $('html, body').animate({
                    scrollTop: $('#step-2').offset().top
                }, 500);
            }, 100)
            */

        })
    },
    openStripe: function(e){
        var self = this;
        // Open Checkout with further options
        handler.open({
            name: 'Evercise',
            description: 'Checkout',
            amount: self.viewPrice
        });
        e.preventDefault();
    },
    closeStripe: function(e){
        handler.close();
    }
}
