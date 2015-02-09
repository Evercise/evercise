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
                new_confirmed_password: this.confirmed_password
            }
        })
        .on('success.form.bv', function(e) {
            e.preventDefault();
            console.log(e);
        });
    }
}