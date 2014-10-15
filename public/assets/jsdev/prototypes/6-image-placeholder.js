var Placeholder = function () {
    this.colour = '#ebedee';
    this.size = 0;
    this.themes();

}

Placeholder.prototype = {
    constructor: Placeholder,
    themes: function(){
        self = this;
        Holder.addTheme("upload", {
            background: self.colour, foreground: self.colour, size: self.size
        });
    }

}