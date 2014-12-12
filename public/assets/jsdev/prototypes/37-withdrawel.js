function Withdrawal(form){
    this.form = form;
    this.modal = '';
    this.addListeners();
}

Withdrawal.prototype = {
    constructor : Withdrawal,
    addListeners: function(){
        this.form.on('submit', $.proxy(this.submit, this));
        $(document).on('submit', '#request-withdrawal-form', $.proxy(this.submit, this));
        $(document).on('input', 'input[name="paypal"]', $.proxy(this.removeValidation, this));
        $(document).on('input', 'input[name="amount"]', $.proxy(this.removeValidation, this));
    },
    submit : function(e){
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
                self.form.find('input[type="submit"]').prop('disabled', true);
            },

            success: function (data) {
                if(data.view){
                    $('body').append(data.view);
                    self.form.find('input[type="submit"]').replaceWith('<a  href="#request-withdrawal" class="btn btn-default" data-toggle="modal" data-target="#request-withdrawal">Request Funds</a>')
                    self.modal = $('#request-withdrawal');
                    self.modal.modal('show');
                }
                else if(data.validation_failed = 1){
                    self.failedValidation(data);
                }
                else{
                    location.reload();
                }

            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find('input[type="submit"]').prop('disabled', false);
            }
        });
    },
    removeValidation: function(e){
        $(e.target).parent().removeClass('has-error mb40');
        $(e.target).parent().find('.help-block:visible').remove();
    },
    failedValidation: function(data){
        self = this;
        var arr = data.errors;
        $.each(arr, function(index, value)
        {
            self.form.find('input[name="' + index + '"]').parent().addClass('has-error mb40');
            self.form.find('input[name="' + index + '"]').parent().find('.help-block:visible').remove();
            self.form.find('input[name="' + index + '"]').after('<small class="help-block" data-bv-validator="notEmpty" data-bv-for="' + index + '" data-bv-result="INVALID">' + value + '</small>');
        })
    }
}