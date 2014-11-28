function voucher(elem){
    this.elem = elem;
    this.form = this.elem.find('form');
    this.addListeners();
}
voucher.prototype = {
    constructor: voucher,
    addListeners : function(){
        $('#have-voucher').on('click', $.proxy(this.haveVoucher, this))
        this.form.on('submit', $.proxy(this.submit, this));
    },
    haveVoucher : function(e){
        if($(e.target).hasClass('active')){
            $(e.target).removeClass('active');
            $('#have-voucher-block').addClass('hidden');
        }
        else{
            $(e.target).addClass('active');
            $('#have-voucher-block').removeClass('hidden');
        }
    },
    submit : function(e){
        e.preventDefault();
        this.ajaxSubmit();
    },
    ajaxSubmit: function () {
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {

            },

            success: function (data) {
                if(data.success){

                }
                else{
                    self.elem.after('<div class="mt10 alert alert-danger alert-dismissible fixed" role="alert">your voucher is not correct<button type="button" class="close" data-dismiss="alert"></button></div>');
                }
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find('input[type="submit"]').prop('disabled', false)
            }
        });
    }
}