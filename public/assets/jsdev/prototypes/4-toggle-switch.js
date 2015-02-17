var ToggleSwitch = function (toggle) {
    this.toggle = toggle;
    this.originalClass = toggle.data('removeclass');
    this.switchClass = toggle.data('switchclass');
    this.originalText = toggle.text();
    this.switchText = toggle.data('switchtext');
    this.init();
}
ToggleSwitch.prototype = {
    constructor: ToggleSwitch,
    init: function(){
        this.toggle.text(this.switchText);
        this.toggle.addClass(this.switchClass);
        this.toggle.removeClass(this.originalClass);
        this.toggle.data('switchtext', this.originalText);
        this.toggle.data('removeclass', this.switchClass);
        this.toggle.data('switchclass', this.originalClass);
    }
}