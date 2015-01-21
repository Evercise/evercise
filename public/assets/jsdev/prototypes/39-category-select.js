function categorySelect(select){
    this.elem = select;
    this.inputBox =  this.elem.parent().find('input');
    this.selected = '';
    this.addListenners();
}

categorySelect.prototype = {
    constructor : categorySelect,
    addListenners : function(){
        this.elem.find('a').on('click', $.proxy(this.select, this));
    },
    select: function(e){
        e.preventDefault();
        var target = $(e.target)
        this.selected = target.text();
        this.inputBox.val( this.selected );
    }
}