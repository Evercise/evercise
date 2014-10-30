function redirectTo(data){
    window.location.href = data.url;
}

function editClass(data){
    $('#'+ data.id).html(data.view);
    $('#submit-'+ data.id).hide();
    $('#'+ data.id).parent().collapse('show');
    $('#infoToggle-'+data.id).removeClass('hide');
}