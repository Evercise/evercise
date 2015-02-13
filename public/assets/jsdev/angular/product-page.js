if(typeof angular != 'undefined') {
    app.controller('calendarController', ["$scope", "$filter" ,function ($scope, $filter) {

        $scope.sessions = JSON.parse($('input[name="sessions"]').val());

        $scope.rows = [];

        $scope.activeDate;

        $scope.cartItems = JSON.parse(CART);

        $('#class-calendar').datepicker({
            format: "yyyy-mm-dd",
            startDate: "-1d",
            weekStart : 1,
            todayHighlight : false,
            multidate: false,
            setDate: null,
                beforeShowDay: function(d) {
                var date = d.getFullYear() + '-' + ('0' + (d.getMonth() +1)).slice(-2) + '-' +  ('0' + d.getDate()).slice(-2);
                var result = $.grep($scope.sessions, function(e){
                    if(e.remaining  > 0){
                        var dt = e.date_time;
                        dt = dt.split(/\s+/);

                        return dt[0] == date;
                    }
                });
                if(result.length > 0){
                    for(var key in result){
                        if (!checkDuplicate(result[key].id)){
                            var date = result[key].date_time,
                                values = date.split(/[^0-9]/),
                                year = parseInt(values[0], 10),
                                month = parseInt(values[1], 10) - 1, // Month is zero based, so subtract 1
                                day = parseInt(values[2], 10),
                                hours = parseInt(values[3], 10),
                                minutes = parseInt(values[4], 10),
                                seconds = parseInt(values[5], 10),
                                dt;
                            dt = new Date(year, month, day, hours, minutes, seconds);
                            var time = $filter('date')(dt, 'hh:mm a');
                            if(result[key].remaining > 0){
                                $scope.rows.push({
                                    'id' : result[key].id,
                                    'date' : dt,
                                    'time' : time,
                                    'price' :result[key].price,
                                    'remaining' :result[key].remaining,
                                    'default_tickets' :result[key].default_tickets,
                                    'selected' : $scope.cartItems[result[key].id],
                                    'show' : false
                                })
                            }
                        }
                    }
                    return {
                        enabled : true,
                        classes : 'session'
                    };
                }
                else{
                    return {
                        enabled : false,
                        classes : false
                    };
                }
            }
        }).on('changeDate', function(e){
            $scope.activeDate = e.date;
            //$scope.activeDate = d.getFullYear() + '-' + ('0' + (d.getMonth() +1)).slice(-2) + '-' +  ('0' + d.getDate()).slice(-2);
            $scope.$apply();
            $(".select-box").selectbox();
        })

        function checkDuplicate(id){
            for ( var i=0; i < $scope.rows.length; i++ ){
                if ($scope.rows[i].id == id) return true;
            }
            return false;
        }

        $scope.activeFilter = function (rows) {
            if (typeof $scope.activeDate !== 'undefined') {
                var start = rows.date;
                start.setHours(0,0,0,0);
                return start.toString() == $scope.activeDate.toString();
            }
        };
    }])
}