function redirectTo(data){
    window.location.href = data.url;
}

function updateCart(data){
    var cart = $('.nav-cart');
    cart.dropdown('toggle');
    $('.nav-cart').find('#cart-sub-total').html(5000);
    cart.find('#cart-sub-total').remove();
    cart.find('#cart-total').html(data.total);
    cart.find('#cart-discount').html(data.discount);

    console.log(data.cartRows);

}