function AddSessionsToCalendar(form){
    this.form = form;
    this.calendar = this.form.find('#calendar');
    this.index = '';
    this.dates = [];
    this.selectedDates = [];
    this.submitDates = [];
    this.currentMonthYear = [];
    this.init();
}
AddSessionsToCalendar.prototype = {
    constructor: AddSessionsToCalendar,
    init: function(){
        this.calendar.datepicker({
            format: "yyyy-mm-dd",
            startDate: "+1d",
            todayHighlight: true,
            multidate: true
        })
        .on('changeDate', $.proxy(this.getCurrentDates, this) );
        this.addListener();
    },
    addListener: function () {
        $(document).on('click', '.dow',  $.proxy(this.dayOfWeek, this) );
        this.form.on("submit", $.proxy(this.submitForm, this));
    },
    getCurrentDates: function(e){

        var self = this;

        this.selectedDates = e.dates;

        this.dates = [];

        // keep original dates intact

        $.each(this.selectedDates , function(i,v){
            self.dates.push({
                'key': v.valueOf(),
                'dates': v
            })
        })
    },
    dayOfWeek : function(e){

        this.currentMonthYear = $('.datepicker-switch').first().text().split(" ");


        var d = new Date(),
            month = this.getMonthNumber(this.currentMonthYear[0], this.currentMonthYear[1]),
            year = this.currentMonthYear[1],
            self = this;

        this.index = ($(e.target).index());

        d.setDate(1);
        d.setMonth(month);
        d.setFullYear(year);

        // Get the first nth in the month
        while (d.getDay() !== this.index) {
            d.setDate(d.getDate() + 1);
        }

        // Get all the other nth in the month
        while (d.getMonth()  === month) {

            var rd = d.getFullYear() + '-' + ('0' + (d.getMonth() +1)).slice(-2) + '-' +  ('0' + d.getDate()).slice(-2) + ' 00:00:00 AM'  ;

            rd = rd.replace(/-/g,"/");
            var recurringDate = new Date(rd);
            var resultFound = $.grep(self.dates, function(e){
                return e.key == recurringDate.valueOf();
            });

            var resultFoundPlusHour = $.grep(self.dates, function(e){
                return e.key == (recurringDate.valueOf() - 3600000);
            });

            if (resultFound.length == 0 && resultFoundPlusHour.length == 0 ) {
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
    getMonthNumber : function(mon , year){
        var d = Date.parse(mon + "1, "+ year);
        if(!isNaN(d)){
            return new Date(d).getMonth();
        }
        return -1;
    },
    submitForm: function(e){
        e.preventDefault();
        $('#duplicate').remove()
        var self =this;
        var checkDates =  JSON.parse(self.form.find('input[name="checkDates"]').val());
        var dontSubmit;
        $.each(this.calendar.datepicker('getDates') , function(i,v){
            var day = v.getDate();
            var month = (v.getMonth() + 1);
            var year = v.getFullYear();

            self.submitDates.push(year + '-'+ month + '-' + day);
            if( self.checkDates(checkDates, year + '-'+ month + '-' + day + ' ' + $('select[name="time"]').val()) ){
                dontSubmit = true;
                return false;
            }

        })
        if(dontSubmit){
            self.form.find('input[type="submit"]').parent().before('<div class="alert alert-danger text-center"  id="duplicate">Duplicate Time and date found, please check</div>')
        }
        else{
            $('input[name="session_array"]').val( this.submitDates );
            this.ajaxUpload();
        }

    },
    checkDates: function(checkDates, selectedDate){
        var duplicates;
        $.each(checkDates, function(i, val){
            var ch = new Date(val.date);
            var sd = new Date(selectedDate);
            if(ch.valueOf() == sd.valueOf()){
                duplicate = true;
                return false;
            }
        })

        return duplicate;
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
                self.selectedDates = [];
                self.setCalendarDates();
                $("html, body").animate({scrollTop: $('#update-container').offset().top -20 }, 1000);
                if(RemoveSession.length == 0){
                    new RemoveSession($('.remove-session'));
                }
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
    }
}