function createVenue(form){
    this.form = form;
    this.nextButton = this.form.find('.next')
    this.init();
}
createVenue.prototype = {
    constuctor: createVenue,
    init: function(){
        this.addListener
    },
    addListener: function(){
        this.nextButton.on("click", $.proxy(this.next, this));
    },
    next: function(){
        console.log( $(e.target).attr('href') );
    }
}