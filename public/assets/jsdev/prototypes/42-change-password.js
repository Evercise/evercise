function changePassword(form){
    this.form = form;
    this.validIcon = 'glyphicon glyphicon-ok';
    this.invalidIcon = 'glyphicon glyphicon-remove';
    this.validatingIcon = 'glyphicon glyphicon-refresh';
    this.password = {
        validators: {
            notEmpty: {
                message: 'Your password is required and cannot be empty'
            },
            stringLength: {
                min: 6,
                max: 32,
                message: 'Your Password must be more than 6 and less than 32 characters long'
            },
            identical: {
                field: 'new_password_confirmation',
                message: 'Your passwords do not match'
            }
        }
    },
    this.confirmed_password = {
        validators: {
            notEmpty: {
                message: 'Your password is required and cannot be empty'
            },
            stringLength: {
                min: 6,
                max: 32,
                message: 'Your Password must be more than 6 and less than 32 characters long'
            },
            identical: {
                field: 'new_password',
                message: 'Your passwords do not match'
            }
        }
    };
    this.validation();
}
changePassword.prototype = {
    constructor : changePassword,
    validation: function(){
        var self = this;
        this.form.bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: this.validIcon,
                invalid: this.invalidIcon,
                validating: this.validatingIcon
            },

            fields: {
                new_password: this.password,
                new_password_confirmation: this.confirmed_password
            }
        })
        .on('success.form.bv', function(e) {
            e.preventDefault();
            self.ajaxUpload();
        });
    },
    ajaxUpload: function(){
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
                    location.reload();
                }
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type='submit']").prop('disabled', false);
            }
        });
    },
    failedValidation: function(data){
        self = this;
        var arr = data.errors;
        $.each(arr, function(index, value)
        {
            self.form.find('input[name="' + index + '"]').parent().addClass('has-error');
            self.form.find('input[name="' + index + '"]').parent().find('.glyphicon').remove();
            self.form.find('input[name="' + index + '"]').parent().find('.help-block:visible').remove();
            self.form.find('input[name="' + index + '"]').after('<small class="help-block" data-bv-validator="notEmpty" data-bv-for="' + index + '" data-bv-result="INVALID">' + value + '</small>');
            self.form.find('input[name="' + index + '"]').after('<i class="form-control-feedback glyphicon glyphicon-remove" data-bv-icon-for="' + index + '"></i>');
        })
    }
}