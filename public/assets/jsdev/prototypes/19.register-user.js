function registerUser(form){
    this.form = form;
    this.validIcon = 'glyphicon glyphicon-ok';
    this.invalidIcon = 'glyphicon glyphicon-remove';
    this.validatingIcon = 'glyphicon glyphicon-refresh';
    this.displayName = {
        message: 'Your username is not valid',
        validators: {
            notEmpty: {
                message: 'Your display name is required'
            },
            stringLength: {
                min: 5,
                max: 20,
                message: 'Your display name must be more than 5 and less than 20 characters long'
            },
            regexp: {
                regexp: /^[a-zA-Z0-9_]+$/,
                message: 'Your display name can only consist of alphabetical, number and underscore'
            }
        }
    };
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
            notEmpty: {
                message: 'Your first name is required and cannot be empty'
            },
            stringLength: {
                min: 2,
                max: 15,
                message: 'Your first name must be more than 2 and less than 15 characters long'
            }
        }
    };
    this.last_name = {
        validators: {
            notEmpty: {
                message: 'Your surname is required and cannot be empty'
            },
            stringLength: {
                min: 2,
                max: 15,
                message: 'Your surname must be more than 2 and less than 15 characters long'
            }
        }
    };
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
                field: 'confirmed_password',
                message: 'Your passwords do not match'
            }
        }
    };
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
                field: 'password',
                message: 'Your passwords do not match'
            }
        }
    };

    this.init();
}

registerUser.prototype = {
    constructor: registerUser,
    init: function(){
        this.form.find("input[type='submit']").prop('disabled', true);
        this.validation();
        this.addListeners();
    },
    addListeners : function(){
        this.form.find('input[name="terms"]').on('change', $.proxy(this.reVal, this));
    },
    reVal: function(e){
        if($(e.target).is(':checked') && this.form.data('bootstrapValidator').isValid()){
            this.form.find("input[type='submit']").prop('disabled', false);
        }
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
                display_name: this.displayName,
                email: this.email,
                first_name: this.first_name,
                last_name: this.last_name,
                password: this.password,
                confirmed_password: this.confirmed_password
            }
        })
        .on('success.form.bv', function(e) {
            e.preventDefault();
                if(self.form.find('input[name="terms"]').is(':checked') || self.form.find('input[name="terms"]').length == 0)
                {
                   self.ajaxUpload();
                }
                else{
                    self.form.find('input[name="terms"]').parent().append('<span class="center-block text-danger help-box">You must accept our terms and conditions before continuing</span>')
                };

        });
    },
    ajaxUpload: function(){
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true).after('<br><span id="register-loading" class="icon icon-loading ml10"></span>');
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
            if(self.form.find('input[name="' + index+ '"]').parent().hasClass('input-group')){
                self.form.find('input[name="' + index + '"]').parent().parent().addClass('has-error');
                self.form.find('input[name="' + index + '"]').parent().after('<small class="help-block" data-bv-validator="notEmpty" data-bv-for="' + index + '" data-bv-result="INVALID">' + value + '</small>');
                self.form.find('input[name="' + index + '"]').parent().after('<i class="form-control-feedback glyphicon glyphicon-remove" data-bv-icon-for="' + index + '"></i>');
            }
            else {
                self.form.find('input[name="' + index + '"]').parent().addClass('has-error');
                self.form.find('input[name="' + index + '"]').parent().find('.glyphicon').remove();
                self.form.find('input[name="' + index + '"]').parent().find('.help-block:visible').remove();
                self.form.find('input[name="' + index + '"]').after('<small class="help-block" data-bv-validator="notEmpty" data-bv-for="' + index + '" data-bv-result="INVALID">' + value + '</small>');
                self.form.find('input[name="' + index + '"]').after('<i class="form-control-feedback glyphicon glyphicon-remove" data-bv-icon-for="' + index + '"></i>');
            }
        })
    }
}