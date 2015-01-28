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
                self.form.find('input[type="submit"]').prop('disabled', true);
                $('.has-error').removeClass('has-error');
                $('.help-block').remove();
            },

            success: function (data) {
                if(data.success){
                    location.reload();
                }
                else{
                    self.form.find('input[name="coupon"]').parent().addClass('has-error').append('<span class="help-block mb5">your voucher is not correct</span>');
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