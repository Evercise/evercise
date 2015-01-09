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
        startDate: "+2d",
        autoclose: true,
        todayHighlight: true
    });
}

function objectSize(the_object) {
    var object_size = 0;
    for (key in the_object){
        if (the_object.hasOwnProperty(key)) {
            object_size++;
        }
    }
    return object_size;
}
