if(typeof angular != 'undefined') {
    app.controller('DiscoverController', ["$scope", "$q", function ($scope, $q) {

        $scope.everciseGroups = laracasts.mapResults;

        $scope.view = 'mapview';

        $scope.sort = 'id';


        $scope.toggle = function(toggle){
            if( $('#'+toggle).hasClass('active') ){
                $('#'+toggle).removeClass('active');
               // $('#'+toggle+'-btn').removeClass('active');
            }
        };

        $scope.changeView = function (view) {
            $scope.view = view;
        };


        $scope.isPreviewOpen = false;

        $scope.map = {
            center: {
                latitude: 50,
                longitude: -1
            },
            pann: {},
            options: {
                streetViewControl: false,
                maxZoom: 20,
                minZoom: 3
            },
            zoom: 12
        };

        $scope.results = $scope.everciseGroups.length;

        $scope.myMarkers = [];


        $scope.clusterStyles = [
            {
                textColor: 'white',
                url: '/assets/img/icon_default_small_pin_number.png',
                height: 43,
                width: 33,
                anchorText: [-14,9]
            },
            {
                textColor: 'white',
                url: '/assets/img/icon_default_large_pin_number.png',
                height: 66,
                width: 51,
                anchorText: [-22,14]
            }
        ];

        $scope.clusterOptions = {
            gridSize: 8,
            maxZoom: 20,
            zoom: 15,
            styles: $scope.clusterStyles
        }

        $scope.mask = false;

        if ($scope.everciseGroups.length < 200) {
            $scope.initialLoad = $scope.everciseGroups.length;
        }
        else {
            $scope.initialLoad = 200;
        }

        $scope.markers = [];


        var createMarker = function (data) {
            var result = {
                id: data.id,
                name: data.name,
                image: '/profiles/' + data.user.directory + '/' + data.image,
                latitude: data.venue.lat,
                longitude: data.venue.lng,
                icon: '/assets/img/icon_default_small_pin.png',
                price: data.default_price,
                rating: data.ratings.length,
                reviews: data.ratings,
                description: data.description,
                stars: $scope.getStars(data.ratings),
                capacity: data.capacity,
                sessions: data.futuresessions,
                distance : data.distance,
                nextClassDate: new Date(data.futuresessions[0].date_time.replace(/-/g, '/')),
                nextClassDuration: data.futuresessions[0].duration,
                link: '/class/' + data.id,
                click: function () {
                    $scope.clicked(this.model);
                }
            }
            return result;
        }


        $scope.clusterEvents = {
            click: function (cluster, clusterModels) {
                angular.forEach(clusterModels, function (value, key) {
                    $scope.clicked(value);
                });
            }
        };

        $scope.returnPreview = function () {
            $scope.isPreviewOpen = false;
        }

        $scope.lastActiveMarker = '';


        $scope.clicked = function (marker) {
            $scope.isPreviewOpen = true;

            // change preview
            $scope.preview.id = 'preview-' + marker.id;
            $scope.preview.image = "url('" + marker.image + "')";
            $scope.preview.description = marker.description;
            $scope.preview.nextClassDate = new Date(marker.sessions[0].date_time.replace(/-/g, '/'));
            $scope.preview.nextClassDuration = marker.sessions[0].duration;
            $scope.preview.capacity = marker.capacity;
            $scope.preview.link = marker.link;
            $scope.preview.sessions = marker.sessions;
            $scope.preview.reviews = marker.reviews;

            // topggle markers
            $scope.lastActiveMarker.icon = '/assets/img/icon_default_small_pin.png';
            $scope.lastActiveMarker = marker;
            marker.icon = '/assets/img/icon_default_large_pin.png';

            //pan map
            $scope.map.center = {
                latitude: marker.latitude,
                longitude: marker.longitude
            };
            $scope.map.zoom = 15;

            $scope.mask = true;
            // find in side bar ands scroll


            scrollToSnippet('#' + marker.id);
        }

        function scrollToSnippet(id) {
            $('.class-snippet').addClass('fade-out');
            $('.class-snippet').removeClass('active');
            $(id).addClass('active');
            $('.mb-scroll').mCustomScrollbar("scrollTo", id, {
                scrollInertia: 500,
                timeout: 10
            });
        }

        $scope.getStars = function (ratings) {
            var total = 0;
            if (ratings.length > 0) {
                for (var i = 0; i < ratings.length; i++) {
                    total = total + ratings[i].stars;
                }
                result = Math.round(total / ratings.length);
            }
            else {
                result = 0
            }
            return result;
        }

        $scope.preview = {
            id: 1,
            image: '',
            description: '',
            nextClassDate: '',
            nextClassDuration: '',
            capacity: '',
            link: ''
        }
        // watch the scope for map loaded

        $scope.$watch(function () {
            return $scope.map.bounds;
        }, function () {
            for (var i = 0; i < $scope.initialLoad; i++) {
                $scope.myMarkers.push(createMarker($scope.everciseGroups[i]));
            }
            $scope.markers = $scope.myMarkers;

        }, true);

    }]);
}
