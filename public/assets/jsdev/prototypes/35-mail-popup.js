function MailPopup(link){
    this.link = link;
    this.target = '';
    this.form = '';
    this.validIcon = 'glyphicon glyphicon-ok';
    this.invalidIcon = 'glyphicon glyphicon-remove';
    this.validatingIcon = 'glyphicon glyphicon-refresh';
    this.subject = {
        validators: {
            notEmpty: {
                message: 'Your message requires a subject'
            }
        }
    };
    this.body = {
        validators: {
            notEmpty: {
                message: 'Your message requires content'
            }
        }
    };
    this.addListener();
}

MailPopup.prototype = {
    constructor: MailPopup,
    addListener : function(){
        this.link.on('click', $.proxy(this.getPopup, this));
    },
    getPopup: function(e){
        e.preventDefault();
        this.target = $(e.target).attr('href');
        $(e.target).prop('disabled', true).after('<span id="mail-loading" class="icon icon-loading ml10 mt25"></span>');
        this.ajaxGet();

    },
    ajaxGet: function(){
        var self = this;
        $.get( this.target, function(data) {
            self.link.after(data.view);
            $('#mail-trainer').modal('show');
            self.link.replaceWith('<a  href="#mail-trainer" class="icon icon-mail ml10 mt25" data-toggle="modal" data-target="#mail-trainer"></a>')
            self.form = $('#mail_trainer');
            self.validation();
        })
        .fail(function() {
            alert( "error" );
        })
        .always(function() {
            self.link.prop('disabled', false);
            $('#mail-loading').remove();
        });
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
                mail_subject: this.subject,
                mail_body: this.body
            }
        })
        .on('success.form.bv', function(e) {
            e.preventDefault();
            self.ajaxUpload();
        });
    },
    ajaxUpload : function(){
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true).after('<span id="sending-loading" class="icon icon-loading ml10 mt15"></span>');
            },

            success: function (data) {
                $('#mail-trainer').modal('hide');
                $('body').append(data.view);
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type=submit]").prop('disabled', false);
                $('#sending-loading').remove();
            }
        });
    }
}