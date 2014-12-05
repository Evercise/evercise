function UpdateSession(form){
    this.form = form;
    this.id ='';
    this.addListeners();
}

UpdateSession.prototype = {
    constructor : UpdateSession,
    addListeners: function(){
        $('.update-session-select').on('change', $.proxy(this.sessionChanged, this));
        this.form.on('submit', $.proxy(this.submit, this));
    },
    sessionChanged: function(e){
        var form = $(e.target).attr('form');
        this.form = $('#'+form);
        this.id = this.form.find('input[name="id"]').val();
        console.log('id'+this.id );
        this.form.trigger('submit');
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
                $('#hub-edit-row-'+self.id).addClass('bg-info');
            },

            success: function (data) {
                self.update(data);
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type='submit']").prop('disabled', false);
                $('#hub-edit-row-'+self.id).removeClass('bg-info');
            }
        });
    },
    update: function(data){
        $('#hub-edit-row-'+data.id).after(data.view);
    }
}