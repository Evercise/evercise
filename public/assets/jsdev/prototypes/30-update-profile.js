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
            regexp: {
                regexp: /^[a-zA-Z]+$/,
                message: 'Your first name can only contain letters'
            },
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
            regexp: {
                regexp: /^[a-zA-Z]+$/,
                message: 'Your surname name can only contain letters'
            },
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
    this.profession = {
        message: 'Your profession is not valid',
        validators: {
            notEmpty: {
                message: 'You must add a profession'
            },
            stringLength: {
                min: 2,
                max: 50,
                message: 'Your profession must be more than 2 and less than 50 characters long'
            }
        }
    };
    this.bio = {
        message: 'Your bio is not valid',
        validators: {
            notEmpty: {
                message: 'You must add a bio'
            },
            stringLength: {
                min: 50,
                max: 500,
                message: 'Your bio must be more than 50 and less than 500 characters long'
            }
        }
    };
    this.phone = {
        validators: {
            phone: {
                country: 'areacode',
                message: 'The value is not valid %s phone number'
            }
        }
    }
    this.init();
}
updateProfile.prototype = {
    constructor : updateProfile,
    init: function(){
        this.validation();
        this.form.find("input[type='submit']").prop('disabled', false);
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
                profession: this.profession,
                bio: this.bio,
                phone : this.phone
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
            self.form.find('input[name="' + index+ '"],input[textarea="' + index+ '"] ').parent().addClass('has-error');
            self.form.find('input[name="' + index+ '"],input[textarea="' + index+ '"] ').parent().find('.glyphicon').remove();
            self.form.find('input[name="' + index+ '"],input[textarea="' + index+ '"] ').parent().find('.help-block:visible').remove();
            self.form.find('input[name="' + index+ '"],input[textarea="' + index+ '"] ').after('<small class="help-block" data-bv-validator="notEmpty" data-bv-for="'+index+'" data-bv-result="INVALID">'+value+'</small>');
            self.form.find('input[name="' + index+ '"],input[textarea="' + index+ '"] ').after('<i class="form-control-feedback glyphicon glyphicon-remove" data-bv-icon-for="'+index+'"></i>');
        })
    }
}