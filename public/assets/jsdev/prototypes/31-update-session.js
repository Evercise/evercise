function UpdateSession(form){
    this.form = form;
    this.addListeners();
}

UpdateSession.prototype = {
    constructor : UpdateSession,
    addListeners: function(){
        $('.update-session-select').on('change', $.proxy(this.sessionChanged, this));
        this.form.on('submit', $.proxy(this.submit, this));
    },
    sessionChanged: function(e){

    },
    submit: function(e){
        e.preventDefault();
        this.form = $(e.target);
        this.ajax();
    },
    ajax: function(){
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true);
                self.form.find(".btn-toggle-down").prop('disabled', true).addClass('loading');
            },

            success: function (data) {
                self.update(data);
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type='submit']").prop('disabled', false)
            }
        });
    },
    update: function(data){

    }
}