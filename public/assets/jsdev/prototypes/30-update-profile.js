function updateProfile(form){
    this.form = form;
    this.validIcon = 'glyphicon glyphicon-ok';
    this.invalidIcon = 'glyphicon glyphicon-remove';
    this.validatingIcon = 'glyphicon glyphicon-refresh';
    this.email = {
        validators: {
            notEmpty: {
                message: 'Your email is required and cannot be empty'
            },
            emailAddress: {
                message: 'Your email is not a valid email address'
            }
        }
    };
    this.first_name = {
        validators: {
            stringLength: {
                min: 2,
                max: 15,
                message: 'Your first name must be more than 2 and less than 15 characters long'
            }
        }
    };
    this.last_name = {
        validators: {
            stringLength: {
                min: 2,
                max: 15,
                message: 'Your surname must be more than 2 and less than 15 characters long'
            }
        }
    };
    this.password = {
        validators: {
            stringLength: {
                min: 6,
                max: 32,
                message: 'Your Password must be more than 6 and less than 32 characters long'
            },
            identical: {
                field: 'confirmed_password',
                message: 'Your passwords do not match'
            }
        }
    };
    this.confirmed_password = {
        validators: {
            stringLength: {
                min: 6,
                max: 32,
                message: 'Your Password must be more than 6 and less than 32 characters long'
            },
            identical: {
                field: 'password',
                message: 'Your passwords do not match'
            }
        }
    };
    this.init();
}
updateProfile.prototype = {
    constructor : updateProfile,
    init: function(){
        this.form.find("input[type='submit']").prop('disabled', true);
        this.validation();
    },
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
                email: this.email,
                first_name: this.first_name,
                last_name: this.last_name,
                password: this.password,
                confirmed_password: this.confirmed_password
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
                self.form.find("input[type='submit']").prop('disabled', true).after('<span id="register-loading" class="icon icon-loading ml10"></span>');
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
                $('#register-loading').remove();
            }
        });
    },
    failedValidation: function(data){
        self = this;
        var arr = data.errors;

        $.each(arr, function(index, value)
        {
            self.form.find('input[name="' + index+ '"]').parent().addClass('has-error');
            self.form.find('input[name="' + index+ '"]').parent().find('.glyphicon-ok').remove();
            self.form.find('input[name="' + index+ '"]').after('<small class="help-block" data-bv-validator="notEmpty" data-bv-for="'+index+'" data-bv-result="INVALID">'+value+'</small>');
            self.form.find('input[name="' + index+ '"]').after('<i class="form-control-feedback glyphicon glyphicon-remove" data-bv-icon-for="'+index+'"></i>');
        })
    }
}