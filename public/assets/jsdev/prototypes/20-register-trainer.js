function registerTrainer(form){
    this.form = form;
    this.validIcon = 'glyphicon glyphicon-ok';
    this.invalidIcon = 'glyphicon glyphicon-remove';
    this.validatingIcon = 'glyphicon glyphicon-refresh';
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
    this.init();
}

registerTrainer.prototype ={
    constructor: registerTrainer,
    init: function(){
        this.form.find("input[type='submit']").prop('disabled', true);
        this.addListeners();
        this.validation();
    },
    addListeners: function(){
        $('input[name="image"]').on('change', $.proxy(this.closeAlert, this) );
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
                profession: this.profession,
                bio: this.bio
            }
        })
        .on('success.form.bv', function(e) {
            e.preventDefault();
            self.closeAlert();
            self.checkImage();
        });
    },
    checkImage: function(){
        if( !$('input[name="image"]').val() ){
            $('html, body').animate({ scrollTop: $("#image-select").offset().top }, 200);
            $('.img-uploader').after('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>You must upload i profile image</div>');
            this.form.find("input[type='submit']").prop('disabled', false);
        }
        else{
            this.ajaxUpload();
        }

    },
    closeAlert: function(){
        $('.close').trigger('click');
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
            self.form.find('input[name="' + index+ '"]').parent().find('.glyphicon').remove();
            self.form.find('input[name="' + index + '"]').parent().find('.help-block:visible').remove();
            self.form.find('input[name="' + index+ '"]').after('<small class="help-block" data-bv-validator="notEmpty" data-bv-for="'+index+'" data-bv-result="INVALID">'+value+'</small>');
            self.form.find('input[name="' + index+ '"]').after('<i class="form-control-feedback glyphicon glyphicon-remove" data-bv-icon-for="'+index+'"></i>');
        })
    }
}