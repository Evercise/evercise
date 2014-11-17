function UpdateSessions(form){
    this.form = form;
    self.data = '';
    this.init();
}

UpdateSessions.prototype = {
    constructor: UpdateSessions,
    init: function(){
        this.addListeners();
    },
    addListeners: function(){
        //this.form.on('submit', $.proxy(this.submitUpdate, this));
        $(document).on('submit', '#update-sessions', $.proxy(this.submitUpdate, this) );
        $(document).on('click', '#more-sessions', $.proxy(this.scrollToCalendar, this) );
    },
    submitUpdate: function(e){
        e.preventDefault();
        this.ajaxUpload();
    },
    ajaxUpload: function () {
        var self = this;
        self.data = self.form.serialize();

        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.data,
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true).append('<span id="sessionupdate-loading" class="icon icon-loading ml10 mt10"></span>');
            },

            success: function (data) {
                window.location.href = data.url;
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log('error');
                //console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type='submit']").prop('disabled', false)
                $('#sessionupdate-loading').remove();
            }
        });
    },
    scrollToCalendar: function(e){
        e.preventDefault();
        console.log(e);
        $("html, body").animate({scrollTop: $(e.target.attr('href')).offset().top -60 }, 1000);
    }
}
