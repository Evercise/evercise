function listAccordion(accordion){
    this.accordion = accordion;
    this.addListeners();
}
listAccordion.prototype = {
    constructor : listAccordion,
    addListeners  :function(){
        this.accordion.on('shown.bs.collapse', function (e) {
            var link = $(e.target).attr('id');
            $('a[href="#'+link+'"]').parent().addClass('active');
        })
        this.accordion.on('hidden.bs.collapse', function (e) {
            var link = $(e.target).attr('id');
            $('a[href="#'+link+'"]').parent().removeClass('active');
        })
    }
}