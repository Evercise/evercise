function UpdateSessions(form){
    this.form = form;
    this.init();
}

UpdateSessions.prototype = {
    constructor: UpdateSessions,
    init: function(){
        this.addListeners();
    },
    addListeners: function(){
        this.form.on('submit', $.proxy(this.submitUpdate, this));
    },
    submitUpdate: function(e){
        e.preventDefault();
        this.ajaxUpload();
    },
    ajaxUpload: function () {
        var self = this;

        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true).append('<span id="sessionupdate-loading" class="icon icon-loading ml10 mt10"></span>');
            },

            success: function (data) {
                //$('#update-session').html(data.view);
                console.log(data);
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log('error');
                //console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type='submit']").prop('disabled', false)
                $('#sessionupdate-loading').remove();
            }
        });
    }
}
