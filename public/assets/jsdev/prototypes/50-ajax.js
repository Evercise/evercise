var AjaxRequest = function (form, callback){
    this.form = form;
    this.actionUrl = form.attr('action');
    this.method = form.attr('method');
    this.data = form.serialize();
    this.dataType = 'json';
    this.validationScrollSpeed = 200;
    this.validationoffset = 85;
    this.validationscroll = false;
    this.callbackname = callback;
    this.disableButton();
    this.init();
}

AjaxRequest.prototype = {
    constuctor: AjaxRequest,
    init: function(){
        self = this;
        $.ajax({
            url:  self.actionUrl,
            type: self.method,
            data: self.data,
            dataType: self.dataType
        }).done(
            function(data) {
                self.callbackSelctor(data);
            }
        );
    },
    disableButton: function(){
        this.form.find('input[type="submit"]').prop('disabled', true);
    },
    renableButton: function(){
        this.form.find('input[type="submit"]').prop('disabled', false);
    },
    callbackSelctor: function(data){
        if(data.callback == 'error')
        {
            self.failedValidation(data);
        }
        else {
            self.callbackname(data);
        }
    },
    failedValidation: function(data){
        self = this;
        var arr = data.errors;

        if(self.form.attr('id') == 'login-form'){
            self.form.find("input[name = 'password']").after('<div class="mt10 alert alert-danger alert-dismissible" role="alert">'+arr+'<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>');
        }
        else
        {
            $.each(arr, function(index, value)
            {
                if (self.validationscroll == false) {
                    self.form.find("#" + index).focus();
                    $('html, body').animate({ scrollTop: self.form.find("#" + index).offset().top - self.validationoffset }, self.validationScrollSpeed);
                    self.validationscroll = true;
                }
                self.form.find('#' + index).parent().addClass('has-error');
                self.form.find('#' + index).parent().find('.glyphicon-ok').remove();
                self.form.find('#' + index).after('<small class="help-block" data-bv-validator="notEmpty" data-bv-for="'+index+'" data-bv-result="INVALID">'+value+'</small>');
                self.form.find('#' + index).after('<i class="form-control-feedback glyphicon glyphicon-remove" data-bv-icon-for="'+index+'" style="display: block;"></i>');
            })
        }

        self.renableButton();
    }

}
