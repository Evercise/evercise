if(typeof angular != 'undefined') {
    app.controller('searchController', ["$scope", "$q", function ($scope, $q) {

        // grab original map results
        $scope.mapResults = laracasts.mapResults;

        // map options
        $scope.mapOptions = {
            disableDefaultUI: true,
            panControl: false
        }

        // map object
        $scope.map = {
            zoom: 8,
            center:  { latitude: 51, longitude: -1 }
        };



        // map events
        $scope.mapEvents = {
            click : function(mapModel, eventName, originalEventArgs){
                alert('clicked map');
            }
        }


    }])
}