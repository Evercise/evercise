function categorySelect(form){
    this.form = form;
    this.select = this.form.find('.select2');
    this.keywordSelect = this.form.find('input[name="keywords"]');
    this.keywords = [];
    this.gallery = '';
    this.maximumSelectionSize = 3;
    this.minimumResultsForSearch = 1;
    this.placeholder = 'Choose upto 3 categories';
    this.dropdownCssClass = 'select2-hidden';
    this.init();
}
categorySelect.prototype = {
    constructor: categorySelect,
    init: function(){
        this.select.select2({
            maximumSelectionSize: this.maximumSelectionSize,
            minimumResultsForSearch: this.minimumResultsForSearch,
            placeholder: this.placeholder,
            closeOnSelect: true,
            openOnEnter: false,
            formatNoMatches: function() {
                return '';
            },
            dropdownCssClass: this.dropdownCssClass
        });
        this.addListener();
    },
    addListener: function () {
        this.form.on("submit", $.proxy(this.submitForm, this));
        this.select.on("select2-selecting", $.proxy(this.addToKeywords, this))
        this.select.on("select2-removing", $.proxy(this.removeFromKeywords, this))
    },
    submitForm: function(e){
        e.preventDefault();
        this.ajaxUpload();
    },
    ajaxUpload: function () {
        var self = this;

        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.select.prop('disabled', true);
                $('#gallery-row').after('<div id="gallery-loading"  class="alert alert-success text-center"><span class="icon icon-loading ml10"></span> Loading gallery based on your selected categories...</div>');
            },

            success: function (data) {
                self.gallery = data.view;
                $('#gallery-row').html(self.gallery).trigger('change');
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.select.prop('disabled', false);
                $('#gallery-loading').remove();
            }
        });
    },
    addToKeywords: function(e){
        this.keywords.push(e.choice.text);
        this.keywordSelect.val(this.keywords);
        this.form.submit();
    },
    removeFromKeywords: function(e){
        this.keywords = $.grep(this.keywords, function(value) {
            return value != e.choice.text;
        });
    }
}