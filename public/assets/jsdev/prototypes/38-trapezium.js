function trapezium(wrapper){
    this.wrapper = wrapper;
    this.btns = []
    this.width = wrapper.outerWidth();
    this.margin =  parseInt(this.wrapper.find('.btn').css('margin-right'));
    this.init();
}

trapezium.prototype = {
    constructor : trapezium,
    init : function(){
        if($(window).width() > 990){
            var self = this;
            var width = this.width;
            var btnWidth = 0;
            var row = 1;
            var col = 10;
            var offset = 1;
            var remaining = 0;
            var n = 0;
            this.wrapper.find('.trapezium-item').each(function(i, obj){
                btnWidth = btnWidth + $(obj).outerWidth(true);
                console.log(btnWidth);
                console.log(width);
                if( btnWidth >= (width -20)){

                    remaining = btnWidth - width;
                    var newMargin = (self.margin + (remaining / n)) +'px';

                    btnWidth = 0;
                    row = ++row;
                    self.wrapper.append('<div class="col-sm-'+col+' col-sm-offset-'+offset+' mb30" id="row-'+row+'"></div>');
                    width = self.wrapper.find('#row-'+row).outerWidth();
                    if(btnWidth < width){
                        btnWidth = btnWidth + $(obj).outerWidth(true);
                        self.wrapper.find('#row-'+row).append(obj);
                        col = col - 2;
                        offset = ++offset;
                    }

                }
                else{
                    ++n;
                    self.wrapper.find('#row-'+row).append(obj);
                }

            })
        }
    }
}