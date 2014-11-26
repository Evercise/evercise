function RateIt(block){
    this.block = block;
    this.currentBlock = '';
    this.form = '';
    this.hoverNth = null;
    this.selectedNth = null;
    this.stars = 0;
    this.emptyClass = 'icon-empty-star';
    this.selectedClass = 'icon-full-star';
    // validation
    this.validIcon = 'glyphicon glyphicon-ok';
    this.invalidIcon = 'glyphicon glyphicon-remove';
    this.validatingIcon = 'glyphicon glyphicon-refresh';
    this.feedback_text = {
        message: 'Your must rate this class out of 5',
        validators: {
            notEmpty: {
                message: 'We need to know your thoughts on this class before you rate it'
            }
        }
    };
    this.init();

}
RateIt.prototype = {
    constructor: RateIt,
    init: function(){
        this.block.find("input[type='submit']").prop('disabled', true);
        this.addListeners();
        this.validation();
    },
    addListeners: function(){
        this.block.find('span.icon').not('.selected').hover($.proxy(this.hoverState, this));
        this.block.find('span.icon').on('click', $.proxy(this.selectRating, this));
        this.block.find('textarea').on('focus', $.proxy(this.focusTextArea, this));
    },
    hoverState: function(e){
        this.currentBlock = $(e.target).closest('.rate-it');
        if(e.type == 'mouseenter'){
            this.hoverNth = $(e.target).index();
        }
        else{
            this.hoverNth = null;
        }
        this.changeClassOnHover();
    },
    changeClassOnHover: function(){
        if(this.hoverNth != null){
            for( var i =0 ; i <= this.hoverNth ; i++){
                this.currentBlock.find('span.icon').eq(i).removeClass(this.emptyClass).addClass(this.selectedClass);
            }
        }
        else{
            this.currentBlock.find('span.icon').not('.selected').removeClass(this.selectedClass).addClass(this.emptyClass);
        }

    },
    selectRating: function(e){
        this.currentBlock = $(e.target).closest('.rate-it');
        this.currentBlock.find('.alert').remove();
        var self = this;
        setTimeout(function() {
                self.currentBlock.find('textarea[name="feedback_text"]').focus();
        }, 1);
        this.selectedNth = $(e.target).index();
        this.stars = ( this.selectedNth + 1 );
        this.currentBlock.find('span.icon').removeClass(this.selectedClass).removeClass('selected').addClass(this.emptyClass);
        for( var i =0 ; i <= this.selectedNth ; i++){
            this.currentBlock.find('span.icon').eq(i).removeClass(this.emptyClass).addClass(this.selectedClass).addClass('selected');
        }
        this.currentBlock.find('input[name="stars"]').val(this.stars);
    },
    focusTextArea: function(e){
        this.currentBlock = $(e.target).closest('.rate-it');
        this.currentBlock.find('.alert').remove();
        if($(e.target).val()){
            this.currentBlock.find("input[type='submit']").prop('disabled', false);
        }
    },
    validation: function(){
        var self = this;
        this.block.find('form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: this.validIcon,
                invalid: this.invalidIcon,
                validating: this.validatingIcon
            },

            fields: {
                feedback_text: this.feedback_text
            }
        })
        .on('success.form.bv', function(e) {
            e.preventDefault();
            self.form = $(e.target);
            self.currentBlock = self.form.closest('.rate-it');
            self.currentBlock.find('.alert').remove();
            self.ratingCheck();
        });
    },
    ratingCheck: function(){
        if( !this.form.find('input[name="stars"]').val() ){
            this.currentBlock.find('span.icon').css({
                transform: 'rotate(360deg)',
                WebkitTransition : 'transform 1s ease-in-out',
                MozTransition    : 'transform 1s ease-in-out',
                MsTransition     : 'transform 1s ease-in-out',
                OTransition      : 'transform 1s ease-in-out',
                transition       : 'transform 1s ease-in-out'
            });
            this.form.append('<div class="alert alert-danger alert-dismissible fade in absolute alert-sm" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>You must add your star rating</div>');
        }
        else{
            this.ajaxUpload();
        }
    },
    ajaxUpload: function(){
        var  self = this;
        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true).after('<span id="rating-loading" class="icon icon-loading ml10"></span>');
            },

            success: function (data) {
                console.log(data);
                $('#panel-'+data.notification).find('#user-rating').addClass('hidden');
                $('#panel-'+data.notification).find('#user-rating').removeClass('hidden');
                // re masonry
                new Masonry($('.masonry'));
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type=submit]").prop('disabled', false);
                $('#rating-loading').remove();
            }
        });
    }
}