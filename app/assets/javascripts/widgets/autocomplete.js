

var initAutocompleteStarted = false;
function initAutocomplete()
{

    if (window['google'] != undefined && !initAutocompleteStarted)
    {
      initAutocompleteStarted = true;
      trace('starting');
      var myOptions = {
        zoom: 5,
        center: new google.maps.LatLng(54.8, -4.6),
        mapTypeControl: false,
        panControl: false,
        zoomControl: false,
        streetViewControl: false
      };

      // Create the autocomplete object and associate it with the UI input control.
      var autocomplete = new google.maps.places.Autocomplete(
          document.getElementById('location'),
          myOptions
      );
    }
    else
    {
      setTimeout(function() {
        initAutocomplete();
      }, 500);
    }

  //google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);

}

registerInitFunction('initAutocomplete');

