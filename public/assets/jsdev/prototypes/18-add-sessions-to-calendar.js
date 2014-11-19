function AddSessionsToCalendar(form){
    this.form = form;
    this.calendar = this.form.find('#calendar');
    this.index = '';
    this.dates = [];
    this.selectedDates = [];
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

        console.log(month + ' - ' + year);

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

            var recurringDate = new Date( d.getFullYear() + '-' + ('0' + (d.getMonth() +1)).slice(-2) + '-' +  ('0' + d.getDate()).slice(-2) );

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
    }
}