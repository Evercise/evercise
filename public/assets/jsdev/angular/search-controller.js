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

        // and populate the markers

        var firstMarkers = []
        $scope.markers = [];

        // watch for the map been drawn then loop though the map results creating the markers

        function searchForEverciseGroup(nameKey, myArray){
            var results = [];
            for (var i=0; i < myArray.length; i++) {
                if (myArray[i].venue_id == nameKey) {
                    results.push(myArray[i]) ;
                }
            }
            return results;
        }


        $scope.$watch(function () {
            return $scope.map.bounds;
        }, function () {
            for (var key in $scope.mapResults) {
                var obj = $scope.mapResults[key];
                for (var class_id in obj) {
                    if(obj.hasOwnProperty(class_id)){

                        //var everciseGroups = searchForEverciseGroup(key, $scope.hits);

                        for( lng in obj[class_id].location){
                            var longitude = lng;
                            var latitude = obj[class_id].location[lng]
                        }
                        firstMarkers.push(
                            {
                                id: key,
                                latitude: latitude,
                                longitude: longitude,
                                icon: '/assets/img/icon_default_small_pin.png'
                            }
                        );
                    }
                }
            }

            $scope.markers = firstMarkers;
        })

        // now lets create the classes
        $scope.everciseGroups = $scope.results.results.hits;

    }])
}