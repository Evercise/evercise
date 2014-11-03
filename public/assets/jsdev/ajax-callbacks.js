function redirectTo(data){
    window.location.href = data.url;
}

function editClass(data){
    $('#'+ data.id).html(data.view);
    $('#submit-'+ data.id).hide();
    $('#'+ data.id).parent().collapse('show');
    $('#infoToggle-'+data.id).removeClass('hide');
    datepick();
    /*
    updateSession();

    deleteSession();
    */
}

function updateHubRow(data){
    alert('row '+data.id+' edited');
}

function newSessionAdded(data){
    $('#'+ data.id).html(data.view);
    addSession();
    datepick();
}

function removeSessionRow(data){
    $('#hub-static-row-'+data.id).remove();
}