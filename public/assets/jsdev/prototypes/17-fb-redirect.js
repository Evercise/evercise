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
            this.redirect = '/trainers/create';
        }
        else{
            this.redirect = '';
        }
        this.btn.attr('href', this.url + this.redirect);
    }
}