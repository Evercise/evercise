function createVenue(container){
    this.container = container;
    this.form = container.find('#create_venue');
    this.next = this.form.find('.next');
    this.validIcon = 'glyphicon glyphicon-ok';
    this.invalidIcon = 'glyphicon glyphicon-remove';
    this.validatingIcon = 'glyphicon glyphicon-refresh';
    this.venueName = {
        message: 'Your Venue is not valid',
        validators: {
            notEmpty: {
                message: 'Your Venue requires a name'
            },
            stringLength: {
                min: 2,
                max: 50,
                message: 'Your Venue name must be more than 2 and less than 50 characters long'
            }
        }
    };
    this.venueStreet = {
        message: 'Your street is not valid',
        validators: {
            notEmpty: {
                message: 'Your Venue requires a street'
            },
            stringLength: {
                min: 2,
                max: 50,
                message: 'Your street name must be more than 2 and less than 50 characters long'
            }
        }
    };
    this.town = {
        message: 'Your town is not valid',
        validators: {
            notEmpty: {
                message: 'Your Venue requires a town'
            },
            stringLength: {
                min: 2,
                max: 50,
                message: 'Your town name must be more than 2 and less than 50 characters long'
            }
        }
    };
    this.venuePC = {
        message: 'Your post code is not valid',
        validators: {
            notEmpty: {
                message: 'Your Venue requires a post code'
            },
            stringLength: {
                min: 6,
                max: 8,
                message: 'Your post code must be more than 6 and less than 8 characters long'
            }
        }
    };
    this.init();
}
createVenue.prototype = {
    constuctor: createVenue,
    init: function(){
        this.addListener();
        this.validation();
        this.form.find("input[type='submit']").prop('disabled', true);
    },
    addListener: function(){
        this.next.on("click", $.proxy(this.switchTab, this));
    },
    switchTab: function(e){
        e.preventDefault();

        var target = $(e.target).data('target');
        $('#'+target+'-pill').click();
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
                name: this.venueName,
                address: this.venueStreet,
                town: this.town,
                postcode: this.venuePC
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
                self.form.find("input[type='submit']").prop('disabled', true).after('<span id="venue-loading" class="icon icon-loading ml10"></span>');
            },

            success: function (data) {
                if( data.validation_failed == 1 ){
                    self.failedValidation(data);
                }
                else{
                    self.container.modal('hide');
                    self.form.find("input[type=submit]").prop('disabled', false);
                    $('#venue_select').append( $('<option />', {text : data.venue_name, value: data.venue_id, selected: true} ) );
                }

            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                $('#venue-loading').remove();
            }
        });
    },
    failedValidation: function(data){
        console.log(data);
        self = this;
        var arr = data.errors;
        $('#venue-pill').trigger('click');

        $.each(arr, function(index, value)
        {
            console.log(index);
            self.form.find('input[name="' + index+ '"]').parent().addClass('has-error');
            self.form.find('input[name="' + index+ '"]').parent().find('.glyphicon').remove();
            self.form.find('input[name="' + index + '"]').parent().find('.help-block:visible').remove();
            self.form.find('input[name="' + index+ '"]').after('<small class="help-block" data-bv-validator="notEmpty" data-bv-for="'+index+'" data-bv-result="INVALID">'+value+'</small>');
            self.form.find('input[name="' + index+ '"]').after('<i class="form-control-feedback bv-no-label glyphicon glyphicon-remove" data-bv-icon-for="'+index+'"></i>');
        })
    }
}