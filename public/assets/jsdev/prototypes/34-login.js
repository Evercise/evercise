function Login(form){
    this.form = form;
    this.addListeners();
}

Login.prototype = {
    constructor: Login,
    addListeners : function(){
        this.form.on('submit', $.proxy(this.submit, this));
        this.form.find('input').on('input', $.proxy(this.removeError, this));
    },
    removeError: function(){
        this.form.find('.alert').remove();
    },
    submit: function(e){
        e.preventDefault();
        this.form = $(e.target);
        this.ajax();
    },
    ajax: function(){
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true);
                self.form.find(".has-error").removeClass('has-error');
               $("#login-error-msg").remove();
                self.removeError();
            },

            success: function (data) {
                if( data.validation_failed == 1 ){
                    self.failedValidation(data);
                }
                else{
                    if(REDIRECT){
                        window.location.href = data.url+'/2'+STEP;
                    }
                    else{
                        window.location.href = data.url;
                    }

                }
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type='submit']").prop('disabled', false)
            }
        });
    },
    failedValidation: function(data) {
        self = this;
        var arr = data.errors;
        //self.form.find("input[name = 'password']").after('<div class="mt10 alert alert-danger alert-dismissible" role="alert">' + arr + '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>');
        self.form.find("input[name = 'password']").parent().after('<div id="login-error-msg" class="form-control mb10 input-lg input-group has-error">' + arr + '</div>');
    }
}