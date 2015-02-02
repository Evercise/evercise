if(typeof angular != 'undefined') {
    app.controller('searchController', ["$scope",  "$http" , "uiGmapGoogleMapApi", function ($scope, $http, uiGmapGoogleMapApi) {

        $scope.results = laracasts.results;
        console.log($scope.results);

        // map options
        $scope.mapOptions = {
            disableDefaultUI: true,
            zoomControl : true,
            backgroundColor: '#383d48',
            panControl: false
        }

        // map object
        $scope.map = {
            zoom: 12,
            center:  { latitude: $scope.results.area.lat, longitude: $scope.results.area.lng },
            control: {}
        };

        // map events
        $scope.mapEvents = {}

        // set available dates

        $scope.availableDates = $scope.results.available_dates;

        // scroll dates

        $scope.scroll_clicked = false;

        $scope.scrollDates = function(direction, e){
            e.preventDefault();
            $scope.scroll_clicked = true;
            var par = $(e.target).parent();
            var width = par.width();
            var content = par.find('.content');
            var mg = parseInt(content.css('margin-left'));
            var contentWidth = -content.width();
            if(direction == 'right'){
                var newMg = mg - width;
            }
            else{
                var newMg = mg + width;
            }
            if(newMg <= 0 && newMg >= contentWidth){
                par.find('.content').css({
                    'margin-left' : newMg+'px'
                })
            }
            setTimeout(function() {
                $scope.scroll_clicked = false;
            }, 500)
        }


    }])
}