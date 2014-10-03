$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){
    $('.navbar').exists(function() {
        new Navigation( $('.navbar') , $('.hero') );
});

})

