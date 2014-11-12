function createClass(form){
    this.form = form;
    this.validIcon = 'glyphicon glyphicon-ok';
    this.invalidIcon = 'glyphicon glyphicon-remove';
    this.validatingIcon = 'glyphicon glyphicon-refresh';
    this.className = {
        validators: {
            notEmpty: {
                message: 'Your class name is required'
            },
            stringLength: {
                min: 3,
                max: 50,
                message: 'Your class name must be more than 3 and less than 50 characters long'
            }
        }
    };
    this.classDescription = {
        validators: {
            notEmpty: {
                message: 'Your class needs a description'
            },
            stringLength: {
                min: 50,
                max: 500,
                message: 'Your class description must be more than 50 and less than 500 characters long'
            }
        }
    };
    this.init();
}
createClass.prototype = {
    constructor: createClass,
    init: function(){
        this.validation();
        this.form.find("input[type='submit']").prop('disabled', true);
    },
    validation: function(){
        var self = this;

        $(this.form).bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: this.validIcon,
                invalid: this.invalidIcon,
                validating: this.validatingIcon
            },

            fields: {
                class_name: this.className,
                class_description: this.classDescription
            }
        })
            .on('success.form.bv', function(e) {
                e.preventDefault();
                self.ajaxUpload();
            });
    },
    ajaxUpload: function () {
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true).after('<span id="class-loading" class="icon icon-loading ml10"></span>');
            },

            success: function (data) {
                console.log(data);
                self.form.find("input[type=submit]").prop('disabled', false);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                $('#class-loading').remove();
                console.log('complete');
            }
        });
    }
}