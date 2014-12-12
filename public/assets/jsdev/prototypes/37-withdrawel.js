function Withdrawal(form){
    this.form = form;
    this.addListeners();
}

Withdrawal.prototype = {
    constructor : Withdrawal,
    addListeners: function(){
        this.form.on('submit', $.proxy(this.getWithrawelView, this));
    },
    getWithrawelView : function(e){
        e.preventDefault();
        this.ajax();
    },
    ajax: function(){
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find('input[type="submit"]').prop('disabled', true);
            },

            success: function (data) {
                self.form.append(data.view);
                self.form.find('input[type="submit"]').replaceWith('<a  href="#request-withdrawal" class="btn btn-default" data-toggle="modal" data-target="#request-withdrawal">Request Funds</a>')
                self.form.find('#request-withdrawal').modal('show');
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find('input[type="submit"]').prop('disabled', false);
            }
        });
    }
}