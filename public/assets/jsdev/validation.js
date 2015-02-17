var Validation = function(form){
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
Validation.prototype = {
    constructor: Validation,
    init: function(){
        this.form.find("input[type='submit']").prop('disabled', true);
        this.validation();
    },
    validation: function(){
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
            new AjaxRequest($(e.target), redirectTo);
        });
    }
}