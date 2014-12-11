function GetMembers(form){
    this.form = form;
    this.addListeners();
}

GetMembers.prototype = {
    constructor: GetMembers,
    addListeners: function(){
        this.form.on('submit', $.proxy(this.submit, this))
    },
    submit: function(e){
        e.preventDefault();
        this.form = $(e.target)
        this.form.find('input[type="submit"]').replaceWith('<a  href="#session-members" class="icon icon-people mr15 hover" data-toggle="modal" data-target="#session-members"></a>')
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
            },

            success: function (data) {
                self.form.after(data.view)
                $('#session-members').modal('show');
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type='submit']").prop('disabled', false)
            }
        });
    }
}