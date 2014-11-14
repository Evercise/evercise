function AddSessions(form){
    this.form = form;
    this.calendar = this.form.find('#calendar');
    this.daysOfWeek = '';
    this.dates = [];
    this.submitDates = [];
    this.index = '';
    this.recurring = 6;
    this.recurringFor = this.form.find('#recurring-days').val();
    this.rows = [];
    this.currentDates = [];
    this.init();
}
AddSessions.prototype = {
    constructor: AddSessions,
    init: function () {

        this.calendar.datepicker({
            format: "yyyy-mm-dd",
            startDate: "+1d",
            todayHighlight: true,
            multidate: true
        });
        this.daysOfWeek = this.calendar.find('.dow');

        this.addListener();
    },
    addListener: function () {
        this.daysOfWeek.on("click", $.proxy(this.dayOfWeek, this) );
        $('input[name="recurring"]').on('change', $.proxy(this.recurringCheck, this));
        this.form.on("submit", $.proxy(this.submitForm, this));
        this.form.find('#recurring-days').on("change", $.proxy(this.changeRecurringFor, this));
    },
    dayOfWeek: function(e){
        this.index = ($(e.target).index());
        this.rows = [];
        this.setdayOfWeeks();

    },
    setdayOfWeeks: function(){
        this.currentDates = this.calendar.datepicker('getDates');
        var d = new Date(),
            month = d.getMonth(),
            self = this;

        d.setDate(1);

        // Get the first nth in the month
        while (d.getDay() !== this.index) {
            d.setDate(d.getDate() + 1);
        }

        // Get all the other nth in the month
         while (d.getMonth()  === month) {
             self.dates.push( new Date( d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() ) );
             d.setDate(d.getDate() + 7);
         }
        this.setCalendarDates();
    },
    recurringDates: function(){
        this.currentDates = this.calendar.datepicker('getDates');

        var self = this;
        $.each(this.currentDates , function(i, val){
            self.dates.push(val);
            var weekOfMonth = Math.ceil(val.getDate() / 7 );
            var dayOfWeek = val.getDay();
            var monthOfYear = val.getMonth() + 1;
            self.setRecurringDays(dayOfWeek, monthOfYear, weekOfMonth);
        })
    },
    submitForm: function(e){
        e.preventDefault();
        var self =this;

        $.each(this.calendar.datepicker('getDates') , function(i,v){
            var day = v.getDate();
            var month = (v.getMonth() + 1);
            var year = v.getFullYear();
            self.submitDates.push(year + '-'+ month + '-' + day);
        })
        $('input[name="session_array[]"]').val( this.submitDates );
        //this.ajaxUpload();
    },
    ajaxUpload: function () {
        var self = this;

        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true).parent().after('<span id="cropping-loading" class="icon icon-loading ml10 mt10"></span>');
            },

            success: function (data) {
                console.log(data);
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                console.log('comaplete');
            }
        });
    },
    setRecurringDays: function(day, month, week) {
        var self = this;
        for( var i = 0; i < self.recurringFor; i++){
            var d = new Date();

            d.setMonth(month + i);
            d.setDate(1);

            // Get the first nth in the month
            while (d.getDay() !== day) {
                d.setDate(d.getDate() + 1);
            }
            // Get the nth week in the month

            while ( Math.ceil(d.getDate() / 7 ) !== week) {

                d.setDate(d.getDate() + 7);
            }

            self.dates.push( new Date( d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() ) );

        }
        this.setCalendarDates();
    },
    recurringCheck: function(e){
        if($(e.target).val() == 'yes'){
            this.recurringDates();
        }
        else{
            this.resetCalendarDates();
        }
    },
    setCalendarDates: function(){
        this.calendar.datepicker('setDates', this.dates  );
    },
    resetCalendarDates: function(){
        this.calendar.datepicker('setDates', this.currentDates  );
    },
    changeRecurringFor : function(e){
        this.recurringFor = $(e.target).val();
    }
}