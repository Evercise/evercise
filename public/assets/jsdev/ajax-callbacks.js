function redirectTo(data){
    window.location.href = data.url;
}

function editClass(data){
    $('#'+ data.id).html(data.view);
    $('#submit-'+ data.id).hide();
    $('#'+ data.id).parent().collapse('show');
    $('#infoToggle-'+data.id).removeClass('hide');
    $('.update-session').on('submit', function(e){
        e.preventDefault();
        new AjaxRequest($(this), updateHubRow);
    })
}

function updateHubRow(data){
    alert('row '+data.id+' edited');
}