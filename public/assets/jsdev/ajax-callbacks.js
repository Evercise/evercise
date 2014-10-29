function redirectTo(data){
    window.location.href = data.url;
}

function updateCart(data){

    var cart = $('.dropdown-cart');
    cart.find('#cart-sub-total').html(data.subTotal);
    cart.find('#cart-total').html(data.total);
    cart.find('#cart-discount').html(data.discount);
    cart.dropdown('toggle');
    cart.find('.btn').prop('disabled', false);

    console.log(data);

}