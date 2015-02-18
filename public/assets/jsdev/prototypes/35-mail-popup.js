function MailPopup(link){
    this.link = link;
    this.target = '';
    this.form = '';
    this.id = '';
    this.validIcon = 'glyphicon glyphicon-ok';
    this.invalidIcon = 'glyphicon glyphicon-remove';
    this.validatingIcon = 'glyphicon glyphicon-refresh';
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
        $(document).on('click', '.mail-popup',  $.proxy(this.grabPopup, this));
    },
    grabPopup: function(e){
        e.preventDefault();
        this.link = $(e.target);
        this.id = this.link.data('id');
        this.target = $(e.target).attr('href');
        this.link.addClass('icon-loading');
        this.ajaxGet();
    },
    ajaxGet: function(){
        var self = this;
        $.get( this.target, function(data) {
            self.link.after(data.view);
            $('#mail-trainer-'+self.id).modal('show');
            var mt = self.link.css('margin-top').replace("px", "");
            var mb = self.link.css('margin-bottom').replace("px", "");
            var ml = self.link.css('margin-left').replace("px", "");
            var mr = self.link.css('margin-right').replace("px", "");
            self.link.replaceWith('<a  href="#mail-trainer-'+ self.id+'" class="icon icon-mail mt'+mt+' mb'+mb+' mr'+mr+' ml'+ml+' hover" data-toggle="modal" data-target="#mail-trainer-'+ self.id+'"></a>');
            self.form = $('#mail-trainer-'+self.id).find('form');
            self.validation();
        })
        .fail(function() {
            alert( "error" );
        })
        .always(function() {
            self.link.removeClass('icon-loading');
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
                self.form.find("input[type='submit']").after('<strong id="successfull-mail" class="text-primary">Message sent successfully!</strong><br>');
                setTimeout(function(){
                    $('.modal').modal('hide');
                },1500);


            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                setTimeout(function(){
                    self.form.find("input[type=submit]").prop('disabled', false);
                    $('#sending-loading').remove();
                    $('#successfull-mail').remove();
                },1500);
            }
        });
    }
}