if(typeof angular != 'undefined') {
    app.controller('searchController', ["$scope", "$q", function ($scope, $q) {

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
            // any map events go here
        }

        // grab original results
        $scope.results = laracasts.results;
        // then the map results
        $scope.mapResults = $scope.results.mapResults;

        console.log($scope.mapResults);

        // then add these to the markers scope
        for (var i = 0; i < $scope.mapResults.length; i++) {
            console.log(i);
        }
        //$scope.markers


    }])
}