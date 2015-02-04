function categoryAutoComplete(select){
    this.elem = select;
    this.inputBox =  this.elem.parent().find('input');
    this.selected = '';
    this.form
    this.addListenners();
}

categoryAutoComplete.prototype = {
    constructor : categoryAutoComplete,
    addListenners : function(){
        this.elem.find('a').on('click', $.proxy(this.select, this));
    },
    select: function(e){
        e.preventDefault();
        var target = $(e.target);
        this.form = target.closest('form');
        this.selected = target.text();
        this.form.find('input[name="search"]').val( this.selected );
    }
}