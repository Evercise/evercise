function checkout(checkout){
    this.checkout = checkout;
    this.viewPrice = viewPrice;
    this.addListeners();
}
checkout.prototype ={
    construstor: checkout,
    addListeners: function(){
        this.checkout.find('#stripe-button').on('click', $.proxy(this.openStripe, this))
        $(window).on('popstate', $.proxy(this.closeStripe, this));
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