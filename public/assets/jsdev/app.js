if(typeof angular != 'undefined') {
    var app = angular.module('everApp', [
        "ng.deviceDetector",
        'angularytics',
        'uiGmapgoogle-maps'
    ] , ['$interpolateProvider',function ($interpolateProvider) {
            $interpolateProvider.startSymbol('{[{');
            $interpolateProvider.endSymbol('}]}');
        }]);

    app.config(['uiGmapGoogleMapApiProvider', 'AngularyticsProvider', function (GoogleMapApi, AngularyticsProvider) {
        GoogleMapApi.configure({
            libraries: 'places',
            uk: true
        });
        AngularyticsProvider.setEventHandlers(['Console', 'GoogleUniversal']);
    }]).run([ 'Angularytics',function(Angularytics) {
        Angularytics.init();
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
    app.filter('objLimitTo', [function(){
        return function(obj, limit){
            var keys = Object.keys(obj);
            if(keys.length < 1){
                return [];
            }

            var ret = new Object,
                count = 0;

            angular.forEach(keys, function(key, arrayIndex){
                if(count >= limit){
                    return false;
                }
                ret[key] = obj[key];
                count++;
            });

            return ret;
        };
    }])
    app.directive('errSrc', function() {
        return {
            link: function(scope, element, attrs) {
                element.bind('error', function() {
                    if (attrs.src != attrs.errSrc) {
                        attrs.$set('src', attrs.errSrc);
                    }
                });
            }
        }
    });


}
