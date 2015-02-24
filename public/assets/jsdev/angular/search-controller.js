if(typeof angular != 'undefined') {

    app.controller('searchController', ["$scope",  "$http" , "uiGmapIsReady", "Angularytics", "uiGmapGoogleMapApi",'$window', function ($scope, $http, uiGmapIsReady, Angularytics, uiGmapGoogleMapApi,  $window) {

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

        $scope.width = window.innerWidth;

        $scope.results = laracasts.results;
        console.log($scope.results);

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
            minZoom: 11,
            maxZoom: 17,
            disableDefaultUI: true,
            zoomControl : true,
            backgroundColor: '#383d48',
            panControl: false
        }

        $scope.selectedVenueIds = false;
        $scope.selectedVenueName = false;
        $scope.otherDates = [];



        $scope.closeVenue = function(){
            $scope.selectedVenueIds = false;
            $scope.otherDates.length = 0;
            $scope.lastActiveMarker.icon =  {
                url : '/assets/img/icon_default_pin_active.svg',
                size :  new google.maps.Size(40, 40),
                scaledSize : new google.maps.Size(40, 40)
            }
        }



        // current search radius
        $scope.radius = $scope.results.radius;

        // set initial zoom
        $scope.initialZoom = function(){
            var radius = $scope.results.radius.substring(0, $scope.results.radius.length  - 2);
            var results = $scope.results.results.total;
            if(results == 1){
                if(radius == 10){
                    return 10
                }
                else if(radius == 5){
                    return 12
                }
                else if(radius == 3){
                    return 13
                }
                else{
                    return 14
                }
            }
            if(radius == 1){
                return 14
            }
            else if(radius  == 3)
            {
                return 13
            }
            else if(radius == 5){
                return 12
            }
            else if(radius == 10){
                return 11
            }
        }

        $scope.circleOptions = {
            center:  { latitude: $scope.results.area.lat, longitude: $scope.results.area.lng },
            stroke: {
                color: '#50c3e2',
                weight: 2
            },
            fill: {
                opacity: 0
            },
            radius: $scope.results.radius.substring(0, $scope.results.radius.length - 2) * 1609.344
        }



        // map object
        $scope.setMapCenter = function(){
            var radius = $scope.results.radius.substring(0, $scope.results.radius.length  - 2);
            var lng = $scope.results.area.lng;
            if($scope.width >= 992 ){
                if(radius == 10){
                    return lng + 0.13;
                }
                if(radius == 5){
                    return lng + 0.09;
                }
                if(radius == 3){
                    return lng + 0.04;
                }
                if(radius == 1){
                    return lng + 0.02;
                }
            }
            else{
                return lng;
            }
        }
        $scope.map = {
            zoom: $scope.initialZoom(),
            center:  { latitude: $scope.results.area.lat, longitude: $scope.setMapCenter()},
            control: {}
        };

        $scope.bounds = {}


        // map events
        $scope.mapEvents = {
            // any map events go here
            drag : function(){
                //getBounds();
            },
            dragend : function () {
                $scope.bounds = getBounds();
                $scope.getData(true);
            },
            zoom_changed : function(){
                //getBounds();
            }
        }



        var getBounds = function(){
            // map instance
            var m = $scope.map.control.getGMap();
            // bounds of view port of map
            var bounds = m.getBounds();
            var ne = bounds.getNorthEast();
            var sw = bounds.getSouthWest();
            // map bounds object
            var mapBounds = {};
            if(sw.lat() < $scope.furthestBottom){
                $scope.furthestBottom = sw.lat();
            }
            if(ne.lat() > $scope.furthestTop){
                $scope.furthestTop = ne.lat();
            }
            if(sw.lng() < $scope.furthestLeft){
                $scope.furthestLeft = sw.lng();
            }
            if(ne.lng() > $scope.furthestRight){
                $scope.furthestRight = ne.lng();
            }

            mapBounds.ne = $scope.furthestTop + ',' + $scope.furthestRight;
            mapBounds.sw = $scope.furthestBottom + ','+$scope.furthestLeft;
            return mapBounds;
        }


        // class results

        $scope.lastActiveMarker = {};

        // groups
        $scope.everciseGroups = [];

        shapeEverciseGroups = function(){
            var groups = [];
            var venue = [];
            for(var i = 0; i < $scope.results.results.hits.length; i++){
                var v = $scope.results.results.hits[i];
                /*
                var arr = $.grep($scope.everciseGroups, function(item, index) {
                    return item.id != v.id;
                });
                */
                var arr = true;

                if(arr){
                    var icon = {
                        url : '/assets/img/icon_default_pin_inactive.svg',
                        size :  new google.maps.Size(28, 28),
                        scaledSize : new google.maps.Size(28, 28)
                    };
                    var notFound = true;
                    var active = false;
                    var zindex = -1;
                    var nextDates = [];
                    var tempIcon = false;
                    var times = $.map(v.dates, function(value, index) {
                        if(index == $scope.activeDate){
                            icon = {
                                url : '/assets/img/icon_default_pin_active.svg',
                                size :  new google.maps.Size(40, 40),
                                scaledSize : new google.maps.Size(40, 40)
                            };
                            active = true;
                            zindex = 10;
                            notFound == false;
                            venue.push({
                                venueId : v.venue.id ,
                                groupId : v.id
                            });
                            return [value];
                        }
                        else{
                            nextDates.push(index);
                        }

                    });
                    if($scope.passInGroupId == v.id ){
                        icon = {
                            url : '/assets/img/icon_default_pin_selected.svg',
                            size :  new google.maps.Size(40, 40),
                            scaledSize : new google.maps.Size(40, 40)
                        };
                        tempIcon = true;
                        $scope.otherDates = nextDates;
                        zindex = 20;
                    }
                    var score = v.score;
                    if(!$scope.results.search){
                        score = i;
                    };
                    console.log(v.id+'.'+Math.floor(Math.random() * 6000) + 1);
                    groups.push({
                        id : v.id,
                        keyId: v.id+'.'+Math.floor(Math.random() * 6000) + 1,
                        name : v.name,
                        icon : icon,
                        options : {
                            zIndex : zindex
                        },
                        venue : {
                            id : v.venue.id,
                            name : v.venue.name,
                            postcode : v.venue.postcode,
                            latitude : v.venue.lat,
                            longitude : v.venue.lng
                        },
                        active : active,
                        tempIcon : tempIcon,
                        slug: v.slug,
                        score: score,
                        remaining: v.futuresessions[0].remaining,
                        times : times[0] ,
                        otherDates : nextDates,
                        price : v.default_price,
                        image : '/'+v.user.directory+'/preview_'+v.image
                    })
                }
            }
            $scope.venues = venue;
            return groups;
        }

        $scope.markerEvents = {
            click: function (marker,e,model) {
                $scope.passInGroupId = model.id;
                $scope.otherDates = model.otherDates;
                if(!model.active){
                    $scope.activeDate = model.otherDates[0];
                    $scope.everciseGroups = shapeEverciseGroups();
                    $scope.lastActiveMarker = model;
                    markerClicked(marker,e,model);
                }
                else{
                    for(var i = 0; i < $scope.everciseGroups.length; i++){
                        if($scope.everciseGroups[i].tempIcon){
                            $scope.everciseGroups[i].icon.url = '/assets/img/icon_default_pin_active.svg';
                            $scope.everciseGroups[i].icon.scaledSize =  new google.maps.Size(40, 40);
                            $scope.everciseGroups[i].icon.size =  new google.maps.Size(40, 40);
                            $scope.everciseGroups[i].tempIcon = false;
                        }
                    }
                    // toggle markers
                    $scope.lastActiveMarker.icon =  {
                        url : '/assets/img/icon_default_pin_active.svg',
                        size :  new google.maps.Size(40, 40),
                        scaledSize : new google.maps.Size(40, 40)
                    }
                    $scope.lastActiveMarker = model;
                    model.icon.url = '/assets/img/icon_default_pin_selected.svg';
                    model.icon.scaledSize =  new google.maps.Size(40, 40);
                    model.icon.size =  new google.maps.Size(40, 40);
                    model.options.zIndex = 20;
                    markerClicked(marker,e,model);
                }
            },
            mouseover: function (marker,e,model) {
                //$('#venue-'+model.id).addClass('active');
            },
            mouseout: function (marker,e,model) {
                // $('#venue-'+model.id).removeClass('active');
            }
        }

        var markerClicked = function(marker,e,model){
            // check if there are other classes at this venue
            var vId = model.venue.id;
            var svi = [];
            for(var i = 0; i < $scope.venues.length; i++){
                if(vId == $scope.venues[i].venueId ){
                    svi.push($scope.venues[i].groupId);
                }
            }
            if(svi.length > 1){
                // start select venue
                $scope.selectedVenueIds = true;
                $scope.selectedVenueIds = svi;
                $scope.selectedVenueName = model.venue.name;
            }
            else{
                // active group id
                $scope.activeGroupId = model.id;
                // remove select venue
                $scope.selectedVenueIds = false;

                setTimeout(function() {
                    $('.mb-scroll').mCustomScrollbar("scrollTo", $('#group-'+model.id), {
                        scrollInertia: 500,
                        timeout: 20
                    });
                }, 100)
                setTimeout(function() {
                    panToMarker(model);
                },200)
            }

        }



        uiGmapIsReady.promise(1).then(function(instances) {
            $scope.everciseGroups = shapeEverciseGroups();
        });

        $scope.$watch(function () {
            return $scope.map;
        }, function () {
            uiGmapGoogleMapApi.then(function(maps) {
                var latlng = new maps.LatLng($scope.results.area.lat, $scope.results.area.lng);
                $scope.originalBounds =  new google.maps.Circle({center:latlng , radius:$scope.results.radius.substring(0, $scope.results.radius.length - 2) * 1609.344 }).getBounds();
                var ne = $scope.originalBounds.getNorthEast();
                var sw = $scope.originalBounds.getSouthWest();
                $scope.furthestTop = ne.lat();
                $scope.furthestBottom = sw.lat();
                $scope.furthestLeft = sw.lng();
                $scope.furthestRight = ne.lng();
            });

        })



        $scope.isClassVisible = function(item){
            if ($.inArray(item.id, $scope.selectedVenueIds) !== -1)
            {
                return true;
            }
            return item.active == true;
        }


        // pan to

        var panToMarker = function(marker){
            var map = $scope.map.control.getGMap();
            var newlatlng = new google.maps.LatLng(marker.venue.latitude, marker.venue.longitude);
            map.panTo(newlatlng);
        }




        // scroll dates

        $scope.available_dates = $scope.results.available_dates;

        $scope.scroll_clicked = false;

        $scope.scrollDates = function(direction, e){
            e.preventDefault();
            $scope.scroll_clicked = true;
            var date = $scope.selectedDate,
                values = date.split(/[^0-9]/),
                year = parseInt(values[0], 10),
                month = parseInt(values[1], 10) - 1, // Month is zero based, so subtract 1
                day = parseInt(values[2], 10),
                dt;
            dt = new Date(year, month, day);
            if(direction == 'right'){
                dt.setDate(dt.getDate() + 7);
            }
            else{
                dt.setDate(dt.getDate() - 7);
            }
            $scope.selectedDate = dt.getFullYear() + '-' + ('0' + (dt.getMonth() +1)).slice(-2) + '-' +  ('0' + dt.getDate()).slice(-2);
            $scope.getData();

            setTimeout(function() {
                $scope.scroll_clicked = false;
            }, 500)
        }

        // the selected date
        $scope.selectedDate = $scope.results.selected_date;
        $scope.activeDate = $scope.results.selected_date;

        // date clicked

        $scope.changeActiveDate = function(e, date){
            e.preventDefault();
            $scope.activeDate = date;
            $scope.everciseGroups = shapeEverciseGroups();
            setTimeout(function() {
                $('.mb-scroll').mCustomScrollbar("scrollTo", $('#group-'+$scope.activeGroupId), {
                    scrollInertia: 500,
                    timeout: 20
                });
            }, 100)
        }


        // update filter results

        $scope.openFilter = null;

        $(document).on('click','.filter-btn, .sort-btn', function(e){
            e.preventDefault();
            closeTab($(this));
        } )

        var closeTab = function(tab){
            if(tab.attr('class') == $scope.openFilter){
                $scope.openFilter = null;
                window.setTimeout(function(){
                    $(".tab-pane").removeClass('active');
                    tab.parent('li').removeClass('active');
                },1);
            }else{
                $scope.openFilter = tab.attr('class');
            }
        }

        // sort results
        $scope.sortChanged = function(e, sort){
            e.preventDefault();
            $scope.results.sort = sort;
        }

        $scope.sortGroups = 'score';

        $scope.$watch('results.sort', function(newVal, oldVal) {
            if(newVal != oldVal){
                if(newVal== 'distance'){
                    $scope.sortGroups = 'distance';
                }
                else if(newVal == 'price_desc'){
                    $scope.sortGroups = '-price';
                }
                else if(newVal == 'price_asc'){
                    $scope.sortGroups = 'price';
                }
                else{
                    $scope.sortGroups = 'score';
                }
            }
            $(".tab-pane").removeClass('active');
            $('.sort-btn').parent('li').removeClass('active');
            $scope.openFilter = null;
        }, true);



        // url to use for ajax calls
        $scope.url = $scope.results.url;

        // function used for getting data from the server

        $scope.getData = function(drag){
            var ne = $scope.bounds.ne;
            var sw = $scope.bounds.sw;
            if (typeof drag === "undefined" || drag === null) {
                var drag = false;
                ne = false;
                sw = false;
            }
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
                    search : $scope.results.search,
                    ne : ne,
                    sw : sw
                }
            }
            var responsePromise = $http(req);
            // close tab
            $scope.openFilter = null;
            $(".tab-pane").removeClass('active');
            $('.filter-btn, .sort-btn').parent().removeClass('active');
            // bring up mask
            $scope.resultsLoading = true;

            responsePromise.success(function(data) {
                $scope.results = data;
                $scope.available_dates = $scope.results.available_dates;
                $scope.selectedDate = $scope.results.selected_date;
                $scope.activeDate = $scope.results.selected_date;
                $scope.activeGroupId = false;
                $scope.everciseGroups = shapeEverciseGroups();
                if(!drag){
                    $scope.map.center =  {
                     latitude: $scope.results.area.lat,
                     longitude: $scope.setMapCenter()
                     };
                    $scope.map.zoom = $scope.initialZoom();
                    $scope.circleOptions.center = { latitude: $scope.results.area.lat, longitude: $scope.results.area.lng };
                    $scope.circleOptions.radius = $scope.results.radius.substring(0, $scope.results.radius.length - 2) * 1609.344;
                }

                $scope.resultsLoading = false;
            });
            responsePromise.error(function(data) {
                $scope.resultsLoading = false;
            });
        }


        $(window).resize(function(){
            $scope.width = window.innerWidth;
        });

        $scope.$watch('width', function(value) {
            if(value < 768){
                $scope.view = 'list';
            }
        });

        // google anayltics

        $scope.gaEventTrigger = function(cat,action, label ) {
            Angularytics.trackEvent(cat, action, label);
        }


    }])

}