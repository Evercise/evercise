function Calendar(elem){
    this.container = elem;
    this.daysOfWeek = '';
    this.days = '';
    this.index = '';
    this.recurring = 6;
    this.rows = [];
    this.firstRecurringDay = '';
    this.init();
}
Calendar.prototype = {
    constructor: Calendar,
    init: function () {

        this.container.datepicker({
            format: "yyyy-mm-dd",
            startDate: "+1d",
            todayHighlight: true,
            multidate: true
        });
        this.daysOfWeek = this.container.find('.dow');
        this.days = this.container.find('.day');
        this.addListener();
    },
    addListener: function () {
        this.daysOfWeek.on("click", $.proxy(this.recurringDay, this) );
    },
    recurringDay: function(e){
        this.index = ($(e.target).index());
        for(var r = 0; r < 2; r++){
            this.rows = [];
            this.setRecurringDays();

            this.index = ($(e.target).index());

        }

    },
    setRecurringDays: function(){
        var self = this;
        for(var i = 0; i < 6; i++){
            self.rows.push(self.container.find('tbody .day:eq(' + self.index + ')') );
            self.index = self.index + 7;
        }
        self.clickRecurringDays();

    },
    clickRecurringDays: function(){
        var self = this;
        $.each(this.rows, function(i, val) {
            $(val.selector+':not(.new)').click();
        })
        self.nextMonth();
    },
    nextMonth : function(){
        $('th.next').first().click();
    }
}