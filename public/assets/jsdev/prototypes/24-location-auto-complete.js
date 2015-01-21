function LocationAutoComplete(input){
    this.input = input;
    this.autoCompleteStarted = false;
    this.addScript = false;
    this.mapOptions = {};
    this.address_components = [];
    this.town = 'london';
    this.width = 0;
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

            this.mapOptions = {
                componentRestrictions: {country: "uk"}
            }

            var self = this;

            var autocomplete = new google.maps.places.Autocomplete(
                document.getElementById(self.input.attr('id')),
                this.mapOptions
            );

            // event to append find my loctaion to top of autocomplete
            self.addListeners();

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();

                self.address_components = place.address_components;

                self.getTown();

                self.updateCity();

            });

        }
        else
        {
            var self = this
            setTimeout(function() {
                self.load();
            }, 500);
        }
    },
    getTown : function(){
        var self = this;

        var result = this.address_components;

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
    },
    updateCity : function(){
        this.form.find('input[name="city"]').val(this.town);
    },
    addListeners : function(){
        this.input.on('click', $.proxy(this.addNearMe, this))
    },
    addNearMe : function(e){
        this.width = $(e.target).parent().width();
        var pac = $('.pac-container');
        if($('#near-me').length == 0) {
            pac.append('<li id="near-me" class="heading locator"><span class="icon icon-lg icon-locator-pink"></span> my Current Location</li>');
            this.setWidth(pac);
        }
    },
    setWidth :function(pac){
        if(pac.is(':visible')) {
            pac.width(this.width - 2);
        }
        else{
            var self = this
            setTimeout(function() {
                self.setWidth(pac);
            }, 300);
        }
    }
}