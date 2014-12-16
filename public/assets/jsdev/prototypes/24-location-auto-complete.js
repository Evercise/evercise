function LocationAutoComplete(input){
    this.input = input;
    this.autoCompleteStarted = false;
    this.addScript = false;
    this.mapOptions = {};
    this.init();
}
LocationAutoComplete.prototype = {
    constructor: LocationAutoComplete,
    init: function(){
        var self = this;
        //check if we are using angular as angualr ois loading google masp api
        if (typeof angular != 'undefined')
        {
            if( window['google'] ){
                this.load();
            }
            else{
                setTimeout(function() {
                    self.init();
                }, 500);
            }

        }
        else {
            if(!self.addScript){
                var script = document.createElement("script");
                script.src = "//maps.googleapis.com/maps/api/js?libraries=places&callback=autocomplete.load";
                script.type = "text/javascript";
                document.getElementsByTagName("head")[0].appendChild(script);

                self.addScript = true;
            }
            setTimeout(function() {
                self.init();
            }, 500);
        }
    },
    load: function(){
        if (google.maps != undefined && !this.autoCompleteStarted) {
            this.autoCompleteStarted = true;

            var latlng  = new google.maps.LatLng(54.8, -4.6);

            this.mapOptions = {
                zoom: 5,
                center: latlng ,
                mapTypeControl: false,
                panControl: false,
                zoomControl: false,
                streetViewControl: false,
                componentRestrictions: {country: "uk"}
            }

            var self = this;

            var autocomplete = new google.maps.places.Autocomplete(
                document.getElementById(self.input.attr('id')),
                this.mapOptions
            );
        }
        else
        {
            var self = this
            setTimeout(function() {
                self.load();
            }, 500);
        }
    }
}