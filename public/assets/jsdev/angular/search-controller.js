if(typeof angular != 'undefined') {

    app.controller('searchController', ["$scope",  "$http" , "uiGmapGoogleMapApi", function ($scope, $http, uiGmapGoogleMapApi) {

        $scope.groupHeight = function(){
            var windowWidth = $(window).width();
            if(windowWidth >992 ){
                var resultsHeight = $('.results').outerHeight();
                var headHeight = $('.results .heading').outerHeight();
                var tabHeight = $('.results .nav-tabs').outerHeight();
                var dateHeight = $('.results .date-picker-inline').outerHeight();
                var groupHeight = resultsHeight - headHeight - tabHeight - dateHeight;
                return{
                    height : groupHeight+'px'
                }
            }
            else {
                return {
                    height: 'auto'
                }
            }
        }

        $scope.results = laracasts.results;

        $scope.resultsLoading = false;

        $scope.view = 'list';

        // switch the view

        $scope.switchView = function(view){
            $scope.resultsLoading = true;
            $scope.view = view;
            $scope.resultsLoading = false;
        }

        // map options
        $scope.mapOptions = {
            disableDefaultUI: true,
            zoomControl : true,
            backgroundColor: '#383d48',
            panControl: false
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
            gridSize: 5,
            maxZoom: 20,
            styles: $scope.clusterStyles,
            zoomOnClick: false
        };

        $scope.markerEvents = {
            click: function (marker,e,model) {
                // remove select venue
                $scope.selectedVenueIds = false;
                // toggle markers
                $scope.lastActiveMarker.icon = '/assets/img/icon_default_small_pin.png';
                $scope.lastActiveMarker = model;
                model.icon = '/assets/img/icon_default_large_pink.png';

                panToMarker(model);
                setTimeout(function() {
                    $('.mb-scroll').mCustomScrollbar("scrollTo", $('#group-'+model.id), {
                        scrollInertia: 500,
                        timeout: 20
                    });
                }, 500)
            },
            mouseover: function (marker,e,model) {
                $('#venue-'+model.id).addClass('active');
            },
            mouseout: function (marker,e,model) {
                $('#venue-'+model.id).removeClass('active');
            }
        }

        $scope.selectedVenueIds = false;
        $scope.selectedVenueName = false;

        $scope.clusterEvents = {
            click: function (cluster, clusterModels) {

                $scope.selectedVenueIds = false;

                var center = cluster.getCenter();

                // zoom into cluster

                var map = $scope.map.control.getGMap();
                var newlatlng = new google.maps.LatLng(center.lat(), center.lng());

                map.panTo(newlatlng);


                var svi = [];

                angular.forEach(clusterModels,function(value,key){
                    svi.push(value.id);
                } )
                $scope.selectedVenueIds = svi;
                $scope.selectedVenueName = clusterModels[0].venue.name;
                // toggle markers
                $scope.lastActiveMarker.icon = '/assets/img/icon_default_small_pin.png';
                $scope.lastActiveMarker = cluster;

            },
            mouseover: function (cluster, clusterModels) {
                angular.forEach(clusterModels,function(value,key){
                    $('#venue-'+value.id).addClass('active');
                } )
            },
            mouseout: function (cluster, clusterModels) {
                angular.forEach(clusterModels,function(value,key){
                    $('#venue-'+value.id).removeClass('active');
                } )
            }
        };


        // current search radius
        $scope.radius = $scope.results.radius;

        // set initial zoom
        $scope.initialZoom = function(){
            var radius = $scope.results.radius.substring(0, $scope.results.radius.length  - 2);
            console.log(radius);
            if(radius <= 2){
                return 15
            }
            else if(radius  <= 3)
            {
                return 13
            }
            else if(radius <= 5){
                return 12
            }
            else if(radius < 25){
                return 11
            }
            else{
                return 10
            }
        }


        // map object
        $scope.map = {
            zoom: $scope.initialZoom(),
            maxZoom: 16,
            center:  { latitude: $scope.results.area.lat, longitude: $scope.results.area.lng },
            control: {},
            clusterOptions: $scope.clusterOptions
        };



        // map events
        $scope.mapEvents = {}


        // class results

        $scope.lastActiveMarker = {};

        shapeEverciseGroups = function(){
            var groups = [];
            angular.forEach($scope.results.results.hits, function(v,k){
                groups.push({
                    id : v.id,
                    name : v.name,
                    icon : '/assets/img/icon_default_small_pin.png',
                    venue : {
                        id : v.id,
                        name : v.venue.name,
                        postcode : v.venue.postcode,
                        latitude : v.venue.lat,
                        longitude : v.venue.lng
                    },
                    slug: v.slug,
                    times : v.times ,
                    price : v.default_price,
                    image : '/'+v.user.directory+'/preview_'+v.image
                })
            })
            return groups;
        }

        $scope.everciseGroups = shapeEverciseGroups();


        // pan to

        var panToMarker = function(marker){
            var map = $scope.map.control.getGMap();
            var newlatlng = new google.maps.LatLng(marker.venue.latitude, marker.venue.longitude);

            map.panTo(newlatlng);
        }




        // scroll dates


        $scope.scrollWidth = function(){
            var singleWidth = $('.date-picker-inline li .day').outerWidth();
            var noOfDates = Object.keys($scope.results.available_dates).length;
            return {
                width: (singleWidth * noOfDates) + 'px'
            }
        }

        $scope.scroll_clicked = false;

        $scope.scrollDates = function(direction, e){
            e.preventDefault();
            $scope.scroll_clicked = true;
            var par = $(e.target).parent();
            var width = par.width();
            var content = par.find('.content');
            var mg = parseInt(content.css('margin-left'));
            var contentWidth = -content.width();
            if(direction == 'right'){
                var newMg = mg - width;
            }
            else{
                var newMg = mg + width;
            }
            if(newMg <= 0 && newMg >= contentWidth){
                par.find('.content').css({
                    'margin-left' : newMg+'px'
                })
            }
            setTimeout(function() {
                $scope.scroll_clicked = false;
            }, 500)
        }

        // the selected date
        $scope.selectedDate = $scope.results.selected_date;

        // date clicked

        $scope.changeSelectedDate = function(e, date){
            e.preventDefault();
            $scope.selectedDate = date;

            $scope.getData();
        }

        // update filter results

        $('.filter-btn, .sort-btn').click(function (e) {
            e.preventDefault();
            closeTab($(this));
        });

        var closeTab = function(tab){
            if(tab.parent('li').hasClass('active')){
                window.setTimeout(function(){
                    $(".tab-pane").removeClass('active');
                    tab.parent('li').removeClass('active');
                },1);
            }
        }

        // sort results
        $scope.sortChanged = function(e, sort){
            e.preventDefault();
            $scope.results.sort = sort;
            $scope.getData();
        }

        // url to use for ajax calls
        $scope.url = $scope.results.url;

        // function used for getting data from the server

        $scope.getData = function(){
            var path = '/ajax/uk/';
            var req = {
                method: 'POST',
                url: path+$scope.url,
                headers: {
                    'X-CSRF-Token': TOKEN
                },
                data: {
                    date : $scope.selectedDate,
                    radius : $scope.results.radius,
                    sort : $scope.results.sort,
                    search : $scope.results.search
                }
            }

            var responsePromise = $http(req);
            // close tab
            closeTab($('.filter-btn, .sort-btn'));
            // bring up mask
            $scope.resultsLoading = true;

            responsePromise.success(function(data) {
                $scope.results = data;
                $scope.selectedDate = $scope.results.selected_date;
                $scope.everciseGroups = shapeEverciseGroups();
                $scope.resultsLoading = false;

                // reset zoom
                var map = $scope.map.control.getGMap();
                map.setZoom($scope.initialZoom());
            });

            responsePromise.error(function(data) {
                $scope.resultsLoading = false;
            });
        }


        $scope.width = window.innerWidth;


        $(window).resize(function(){
            $scope.width = window.innerWidth;
        });

        $scope.$watch('width', function(value) {
            if(value < 768){
                $scope.view = 'list';
            }
        });


    }])

}