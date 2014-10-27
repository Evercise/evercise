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
            icon: '/assets/img/icon_default_small_pin.png',
            name: data.name,
            image: '/profiles/' + data.user.directory + '/' + data.image,
            latitude: data.venue.lat,
            longitude : data.venue.lng,
            price : data.default_price,
            rating: data.ratings.length,
            stars: $scope.getStars(data.ratings),
            click : function(){
                $scope.click(result);
            }
        }
        console.log(result);
        return result;
    }

    $scope.markerClass = '';

    $scope.everciseGroups =  JSON.parse(laracasts.mapResults);

    $scope.myMarkers = [];

    $scope.getStars = function(ratings){
        var total = 0;
        if( ratings.length > 0){
            for(var i = 0; i < ratings.length; i++){
                total = total + ratings[i].stars;
            }
            //result = (Math.round( (total / ratings.length) *2) / 2).toFixed(1);
            result = Math.round( total / ratings.length) ;
        }
        else
        {
            result = 0
        }
        return result;
    }

    if($scope.everciseGroups.length < 200 ){
        $scope.initialLoad = $scope.everciseGroups.length;
    }
    else
    {
        $scope.initialLoad = 200;
    }

    $scope.click = function(object){

    }


    $scope.markers = [];

    // load more on scroll
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


    // watch the scope for changes
    $scope.$watch(function() { return $scope.map.bounds; }, function() {
        for (var i = 0; i < $scope.initialLoad; i++) {
            $scope.myMarkers.push(createMarker($scope.everciseGroups[i]))
            console.log($scope.everciseGroups[i]);
        }
        $scope.markers = $scope.myMarkers;

    }, true);
}]);
