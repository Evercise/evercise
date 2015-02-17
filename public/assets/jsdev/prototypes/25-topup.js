function topUp(form){
    this.form = form;
    this.amount = 0;
    this.payAmount = 0
    this.stripe = {};
    this.init();
}
topUp.prototype = {
    constructor: topUp,
    init: function(){
        $('#stripe-button').prop('disabled', true);
        $('#fb-pay').addClass('disabled');
        this.addListeners();
    },
    addListeners : function(){
        this.form.find('.add-btn').on('click', $.proxy(this.topUpAmount, this))
        this.form.find('input[name="custom"]').on('keyup change', $.proxy(this.topUpAmount, this))
        this.form.find('#cancel-btn').on('click', $.proxy(this.cancelTopUp, this))
        this.form.find('input[name="amount"]').on('change', $.proxy(this.amountChanged, this))
        this.form.find('#stripe-button').on('click', $.proxy(this.openStripe, this))
        $(window).on('popstate', $.proxy(this.closeStripe, this));
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
        $('#stripe-button').prop('disabled', true)

        $('#fb-pay').addClass('disabled');
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
    openStripe: function(e){
        var self = this;
        // Open Checkout with further options
        handler.open({
            name: 'Evercise',
            description: 'Top up',
            amount: self.payAmount
        });
        e.preventDefault();
    },
    closeStripe: function(e){
        handler.close();
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
                $('#stripe-button').prop('disabled', false);
                $('#fb-pay').removeClass('disabled');
                self.payAmount = data.amount;
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