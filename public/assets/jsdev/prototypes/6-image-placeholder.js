var ImagePlaceholder = function () {
    this.colour = '#ebedee';
    this.size = 0;
    this.themes();

}

ImagePlaceholder.prototype = {
    constructor: ImagePlaceholder,
    themes: function(){
        self = this;
        Holder.addTheme("upload", {
            background: self.colour, foreground: self.colour, size: self.size
        });
    }

}