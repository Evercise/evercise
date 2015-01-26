if(typeof angular != 'undefined') {
    app.controller('calendarController', ["$scope" ,function ($scope) {

        $scope.sessions = JSON.parse($('input[name="sessions"]').val());

        $scope.rows = [];

        $scope.activeDate;

        $scope.cartItems = JSON.parse(CART);

        $('#class-calendar').datepicker({
            format: "yyyy-mm-dd",
            startDate: "+1d",
            weekStart : 1,
            multidate: false,
            beforeShowDay: function(d) {

                var date = d.getFullYear() + '-' + ('0' + (d.getMonth() +1)).slice(-2) + '-' +  ('0' + d.getDate()).slice(-2);
                var result = $.grep($scope.sessions, function(e){
                    var dt = e.date_time;
                    dt = dt.split(/\s+/);
                    return dt[0] == date;
                });


                if(result.length > 0){
                    for(var key in result){
                        if (!checkDuplicate(result[key].id)){
                            var dt = new Date(result[key].date_time.replace(/\s+/, 'T'));
                            $scope.rows.push({
                                'id' : result[key].id,
                                'date' : dt,
                                'price' :result[key].price,
                                'remaining' :result[key].remaining,
                                'default_tickets' :result[key].default_tickets,
                                'selected' : $scope.cartItems[result[key].id],
                                'show' : false
                            })
                        }
                        console.log(dt);
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