function Cart(cart) {
    this.cart = cart;
    this.addTo = $('.add-to-class');
    this.watch();
}
Cart.prototype = {
    constructor: Cart,
    watch: function(){
        var self = this;
        $(document).on('submit', '#empty-cart', function(e){
            self.submit( $('#empty-cart'), e);
        })
        $(document).on('submit', '.remove-row', function(e){
            self.submit( $('.remove-row'), e);
        })
        $(document).on('submit', '.add-to-class', function(e){
            self.submit( $('.add-to-class'), e);
        })
    },
    submit: function(form , e){
        e.preventDefault();
        e.stopPropagation();
        new AjaxRequest(form, cart.updateCart);
    },

    updateCart: function(data){
        $('.dropdown ').addClass('open');
        $('.dropdown-cart').replaceWith(data.view);
    }
}
