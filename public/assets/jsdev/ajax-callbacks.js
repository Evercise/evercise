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
    $('.add-session').on('submit', function(e){
        e.preventDefault();
        new AjaxRequest($(this), newSessionAdded);
    })
    $('.toggle-switch').exists(function() {
        $(this).on('click', function(){
            new ToggleSwitch($(this) );
        })
    });

    $('.date-picker').datepicker({
        format: "yyyy-mm-dd",
        startDate: "+1d",
        autoclose: true,
        todayHighlight: true
    });
}

function updateHubRow(data){
    alert('row '+data.id+' edited');
}

function newSessionAdded(data){
    console.log(data);
}