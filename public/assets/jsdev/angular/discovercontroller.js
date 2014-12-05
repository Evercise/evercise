if(typeof angular != 'undefined') {
    app.controller('DiscoverController', ["$scope", "$q", function ($scope, $q) {

        $scope.everciseGroups = laracasts.mapResults;

        $scope.results = $scope.everciseGroups.length;
        
        $scope.view = 'mapview';

        $scope.sort = 'id';

        $scope.dropwdownStyle = {
            top : 0,
            left : 0
        }

        $scope.active = {};
        $scope.distance = 10;

        // watch the scope for map loaded

        $scope.$watch(function () {
            return $scope.map.bounds;
        }, function () {
            for (var i = 0; i < $scope.initialLoad; i++) {
                $scope.myMarkers.push(createMarker($scope.everciseGroups[i]));
            }
            $scope.markers = $scope.myMarkers;
            $("img.lazy").lazyload({
                container: $(".snippet-body")
            });

        }, true);

        // create the markers
        var createMarker = function (data) {
            var result = {
                id: data.id,
                name: data.name,
                directory: data.user.directory,
                image: data.image,
                latitude: data.venue.lat,
                longitude: data.venue.lng,
                coords : {
                    latitude: data.venue.lat,
                    longitude: data.venue.lng
                },

                icon: '/assets/img/icon_default_small_pin.png',
                price: data.default_price,
                rating: data.ratings.length,
                reviews: data.ratings,
                description: data.description,
                stars: $scope.getStars(data.ratings),
                capacity: data.capacity,
                sessions: data.futuresessions,
                distance : data.distance,
                nextClassDate: data.futuresessions[0].date_time,
                nextClassDuration: data.futuresessions[0].duration,
                link: '/classes/' + data.id,
                click: function () {
                    $scope.clicked(this.model);
                }
            }
            return result;
        }

        $scope.distanceFilter = function (marker) {
            if( marker.distance <= $scope.distance || marker == $scope.active){
                return marker;
            }
        };

        $scope.toggle = function(e,toggle){
            var offset = $(e.target).offset();
            var height = ( $(e.target).height() * 1.5 );
            $scope.dropwdownStyle = {
                top : offset.top + height,
                left : offset.left
            }

            if( $(e.target).parent().hasClass('active') ){
                window.setTimeout(function(){
                    $('#'+toggle).removeClass('active');
                    $(e.target).parent().removeClass('active');
                },1);
            }
        };

        $scope.closeDropdown = function(toggle){
            window.setTimeout(function(){
                $('.tab-pane-sort').removeClass('active');
                $('.'+toggle+'-btn').removeClass('active');
            },1);
            window.setTimeout(function(){
                $('.mb-scroll').mCustomScrollbar("scrollTo", '#'+$scope.lastActiveMarker.id, {
                    scrollInertia: 500,
                    timeout: 10
                });
            },100);
        }

        $scope.changeView = function (view) {
            $scope.view = view;
        };


        $scope.isPreviewOpen = false;

        $scope.currentCenter = {
            latitude: 50,
            longitude: -0.2
        }

        $scope.map = {
            center: $scope.currentCenter,
            pan: {},
            options: {
                streetViewControl: false,
                maxZoom: 19,
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
            // zoom out
            $scope.map.zoom = 15;

            $scope.currentCenter = {
                latitude: marker.latitude,
                longitude: marker.longitude
            }

            $scope.active = marker;
            $scope.distanceFilter(marker);

            // change preview
            $scope.preview.id = 'preview-' + marker.id;
            $scope.preview.image = marker.directory+ "/search_"+ marker.image;
            $scope.preview.description = marker.description;
            $scope.preview.nextClassDate = marker.sessions[0].date_time;
            $scope.preview.nextClassDuration = marker.sessions[0].duration;
            $scope.preview.capacity = marker.capacity;
            $scope.preview.link = marker.link;
            $scope.preview.sessions = marker.sessions;
            //futuresessionDate(marker.sessions);
            $scope.preview.reviews = marker.reviews;

            // topggle markers
            $scope.lastActiveMarker.icon = '/assets/img/icon_default_small_pin.png';
            $scope.lastActiveMarker = marker;
            marker.icon = '/assets/img/icon_default_small_pin_grey.png';

            $scope.mask = true;

            google.maps.event.trigger($scope.map, "resize");
            $scope.map.zoom = 15;
            $scope.map.center = $scope.currentCenter;
            scrollToSnippet('#' + marker.id);

            $scope.isPreviewOpen = true;

        }


        function scrollToSnippet(id) {
            console.log(id);
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

        // test to see if has sessions
        $scope.hasTickets = function(session){
            if(session.remaining > 0){
                return true;
            }
            else{
                return false;
            }
        }
        /*
        $(window).resize(function(){
            $scope.$apply(function(){
                google.maps.event.trigger($scope.map, 'resize');
                $scope.map.center = $scope.currentCenter;
            });
        });
        */
        /*
        $scope.$watch('isPreviewOpen',function(open){
            if(open){
                $(".map-wrapper").animate({
                    left: '820px'
                }, 100, function () {
                    google.maps.event.trigger($scope.map, 'resize');
                    $scope.map.center = $scope.currentCenter;
                });
            }else{
                $(".map-wrapper").animate({
                    left: '410px'
                }, 100, function () {
                    google.maps.event.trigger($scope.map, 'resize');
                    $scope.map.center = $scope.currentCenter;
                });
            }
        });
        */


    }]);
};
