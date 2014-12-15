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
        var id = this.form.find('input[name="session_id"]').val()
        this.form.find('input[type="submit"]').replaceWith('<a  href="#session-members-'+id+'" class="icon icon-people mr15 hover" data-toggle="modal" data-target="#session-members-'+id+'"></a>')
        this.ajax();
    },
    ajax: function(){
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find(".icon-people").addClass('disabled');
            },

            success: function (data) {
                self.form.append(data.view)
                self.form.find('.modal').modal('show');
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find(".icon-people").removeClass('disabled');
            }
        });
    }
}