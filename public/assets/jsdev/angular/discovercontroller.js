app.controller('DiscoverController', [ "$scope", "$q", function( $scope, $q ){
    $scope.map = {
        center: {
            latitude: 45,
            longitude: -73
        },
        zoom: 12
    };

    var createMarker = function(data){
        var result = {
            idKey: data.id,
            name: data.name,
            image: '/profiles/' + data.user.directory + '/' + data.image,
            latitude: data.venue.lat,
            longitude : data.venue.lng
        }
        return result;
    }

    $scope.everciseGroups =  JSON.parse(laracasts.mapResults);

    $scope.myMarkers = [];

    if($scope.everciseGroups.length < 8 ){
        $scope.initialLoad = $scope.everciseGroups.length;
    }
    else
    {
        $scope.initialLoad = 8;
    }


    $scope.markers = [];

    $scope.loadMore = function(){
        var last = $scope.markers.length -1;
        if($scope.everciseGroups.length < last + 16)
        {
            var extraLoad = $scope.everciseGroups.length - last;
        }
        else
        {
            var extraLoad = 16;
        }

        for (var i = 1; i < extraLoad; i++) {
            $scope.myMarkers.push(createMarker($scope.everciseGroups[ last + i ]))
        }
    };



    $scope.$watch(function() { return $scope.map.bounds; }, function() {



        for (var i = 0; i < $scope.initialLoad; i++) {
            $scope.myMarkers.push(createMarker($scope.everciseGroups[i]))
        }
        $scope.markers = $scope.myMarkers;

    }, true);

}]);
