if(typeof angular != 'undefined') {
    app.controller('searchController', ["$scope",  "$http" , function ($scope, $http) {

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
        $scope.location = $scope.results.area.name;

        // then the map results

        $scope.mapResults = $scope.results.mapResults;

        $scope.pageResultNumber = {
            page : $scope.results.page,
            temp : 0
        };

        // set fetch data for all http calls

        $scope.fetchData = {};

        // and populate the markers

        var firstMarkers = []
        $scope.markers = [];

        // watch for the map been drawn then loop though the map results creating the markers

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
                                icon: '/assets/img/icon_default_small_pin.png',
                                onClicked: function () {
                                    onMarkerClicked(this.model);
                                }
                            }
                        );
                    }
                }
            }

            $scope.markers = firstMarkers;

        })


        // now lets create the classes
        $scope.everciseGroups = $scope.results.results.hits;

        // venue results
        $scope.venue_id = false;

        $scope.venueResults = false;

        // sort options


        $scope.sortOptions = [
            {
                value : 'best',
                name: 'Best'
            },
            {
                value : 'price_asc',
                name : 'Price Asc'
            },
            {
                value : 'price_desc',
                name : 'Price Desc'
            },
            {
                value : 'duration_asc',
                name : 'Duration Asc'
            },
            {
                value : 'duration_desc',
                name : 'Duration Desc'
            },
            {
                value : 'viewed_asc',
                name : 'Viewed Asc'
            },
            {
                value : 'viewed_desc',
                name : 'Viewed Desc'
            }

        ]

        $scope.sort = {
            type: $scope.sortOptions[0].value
        }

        $scope.refreshResults = false;

        // http events

        // marker clicked

        var onMarkerClicked = function (marker) {
            $scope.venue_id =  marker.id
            $scope.getData();
            $scope.refreshResults = false;
        };

        // get next page of classes
        $scope.nextPage = function(){
            $scope.venue_id = false;
            $scope.pageResultNumber.page = $scope.pageResultNumber.page + 1;
            $scope.getData();
            $scope.refreshResults = false;
        }

        // sort

        $scope.sortChanged = function(option){
            $scope.venue_id = false;
            $scope.fetchData = {
                'sort': option.type
            }
            $scope.refreshResults = true;
            $scope.pageResultNumber.temp = $scope.pageResultNumber.page;
            $scope.pageResultNumber.page = 1;
            $scope.getData();
        }

        // function used for getting data from the server

        $scope.getData = function(){

            var req = {
                method: 'POST',
                url: '/ajax/uk/'+$scope.location,
                headers: {
                    'X-CSRF-Token': TOKEN
                },
                data: {
                    'page' : $scope.pageResultNumber.page,
                    'venue_id': $scope.venue_id,
                    'sort' : $scope.sort.type
                }
            }
            var responsePromise = $http(req);

            responsePromise.success(function(data, status, headers, config) {
                if(data.venue_id){
                    $scope.venueResults = data.results.hits;
                    // reset page number
                    $scope.pageResultNumber.page = $scope.pageResultNumber.temp;
                    $scope.pageResultNumber.temp = 0;
                }
                else if($scope.refreshResults){
                    $scope.everciseGroups = data.results.hits;
                    $scope.pageResultNumber.page = data.page;
                }
                else{
                    $scope.everciseGroups = $scope.everciseGroups.concat(data.results.hits);
                    $scope.pageResultNumber.page = data.page;
                }
            });

            responsePromise.error(function(data, status, headers, config) {

                console.log("AJAX failed!");
            });
        }

    }])
}