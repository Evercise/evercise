function LocationAutoComplete(input){
    this.input = input;
    this.autoCompleteStarted = false;
    this.addScript = false;
    this.mapOptions = {};
    this.address_components = [];
    this.town = 'london';
    this.width = 0;
    this.form;
    this.init();
}
LocationAutoComplete.prototype = {
    constructor: LocationAutoComplete,
    init: function(){
        // find form
        this.form = this.input.closest("form");

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
            this.addListeners();
        }
        else
        {
            var self = this
            setTimeout(function() {
                self.load();
            }, 500);
        }
    },
    addListeners : function(){
        var self = this;
        this.input.keyup( function() {
            if( this.value.length < 2 ) return;
            var service =  new google.maps.places.AutocompleteService();
            var res = service.getPlacePredictions({ input: self.input.val() }, function(predictions, status){
                if (status != google.maps.places.PlacesServiceStatus.OK) {
                    return;
                }
                $('#locaction-autocomplete .autocomplete-content').html('');
                for (var i = 0, prediction; prediction = predictions[i]; i++) {
                    $('#locaction-autocomplete .autocomplete-content').append('<li><a href="'+prediction.description+'">'+ prediction.description +'</a></li>');
                }
            });
        });
        $(document).on('click', '#locaction-autocomplete .autocomplete-content a', $.proxy(this.changeLocation, this));
    },
    changeLocation : function(e){
        e.preventDefault();
        var value = $(e.target).attr('href');
        var self = this;
        geocoder = new google.maps.Geocoder();
        this.form = this.input.closest('form');
        geocoder.geocode({'address': value}, function(results, status) {
            if (results[0] && status == 'OK') {
                var address = results[0].formatted_address;
                self.form.find('input[name="location"]').val(address);
                self.getTown(results[0].address_components);
                self.form.find('input[name="city"]').val(self.town);
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