function topUp(form){
    this.form = form;
    this.amount = 0;
    this.init();
}
topUp.prototype = {
    constructor: topUp,
    init: function(){
        $('.stripe-button-el').prop('disabled', true).addClass('btn');
        $('#fb-pay').prop('disabled', true);
        this.addListeners();
    },
    addListeners : function(){
        this.form.find('.add-btn').on('click', $.proxy(this.topUpAmount, this))
        this.form.find('input[name="custom"]').on('keyup change', $.proxy(this.topUpAmount, this))
        this.form.find('#cancel-btn').on('click', $.proxy(this.cancelTopUp, this))
        this.form.find('input[name="amount"]').on('change', $.proxy(this.amountChanged, this))
        this.form.on('submit', $.proxy(this.submitForm, this))
    },
    topUpAmount: function(e){
        e.preventDefault();
        this.amount = $(e.target).val() ? $(e.target).val() : $(e.target).data('amount');
        this.form.find('.add-btn').removeClass('btn-primary');
        this.form.find('input[name="custom"]').removeClass('btn-primary');
        $(e.target).addClass('btn-primary');
        this.updateAmountInput()
    },
    cancelTopUp: function(e){
        e.preventDefault();
        this.amount = 0
        this.form.find('.add-btn').removeClass('btn-primary');
        this.form.find('input[name="custom"]').removeClass('btn-primary');
        this.updateAmountInput()
    },
    updateAmountInput: function(){
        this.form.find('input[name="amount"]').val( this.amount).trigger('change');
    },
    amountChanged: function(){
        $('.stripe-button-el').prop('disabled', true)
        $('#fb-pay').prop('disabled', true)
        if( this.amount > 0 ){
            var oldValue = this.amount;
            var self = this;
            // gives the user 1 second for them to click another value
            setTimeout(function() {
                var newValue = self.amount;
                if(oldValue == newValue){
                    self.form.trigger('submit');
                }
            },1000);
        }
    },
    submitForm: function(e){
        e.preventDefault();
        this.ajaxUpload();
    },
    ajaxUpload: function () {
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find('.add-btn').prop('disabled', true);
                self.form.find('input[name="custom"]').prop('disabled', true);
            },

            success: function (data) {
                $('.stripe-button-el').prop('disabled', false);
                $('#fb-pay').prop('disabled', false);
               console.log(data);
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find('.add-btn').prop('disabled', false);
                self.form.find('input[name="custom"]').prop('disabled', false);
            }
        });
    }
}