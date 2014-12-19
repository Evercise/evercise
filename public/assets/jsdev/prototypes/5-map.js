// Class Map
function Map(map) {
    this.lat = map.data('lat');
    this.lng = map.data('lng');
    this.zoom = map.data('zoom');
    this.icon = '/assets/img/icon_default_small_pin.png';
    this.init();
}

Map.prototype = {
    constructor: Map,
    init: function(){
        var script = document.createElement("script");
        script.src = "//www.google.com/jsapi?key=AIzaSyAha5JzFciZvU_rWu_2d2UVl7o4Z8LWdcg&callback=map.load";
        script.type = "text/javascript";
        document.getElementsByTagName("head")[0].appendChild(script);
    },
    load: function(){
        self = this;
        google.load("maps", "3", {other_params: "sensor=false", "callback" : function(){
            var map = new google.maps.Map(
                document.getElementById('map_canvas'), {
                center: new google.maps.LatLng(self.lat, self.lng),
                zoom: self.zoom,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            google.maps.event.trigger(map, "resize");
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(self.lat, self.lng),
                animation: google.maps.Animation.DROP,
                icon: self.icon
            });
            marker.setMap(map);
        }});
    }
}