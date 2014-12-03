function Cart(cart) {
    this.cart = cart;
    this.form = '';
    this.addListeners();
}
Cart.prototype = {
    constructor: Cart,
    addListeners: function(){
        $(document).on('submit', '#empty-cart', $.proxy(this.submit, this));
        $(document).on('submit', '.remove-row', $.proxy(this.submit, this));
        $(document).on('submit', '.add-to-class', $.proxy(this.submit, this));
        $(document).on('change', '.btn-select', $.proxy(this.changeSelectDropdown, this));
    },
    changeSelectDropdown: function(e){
        if( $(e.target).val() ){
            $(e.target).css('z-index', 1);
        }else{
            $(e.target).css('z-index', 0);
        }
    },
    submit: function(e){
        e.preventDefault();
        e.stopPropagation();
        this.form = $(e.target);
        //new AjaxRequest(form, cart.updateCart);
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
                    self.form.find("input[type='submit']").replaceWith('<span id="cart-loading" class="icon icon-loading ml10"></span>');
                }

            },

            success: function (data) {
                if(data.view){
                    self.updateCart(data);
                }
                else if(data.refresh){
                    location.reload();
                }
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type=submit]").prop('disabled', false);
                $('#cart-loading').remove();
            }
        });
    },
    updateCart: function(data){
        $('#cart-dropdown').addClass('open');
        $('#cart-dropdown .dropdown-cart').replaceWith(data.view);
    }
}
