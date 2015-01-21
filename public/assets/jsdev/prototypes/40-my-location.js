function myLocation(){
    this.town = 'london';
    this.btn;
    this.form;
    this.addListeners();
}

myLocation.prototype = {
    constructor : myLocation,

    addListeners : function(){
        $(document).on('click', '.locator', $.proxy(this.init, this))
        //this.btn.on('click', $.proxy(this.init, this));
    },
    init: function(e){
        this.btn = $(e.target);
        this.form = $(e.target).closest('form');
        e.preventDefault();
        e.stopPropagation();
        navigator.geolocation.getCurrentPosition($.proxy(this.displayPosition, this), $.proxy(this.displayError, this));
    },
    displayPosition : function(position){

        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        this.getLocation(lat,lng);
    },
    displayError : function(error){
        var errors = {
            1: 'Permission denied',
            2: 'Position unavailable',
            3: 'Request timeout'
        };
        alert("Error: " + errors[error.code]);
    },
    getLocation: function(lat, lng){
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(lat, lng);
        var self = this;
        geocoder.geocode({'latLng': latlng}, function(results, status) {
            if (results[0] && status == 'OK') {
                var address = results[0].formatted_address;

                self.form.find('input[name="location"]').val(address);
                self.getTown(results[0].address_components);
                self.form.find('input[name="city"]').val(self.town);
                if(self.btn.is('#mobile-sub')) {
                    self.form.trigger('submit');
                }
            }
            else{
                console.log(status);
            }
        })
    },
    getTown : function(address_components){
        var self = this;

        var result = address_components;

        for (var i = 0; i < result.length; ++i) {

            if (result[i].types[0] == "locality") {
                self.town = result[i].long_name ;
            }
            else if(result[i].types[0] == "political") {
                self.town = result[i].long_name ;
            }
            else if(result[i].types[0] == "postal_town"){
                self.town = result[i].long_name ;
            }
        }
    }



}