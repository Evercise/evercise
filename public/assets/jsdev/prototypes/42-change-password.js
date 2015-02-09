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
            console.log(e);
                self.ajaxUpload()
;        });
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
                console.log(data)
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {

            }
        });
    }
}