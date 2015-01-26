function classCalendar(calendar){
    this.calendar = calendar;
    this.sessions = calendar.find('input[name="sessions"]').val();
    this.rows = [];
    this.init();
}

classCalendar.prototype = {
    constructor : classCalendar,
    init : function(){
        var obj = JSON.parse(this.sessions);
        var self = this;
        this.calendar.datepicker({
            format: "yyyy-mm-dd",
            startDate: "+1d",
            weekStart : 1,
            multidate: true,
            beforeShowDay: function(d) {
                var date = d.getFullYear() + '-' + ('0' + (d.getMonth() +1)).slice(-2) + '-' +  ('0' + d.getDate()).slice(-2)
                var result = $.grep(obj, function(e){
                    var dt = e.date_time;
                    dt = dt.split(/\s+/);
                    return dt[0] == date;
                });

                if(result.length > 0){
                    var ids = [];
                    for(var key in result){
                        ids.push(result[key].id);
                        self.rows.push({
                            'id' : result[key].id,
                            'list' : '<li>'+result[key].date_time+'</li>',
                            'show' : false
                        })

                    }
                    return {
                        enabled : true,
                        classes : 'session',
                        session : ids
                    };
                }
                else{
                    return {
                        enabled : false,
                        classes : false,
                        session : false
                    };
                }
            }
        })
        this.addListeners();

    },
    addListeners : function(){

        this.calendar.find('.day').on('click', $.proxy(this.dateSelected, this));
    },
    dateSelected :  function(e){
        e.preventDefault();
        e.stopPropagation();
        var arr = $(e.target).data('session').split(',');

        var self = this;
        for(var i = 0; i<arr.length; i++){
            $.grep(self.rows, function(e){
                if(e.id == arr[i]){
                    self.calendar.after(e.list);
                }
            });
        }

    }
}