if(typeof angular != 'undefined') {
    app.controller('searchController', ["$scope",  "$http" , "uiGmapGoogleMapApi", function ($scope, $http, uiGmapGoogleMapApi) {


        // grab original results
        $scope.results = laracasts.results;
        console.log($scope.results);

        $scope.location = $scope.results.area.name;
        $scope.lastBounds = {}
        // url to use for ajax calls
        $scope.url = $scope.results.url;

        // then the map results

        $scope.mapResults = $scope.results.mapResults;

        $scope.pageResultNumber = {
            page : $scope.results.page,
            temp : 0
        };

        // map options
        $scope.mapOptions = {
            disableDefaultUI: true,
            zoomControl : true,
            backgroundColor: '#383d48',
            panControl: false
        }

        // distance options

        $scope.distanceOptions = [];

        for (var radius in $scope.results.allowed_radius) {
            $scope.distanceOptions.push({
                value : radius,
                name: $scope.results.allowed_radius[radius]
            });
        }


        $scope.distance = {
            type: $scope.results.radius
        }

        // circle options
        $scope.circleOptions = {
            center:  { latitude: $scope.results.area.lat, longitude: $scope.results.area.lng },
            stroke: {
                color: '#50c3e2',
                weight: 0
            },
            fill: {
                color: '#50c3e2',
                opacity: 0.5
            },
            radius: $scope.results.radius.substring(0, $scope.results.radius.length - 2) * 1609.344
        }


        $scope.setInitialZoom = function(){
            var radius = $scope.results.radius.substring(0, $scope.results.radius.length - 2);
            if(radius <= 2){
                return 13
            }
            else if(radius  <= 3)
            {
                return 12
            }
            else if(radius <= 5){
                return 11
            }
            else if(radius < 25){
                return 10
            }
            else{
                return 9
            }
        }


        // cluster options

        $scope.clusterStyles = [
            {
                textColor: 'white',
                url: '/assets/img/icon_default_small_pin_number.png',
                height: 43,
                width: 33,
                anchorText: [-14,9]
            }
        ];
        $scope.clusterOptions = {
            title: 'click to expand',
            gridSize: 60,
            maxZoom: 13,
            styles: $scope.clusterStyles
        };

        // map object
        $scope.map = {
            zoom: $scope.setInitialZoom(),
            center:  { latitude: $scope.results.area.lat, longitude: $scope.results.area.lng },
            control: {},
            clusterOptions: $scope.clusterOptions
        };


        // map events
        $scope.mapEvents = {
            // any map events go here
            dragend : function () {
                // map instance
                var map = $scope.map.control.getGMap();
                // bounds of viewport of map
                var bounds = map.getBounds();

                var ne = bounds.getNorthEast();
                var sw = bounds.getSouthWest();
                // check if bounds outside of original map bounds
                var originalNe = $scope.originalBounds.getNorthEast();
                var originalSw = $scope.originalBounds.getSouthWest();

                // map bounds object
                var mapBounds = {};
                mapBounds.ne = ne.lat() + ',' + ne.lng();
                mapBounds.sw = sw.lat() + ','+sw.lng();

                // used to only grab new results if the bounding box is out side the previous one
                /*
                if($.isEmptyObject($scope.lastBounds)){
                    drawBounds(map, ne, sw);
                    $scope.refreshResults = true;
                    $scope.getData(mapBounds);
                }
                else{
                    if( $scope.lastBounds.ne.lat <  ne.lat() || $scope.lastBounds.ne.lng <  ne.lng() || $scope.lastBounds.sw.lat >  sw.lat() || $scope.lastBounds.sw.lng >  sw.lng()){
                        drawBounds(map, ne, sw);
                        $scope.refreshResults = true;
                        $scope.getData(mapBounds);
                    }
                }
                */
                $scope.refreshResults = true;
                // check if map is outside original bounds, if so load map results aswell
                if(originalNe.lat() < ne.lat() ||originalNe.lng() < ne.lng() || originalSw.lat() > sw.lat() || originalSw.lng() > sw.lng()){
                    drawBounds(map, originalNe, originalSw);
                    $scope.getData(mapBounds, true);
                }
                else{
                    drawBounds(map, ne, sw);
                    $scope.getData(mapBounds);
                }






                $scope.lastBounds = {
                    ne : {
                        lat : ne.lat(),
                        lng : ne.lng()
                    },
                    sw : {
                        lat : sw.lat(),
                        lng : sw.lng()
                    }
                }

            }
        }


        var drawBounds = function(map, ne, sw){
            var viewportPoints = [
                ne, new google.maps.LatLng(ne.lat(), sw.lng()),
                sw, new google.maps.LatLng(sw.lat(), ne.lng()), ne
            ];

            viewportBox = new google.maps.Polyline({
                path: viewportPoints,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 3
            });
            viewportBox.setMap(map);
        }

        // refresh and center map function

        $scope.refreshMap = function () {
            var map = $scope.map.control.getGMap();
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        };

        // smooth zoom
        var smoothZoom = function(map, max, cnt) {
            if (cnt >= max) {
                return;
            }
            else {
                z = google.maps.event.addListener(map, 'zoom_changed', function(event){
                    google.maps.event.removeListener(z);
                    smoothZoom(map, max, cnt + 1);
                });
                setTimeout(function(){map.setZoom(cnt)}, 80);
            }
        }


        // and populate the markers

        var firstMarkers = []
        $scope.markers = [];




        // watch for the map been drawn then loop though the map results creating the markers

        $scope.$watch(function () {
            return $scope.map;
        }, function () {
            createMarkers();
            uiGmapGoogleMapApi.then(function(maps) {
                var latlng = new maps.LatLng($scope.results.area.lat, $scope.results.area.lng);
                $scope.originalBounds =  new google.maps.Circle({center:latlng , radius:$scope.results.radius.substring(0, $scope.results.radius.length - 2) * 1609.344 }).getBounds();
            });

        })

        var createMarkers = function(){
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
        }


        // now lets create the classes
        $scope.everciseGroups = $scope.results.results.hits;

        // total results
        $scope.totalHits =  $scope.results.results.total;
        // hits per page
        $scope.hitsPerPage = $scope.results.size;

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
            type: $scope.results.sort
        }


        $scope.refreshResults = false;

        // date picker
        var d = new Date()
        var d = d.setDate(d.getDate() + 5);



        // http events

        // marker clicked

        $scope.lastActiveMarker = {}

        var onMarkerClicked = function (marker) {
            // current venue been clikced
            $scope.venue_id =  marker.id;
            // toggle the page numbers
            togglePage();
            // set refresh results as false
            $scope.refreshResults = false;
            // grad venue data
            $scope.getData();
            // zoom into marker
            var map = $scope.map.control.getGMap();
            var newlatlng = new google.maps.LatLng(marker.latitude, marker.longitude);

            map.panTo(newlatlng);
            smoothZoom(map, 14, map.getZoom());

            // toggle markers
            $scope.lastActiveMarker.icon = '/assets/img/icon_default_small_pin.png';
            $scope.lastActiveMarker = marker;
            marker.icon = '/assets/img/icon_default_large_pink.png';

        };

        // get next page of classes
        $scope.nextPage = function(){
            $scope.venue_id = false;
            $scope.pageResultNumber.page = $scope.pageResultNumber.page + 1;
            $scope.refreshResults = false;
            $scope.getData();
        }

        // sort

        $scope.sortChanged = function(){
            $scope.venue_id = false;
            $scope.refreshResults = true;
            togglePage();
            $scope.getData();
        }

        // change distance

        $scope.distanceChanged = function(){
            $scope.venue_id = false;
            $scope.refreshResults = true;
            togglePage();
            $scope.getData();
        }

        // handle page number change
        var togglePage = function(){
            $scope.pageResultNumber.temp = $scope.pageResultNumber.page;
            $scope.pageResultNumber.page = 1;
        }

        // function used for getting data from the server

        $scope.getData = function( bounds , map){
            bounds = typeof bounds !== 'undefined' ? bounds : false;
            map = typeof map !== 'undefined' ? map : false;
            var path = '/ajax/uk/';
            var req = {
                method: 'POST',
                url: path+$scope.url,
                headers: {
                    'X-CSRF-Token': TOKEN
                },
                data: {
                    'page' : $scope.pageResultNumber.page,
                    'venue_id': $scope.venue_id,
                    'sort' : $scope.sort.type,
                    'distance' : $scope.distance.type,
                    'ne' : bounds.ne,
                    'sw' : bounds.sw,
                    'map' : map
                }
            }

            var responsePromise = $http(req);

            responsePromise.success(function(data) {
                if(data.venue_id){
                    $scope.venueResults = data.results.hits;
                    // reset page number
                    $scope.pageResultNumber.page = $scope.pageResultNumber.temp;
                    $scope.pageResultNumber.temp = 0;
                }
                else if($scope.refreshResults){
                    if(map){
                        $scope.mapResults = data.mapResults;
                    }
                    $scope.everciseGroups = data.results.hits;
                    $scope.pageResultNumber.page = data.page;
                    $scope.totalHits =  data.results.total;
                    $scope.hitsPerPage = data.size;
                }
                else{
                    $scope.everciseGroups = $scope.everciseGroups.concat(data.results.hits);
                    $scope.pageResultNumber.page = data.page;
                    $scope.totalHits =  data.results.total;
                    $scope.hitsPerPage = data.size;
                }
            });

            responsePromise.error(function(data) {
                console.log("AJAX failed!");
                console.log(data);
            });
        }

        // window resize events

        $(window).resize(function(){
            $scope.$apply(function(){
                $scope.refreshMap();
            });
        });

        $scope.$watch('mapResults', function(newVal, oldVal) {
            if(newVal != oldVal){
                createMarkers();
            }
        }, true);




    }])
}