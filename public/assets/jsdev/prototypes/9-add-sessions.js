// unused at the moment see addSessionsToCalendar
function AddSessions(form){
    this.form = form;
    this.calendar = this.form.find('#calendar');
    this.daysOfWeek = '';
    this.dates = [];
    this.submitDates = [];
    this.index = '';
    this.recur = 'no';
    this.recurring = 6;
    this.recurringFor = this.form.find('#recurring-days').val();
    this.originalDates = [];
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
        })
        .on('changeDate', $.proxy(this.getCurrentDates, this) );
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
    getCurrentDates: function(e){
        var self = this;
        this.currentDates = e.dates;

        this.dates = [];

        // keep original dates intact

        $.each(this.currentDates , function(i,v){
            self.dates.push({
                'key': v.valueOf(),
                'dates': v
            })
        })
    },
    setdayOfWeeks: function(){


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

             var recurringDate = new Date( d.getFullYear() + '-' + ('0' + (d.getMonth()+1)).slice(-2) + '-' +  ('0' + d.getDate()).slice(-2) );

             var resultFound = $.grep(self.dates, function(e){
                 return e.key == recurringDate.valueOf();
             });

             if (resultFound.length == 0) {
                 self.dates.push({
                     'key' : recurringDate.valueOf(),
                     'dates' : recurringDate
                 }  );
             }
             else{

                 self.dates = self.dates.filter(function(el){
                     return el.key !== recurringDate.valueOf();
                 })

             }
             d.setDate(d.getDate() + 7);
         }


        this.setCalendarDates();
    },
    recurringDates: function(){
        //this.currentDates = this.calendar.datepicker('getDates');

        var self = this;
        $.each(this.currentDates , function(i, val){
            self.dates.push({
                'key' : val.valueOf(),
                'dates' : val
            });
            self.originalDates.push( val );
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
        $('input[name="session_array"]').val( this.submitDates );
        this.ajaxUpload();
    },
    ajaxUpload: function () {
        var self = this;

        $.ajax(self.form.attr("action"), {
            type: "post",
            data: self.form.serialize(),
            dataType: 'json',

            beforeSend: function () {
                self.form.find("input[type='submit']").prop('disabled', true).parent().after('<span id="session-loading" class="icon icon-loading ml10 mt10"></span>');
            },

            success: function (data) {
                $('#update-session').html(data.view);
                $('input[name="recurring"][value="no"]').click();
                self.dates = [];
                self.submitDates = [];
                self.originalDates = [];
                self.setCalendarDates();
                $("html, body").animate({scrollTop: $('#update-container').offset().top -20 }, 1000);
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log('error');
                //console.log(XMLHttpRequest + ' - ' + textStatus + ' - ' + errorThrown);
            },

            complete: function () {
                self.form.find("input[type='submit']").prop('disabled', false)
                $('#session-loading').remove();
            }
        });
    },
    setRecurringDays: function(day, month, week) {
        var self = this;
        for( var i = 0; i < self.recurringFor; i++){
            var d = new Date(),
                formatedDate;


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

            var formatedDate = new Date( d.getFullYear() + '-' + ('0' + (d.getMonth()+1)).slice(-2) + '-' +  ('0' + d.getDate()).slice(-2) );

            self.dates.push( {
                'key' : formatedDate.valueOf(),
                'dates' : formatedDate
            } );

        }
        this.setCalendarDates();
    },
    recurringCheck: function(e){
        if($(e.target).val() == 'yes'){
            this.recur = 'yes';
            this.recurringDates();
        }
        else{
            this.recur = 'no';
            this.resetCalendarDates();
        }
    },
    setCalendarDates: function(){
        var dates = [];
        var dateValues ={};

        $.each(this.dates , function (index, value) {
            // check for duplicates
            if ( ! dateValues[ value.key ]){
                dateValues[value.key] = true;
                dates.push(value.dates);
            }

        });

        this.calendar.datepicker('setDates', dates );
    },
    resetCalendarDates: function(){
        console.log(this.originalDates);
        this.calendar.datepicker('setDates', this.originalDates  );
    },
    changeRecurringFor : function(e){
        this.recurringFor = $(e.target).val();
        if(this.recur == 'yes'){
            this.calendar.datepicker('setDates', this.currentDates  );
        }
        $('input[name="recurring"][value="'+this.recur+'"]').trigger('change');

    }
}