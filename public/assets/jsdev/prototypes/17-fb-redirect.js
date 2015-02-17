function facebookRedirect(btn){
    this.btn = btn;
    this.url = btn.attr('href');
    this.redirect = '';
    this.addListeners();
}
facebookRedirect.prototype = {
    constructor : facebookRedirect,
    addListeners : function(){
        $('input[name="trainer"]').on('change', $.proxy( this.changeFbUrl, this));
    },
    changeFbUrl : function(e){
        var trainer = $(e.target).val();
        if(trainer == 'yes'){
            this.redirect = '/trainers.create';
            if($('input[name="phone"]').length > 0){
                $("label[for='phone']").find('small').text('(For Evercise to contact you)');
            }
        }
        else{
            this.redirect = '';
            if($('input[name="phone"]').length > 0){
                $("label[for='phone']").find('small').text('(Get alerts about your classes)');
            }
        }
        this.btn.attr('href', this.url + this.redirect);
    }

}