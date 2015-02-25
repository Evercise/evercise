function Cart(cart) {
    this.cart = cart;
    this.form = '';
    this.maxQty = '2000';

    this.addListeners();
    if($('.checkout').length){
        this.step = 0;
        this.viewPrice = VIEWPRICE;
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
        $(document).on('change', 'select[name="quantity"]', $.proxy(this.selectQty, this));
    },
    changeSelectDropdown: function(e){
        if($(e.target).hasClass('qty-select') ){
            this.selectQty(e);
        }
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
    selectQty : function(e){
        var qty = $(e.target).val();
        $(e.target).closest('.qty-wrapper').find('.qty-select').val(qty);
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
                if(self.form.find('select[name="quantity"]') ){
                    self.form.find('select[name="quantity"]').parent().addClass('disabled');
                }
                if(self.form.find('input[type="submit"]').hasClass('add-btn') ){
                    self.form.find("input[type='submit']").prop('disabled', true);

                }
                else{
                    self.form.find("input[type='submit']").replaceWith('<span id="cart-loading" class="icon icon-loading"></span>');
                }
                if($('.checkout .mask').length){
                    $('.mask').removeClass('hidden');
                }
                self.form.find(".switch").addClass('disabled');

            },

            success: function (data) {
                if(data.view){
                    $('html,body').animate({scrollTop:0}, 300);
                    setTimeout(function(){
                        self.updateCart(data);
                    }, 300);
                    if($('.checkout .mask').length){
                        $('.checkout .mask').addClass('hidden');
                    }
                }
                else if(data.refresh){
                    location.reload();
                }
                else if(data.validation_failed == 1){
                    self.failedValidation(data);
                    if($('.mask').length){
                        $('.mask').addClass('hidden');
                    }
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
        $('.basket').replaceWith(data.view);
        $('.cart-items').html(data.items);
        if(!$('.basket').hasClass('checkout--active')){
            setTimeout(function(){
                $('.basket').find('.checkout__button ').trigger('click');
            },300)
        }
    },
    failedValidation: function(data){
        $('body').append('<div class="mt10 alert alert-danger alert-dismissible fixed" >'+data.errors.custom+'<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>');
    },
    checkout: function(){
        this.newUserForm = $('.checkout #new-user-form');
        this.loginForm = $('.checkout .login-form');
        this.userType = 'new';
        var self = this;
        if(STEP){
            $('a[href="#step-'+STEP+'"]').trigger('click');
        }
        $('#step-2').on('shown.bs.collapse', function (e) {
            var t = $(e.target).attr('id');
            $('a[href="#'+t+'"]').addClass('hidden');
            $('#step-1').find('.switch-cart').addClass('hidden');
            $('#step-1').find('.switch-back').removeClass('hidden');
            $('.cart-progress').find('#progress-2').addClass('complete');
            setTimeout(function(){
                $('html, body').animate({ scrollTop: $(e.target).offset().top }, 500);
            }, 800)

        });

        $(document).on('change', ':checkbox', function(e){
            var name = $(e.target).attr('name');
            $(':checkbox').prop("checked", false);
            $('input[name="'+name+'"]').prop("checked", true);
            self.userType = name;
            if(self.userType == 'ps'){
                $('input[name="password"]').focus();
            }
        })

        $(document).on('keyup', self.loginForm.find('input[name="email"]') , function(e){
            self.newUserForm.find('input[name="email"]').val($(e.target).val())
        })
        $(document).on('click', '#cart-account', function(e){
            e.preventDefault();
            if(self.userType == 'new'){
                self.newUserForm.trigger('submit');
            }
            else{ this
                self.loginForm.trigger('submit');
            }
        })
        $(document).on( 'submit','.checkout #new-user-form', $.proxy(this.newUser,this));
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
    },
    newUser : function(e){
        e.preventDefault();
        var self = this;
        self.newUserForm.find('input[name="email"]').val( self.loginForm.find('input[name="email"]').val());
        $.ajax(self.newUserForm.attr("action"), {
            type: "post",
            data: self.newUserForm.serialize(),
            dataType: 'json',

            beforeSend: function () {
                $('.has-error').removeClass('has-error');
                $('.error-append').remove()
                $("#cart-account").prop('disabled', true);
            },

            success: function (data) {
                if( data.validation_failed == 1 ){
                    self.failedValidation(data);
                }
                else{
                    var url = window.location.href;
                    url = url +'/2';
                    window.location.href = url;
                }

            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                $("#cart-account").prop('disabled', false);
            }
        });


    },
    failedValidation : function(data){
        var self = this;
        var arr = data.errors;
        $.each(arr, function(index, value) {
            self.loginForm.find('input[name="' + index + '"]').parent().addClass('has-error').after('<div class="form-control input-lg input-group has-error error-append">' + value + '</div>');
        })

    }
}
