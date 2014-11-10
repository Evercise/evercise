function createVenue(form){
    this.form = form;
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

        $('#create_venue').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: this.validIcon,
                invalid: this.invalidIcon,
                validating: this.validatingIcon
            },

            fields: {
                venue_name: this.venueName,
                venue_street: this.venueStreet,
                venue_post_code: this.venuePC
            }
        })
        .on('success.form.bv', function(e) {
            e.preventDefault();
            self.ajaxUpload();
        });
    },
    ajaxUpload: function () {
        var url = this.form.attr("action"),
            data = new FormData(this.form[0]),
            self = this;
        $.ajax(url, {
            type: "post",
            data: data,
            processData: false,
            contentType: false,

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true).after('<span id="cropping-loading" class="icon icon-loading ml10"></span>');
            },

            success: function (data) {
                self.form.find("input[type=submit]").prop('disabled', false);
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                console.log('complete');
            }
        });
    }
}