function redirectTo(data){
    window.location.href = data.url;
}

function editClass(data){
    $('#'+ data.id).html(data.view);
    $('#edit-'+ data.id).removeClass('disabled');
    $('#submit-'+ data.id).hide();
    $('#'+ data.id).parent().collapse('show');
    $('#infoToggle-'+data.id).removeClass('hide');
    datepick();
}

function updateHubRow(data){
    $('#hub-edit-row-'+data.id).after(data.view);
}

function newSessionAdded(data){
    $('#'+ data.id).html(data.view);
    addSession();
    datepick();
}

function removeSessionRow(data){
    $('#hub-static-row-'+data.id).remove();
}