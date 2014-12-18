function RemoveSession(form){
    this.form = form;
    this.id ='';
    this.addListeners();
}

RemoveSession.prototype = {
    constructor : RemoveSession,
    addListeners: function(){
        this.form.on('submit', $.proxy(this.submit, this));
    },
    submit: function(e){
        e.preventDefault();
        this.form = $(e.target);
        this.id = this.form.find('input[name="id"]').val();
        this.ajax();
        console.log('sub');
    },
    ajax: function(){
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true);
                $('#hub-edit-row-'+self.id).addClass('bg-danger');
            },

            success: function (data) {
                self.remove(data);
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
    remove: function(data){
        $('#hub-edit-row-'+data.id).fadeOut(400);
    }
}