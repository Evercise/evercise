function EditClass(form){
    this.form = form;
    this.addListeners();
}
EditClass.prototype = {
    constructor: EditClass,
    addListeners: function(){
        this.form.on('submit', $.proxy(this.submit, this));
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
                self.form.find(".btn-toggle-down").prop('disabled', true);
            },

            success: function (data) {
                self.edit(data);
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type='submit']").prop('disabled', false)
            }
        });
    },
    edit: function(data){
        $('#'+ data.id).html(data.view);
        $('#edit-'+ data.id).removeClass('disabled');
        $('#submit-'+ data.id).hide();
        $('#'+ data.id).parent().collapse('show');
        $('#infoToggle-'+data.id).removeClass('hide');
        datepick();
        new UpdateSession($('.update-session'));
        new RemoveSession($('.remove-session'));
        new GetMembers($('.get-members'));
    }
}