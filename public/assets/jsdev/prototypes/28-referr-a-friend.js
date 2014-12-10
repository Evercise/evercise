function Referral(form){
    this.form = form;
    this.addListeners();
}
Referral.prototype = {
    constructor : Referral,
    addListeners : function(){
        this.form.on('submit', $.proxy(this.submitForm, this));
        this.form.find("input[name='referee_email']").on('keydown', $.proxy(this.emailChange, this));
    },
    emailChange : function(e){
        if($(e.target).parent().addClass('has-error')){
            $(e.target).parent().removeClass('has-error');
            this.form.find('#validation-error-text').remove();
            this.form.find('#validation-error-icon').remove();
        }
    },
    submitForm : function(e){
        e.preventDefault();
        this.ajaxSubmit();
    },
    ajaxSubmit: function(){
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true);
            },

            success: function (data) {
                if( data.validation_failed == 1 ){
                    self.failedValidation(data);
                }
                else{


                    window.location.href = data.url;
                }
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type=submit]").prop('disabled', false);
            }
        });
    },
    failedValidation: function(data){
        self = this;
        var arr = data.errors;

        $.each(arr, function(index, value)
        {
            self.form.find('input[name="' + index+ '"]').parent().addClass('has-error');
            self.form.find('input[name="' + index+ '"]').after('<small id="validation-error-text" class="help-block" data-bv-validator="notEmpty" data-bv-for="'+index+'" data-bv-result="INVALID">'+value+'</small>');
            self.form.find('input[name="' + index+ '"]').after('<i id="validation-error-icon" class="form-control-feedback bv-no-label glyphicon glyphicon-remove" data-bv-icon-for="'+index+'"></i>');
        })
    }
}