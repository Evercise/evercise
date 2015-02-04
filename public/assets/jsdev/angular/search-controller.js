if(typeof angular != 'undefined') {

    app.controller('searchController', ["$scope",  "$http" , "uiGmapGoogleMapApi", function ($scope, $http, uiGmapGoogleMapApi) {

        $scope.groupHeight = function(){
            var resultsHeight = $('.results').outerHeight();
            var headHeight = $('.results .heading').outerHeight();
            var tabHeight = $('.results .nav-tabs').outerHeight();
            var dateHeight = $('.results .date-picker-inline').outerHeight();
            var groupHeight = resultsHeight - headHeight - tabHeight - dateHeight;
            return{
                height : groupHeight+'px'
            }
        }

        $scope.results = laracasts.results;

        console.log($scope.results);

        $scope.resultsLoading = false;

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
            gridSize: 60,
            maxZoom: 20,
            styles: $scope.clusterStyles,
            zoomOnClick: false
        };

        $scope.clusterEvents = {
            click: function (cluster, clusterModels) {

                var center = cluster.getCenter();

                // zoom into cluster

                var map = $scope.map.control.getGMap();
                var newlatlng = new google.maps.LatLng(center.lat(), center.lng());

                map.panTo(newlatlng);

            },
            mouseover: function (cluster, clusterModels) {
                angular.forEach(clusterModels,function(value,key){
                    $('#venue-'+value.id).addClass('text-primary');
                } )
            },
            mouseout: function (cluster, clusterModels) {
                angular.forEach(clusterModels,function(value,key){
                    $('#venue-'+value.id).removeClass('text-primary');
                } )
            }
        };


        // current search radius
        $scope.radius = $scope.results.radius;


        // map object
        $scope.map = {
            zoom: 12,
            maxZoom: 18,
            center:  { latitude: $scope.results.area.lat, longitude: $scope.results.area.lng },
            control: {},
            clusterOptions: $scope.clusterOptions
        };



        // map events
        $scope.mapEvents = {}

        // set available dates

        $scope.availableDates = $scope.results.available_dates;

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
                    times : v.times,
                    price : v.default_price,
                    onClicked: function () {
                        var marker = this.model;
                        // toggle markers
                        $scope.lastActiveMarker.icon = '/assets/img/icon_default_small_pin.png';
                        $scope.lastActiveMarker = marker;
                        marker.icon = '/assets/img/icon_default_large_pink.png';
                        panToMarker(marker);
                    }
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
                    sort : $scope.results.sort
                }
            }

            var responsePromise = $http(req);
            // close tab
            closeTab($('.filter-btn, .sort-btn'));
            // bring up mask
            $scope.resultsLoading = true;

            responsePromise.success(function(data) {
                console.log(data);

                $scope.results = data;
                $scope.availableDates = $scope.results.available_dates;
                $scope.selectedDate = $scope.results.selected_date;
                $scope.everciseGroups = shapeEverciseGroups();
                $scope.resultsLoading = false;
            });

            responsePromise.error(function(data) {
                console.log("AJAX failed!");
                console.log(data);
                $scope.resultsLoading = false;
            });
        }

    }])

}