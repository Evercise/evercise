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
        this.addListener();
    },
    addListener: function(){
        $(document).on('change', 'input[name="image"]', $.proxy(this.reValidate, this))
        $(document).on('change', 'input[name="category_array[]"]', $.proxy(this.reValidate, this));
    },
    validation: function(){
        var self = this;

        $(this.form)
            .on('init.form.bv', function(e, data) {
                data.bv.disableSubmitButtons(true);
            })

            .bootstrapValidator({
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
            .on('success.field.bv', function(e, data) {
                if( !$("input[name='image']").val() && !$("input[name='category_array[]']").val()) {
                    self.form.find("input[type='submit']").prop('disabled', true);
                }
            })

            .on('success.form.bv', function(e) {
                e.preventDefault();
                if( !$("input[name='image']").val() ) {
                    self.form.find("input[type='submit']").parent().parent().before('<div data-dismiss="alert" class="alert alert-danger">You must add a cover image before you can proceed<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button></div>')
                }
                else if( !$("input[name='category_array[]']").val() ){
                    self.form.find("input[type='submit']").parent().parent().before('<div data-dismiss="alert" class="alert alert-danger">You must select at least one category before you can proceed<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button></div>')
                }
                else{
                    self.form.find("input[type='submit']").prop('disabled', false);
                    self.ajaxUpload();
                }
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
                if(data.validation_failed == 1){
                    self.failedValidation(data);
                    console.log(data);
                }
                else{
                    window.location.href = data.url;
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                $('#class-loading').remove();
            }
        });
    },
    reValidate: function(){
        if( $("input[name='image']").val() && $("input[name='category_array[]']").val()) {
            this.form.find("input[type='submit']").prop('disabled', false);
        }
    },
    failedValidation: function(data){
        var self = this;
        var arr = data.errors;
        $.each(arr, function(index, value)
        {
            if( index == 'venue_select'){
                self.form.find('#venue_select').parent().parent().addClass('has-error');
                self.form.find('#venue_select').parent().after('<small class="help-block" data-bv-validator="notEmpty" data-bv-for="' + index + '" data-bv-result="INVALID">' + value + '</small>');
                self.form.find('#venue_select').parent().after('<i class="form-control-feedback glyphicon glyphicon-remove" data-bv-icon-for="' + index + '"></i>');
            }
            else if(self.form.find('input[name="' + index+ '"]').parent().hasClass('input-group')){
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