$.fn.exists = function(callback) {
    var args = [].slice.call(arguments, 1);

    if (this.length) {
        callback.call(this, args);
    }

    return this;
};

function datepick(){
    $('.date-picker').datepicker({
        format: "yyyy-mm-dd",
        startDate: "+1d",
        autoclose: true,
        todayHighlight: true
    });
}

/*


function updateSession(){
    $('.update-session').on('submit', function(e){
        e.preventDefault();
        new AjaxRequest($(this), updateHubRow);
    })
}

function deleteSession(){
    $('.remove-session').on('submit', function(e){
        e.preventDefault();
        new AjaxRequest($(this), removeSessionRow);
    })
}
*/