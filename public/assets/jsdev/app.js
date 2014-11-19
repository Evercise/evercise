if(typeof angular != 'undefined') {
    var app = angular.module('DiscoverApp', [
        'google-maps'.ns()
    ]);

    app.config(['GoogleMapApiProvider'.ns(), function (GoogleMapApi) {
        GoogleMapApi.configure({
            v: '3.16',
            libraries: 'weather,geometry,visualization'
        });
    }]);

    app.filter('truncate', function () {
        return function (text, length, end) {
            if (isNaN(length))
                length = 10;

            if (end === undefined)
                end = "...";

            if (text.length <= length || text.length - end.length <= length) {
                return text;
            }
            else {
                return String(text).substring(0, length-end.length) + end;
            }

        };
    });

    app.filter('repeat', function() {
        return function(val, range) {
            range = parseInt(range);
            for (var i=0; i<range; i++)
                val.push(i);
            return val;
        };
    });

}
