function publishClass(form){
    this.form = form;
    this.addListeners();
}

publishClass.prototype = {
    constructor: publishClass,
    addListeners: function(){
        this.form.on("submit", $.proxy(this.submitForm, this));
    },
    submitForm: function(e) {
        e.preventDefault();
        this.ajaxPost();
    },
    ajaxPost: function(){
        var self = this;

        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true).after('<span id="publish-loading" class="icon icon-loading ml10"></span>');
            },

            success: function (data) {
                $('body').append(data.view);
                console.log(data.state);
                if(data.state == 1){
                    self.form.find("input[type='submit']").val('Un-publish');
                    self.form.find("input[name='publish']").val(0);
                }
                else
                {
                    self.form.find("input[type='submit']").val('Publish');
                    self.form.find("input[name='publish']").val(1);
                }
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                //console.log('error');
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type='submit']").prop('disabled', false)
                $('#publish-loading').remove();
            }
        });
    }
}