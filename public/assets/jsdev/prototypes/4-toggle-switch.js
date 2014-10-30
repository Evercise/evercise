var ToggleSwitch = function (toggle) {
    this.button = toggle;
    this.html = '';
    this.toggledHtml = '';
    this.init();
}
ToggleSwitch.prototype = {
    constructor: ToggleSwitch,
    init: function(){
        var self = this;
        this.button.on('click', function(e) {
            e.preventDefault();
            self.changeState();
            $($(this).attr('data-target')).collapse('toggle');
        });
    },
    changeState: function(){
        this.html = this.button.html();
        this.toggledHtml = this.button.data('toggled');
        this.button.html(this.toggledHtml);
        this.button.data('toggled', this.html);
    }
}