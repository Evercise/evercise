function Cart(cart) {
    this.cart = cart;
    this.subTotalElem = cart.find('#cart-sub-total');
    this.totalElem = cart.find('#cart-total');
    this.discountElem = cart.find('#cart-discount');
    this.empty = cart.find('#empty-cart');
    this.addTo = $('.add-to-class');
    this.watch();
}
Cart.prototype = {
    constructor: Cart,
    watch: function(){
        var self = this;
        this.empty.on("click", function(e){
            self.submit( $(this), e);
        })
        this.addTo.on('submit', function(e){
            self.submit( $(this), e);
        })
    },
    submit: function(form , e){
        e.preventDefault();
        e.stopPropagation();
        new AjaxRequest(form, cart.updateCart);
    },

    updateCart: function(data){
        cart.cart.dropdown('toggle');
        cart.cart.replaceWith(data.view);
    }
}
