app.controller('DiscoverController', [ "$scope", "$q", function( $scope, $q ){
    $scope.map = {
        center: {
            latitude: 45,
            longitude: -73
        },
        zoom: 12
    };

    var createMarker = function(i, data){
        var result = {
            idKey: data.id,
            name: data.name,
            //image: data.image,
            latitude: data.venue.lat,
            longitude : data.venue.lng
        }
        return result;
    }


    $scope.markers = [];

    $scope.$watch(function() { return $scope.map.bounds; }, function() {

        var myMarkers = [];
        var everciseGroups = JSON.parse(laracasts.mapResults);
        for (var i = 0; i < everciseGroups.length; i++) {
            console.log(everciseGroups[i]);
            myMarkers.push(createMarker(i, everciseGroups[i]))
        }
        $scope.markers = myMarkers;

    }, true);
}]);