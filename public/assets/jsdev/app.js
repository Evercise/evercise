var app = angular.module('DiscoverApp', [
    'google-maps'.ns(),
    'infinite-scroll'
]);

app.config(['GoogleMapApiProvider'.ns(), function (GoogleMapApi) {
    GoogleMapApi.configure({
        v: '3.16',
        libraries: 'weather,geometry,visualization'
    });
}]);

