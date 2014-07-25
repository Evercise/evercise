
var initAutocompleteStarted = false;
function initAutocompleteLocation()
{
    trace('autocomplete-location');




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
        initAutocompleteLocation();
      }, 500);
    }

  //google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);

}

registerInitFunction('initAutocompleteLocation');


function initAutocompleteCategory()
{
    trace('autocomplete-category');
    var categories = laracasts['initAutocompleteCategory']['list'];
    var force = laracasts['initAutocompleteCategory']['force'];
    trace(categories, true);

    $('.category').autocomplete({
      source: function( request, response )
      {
        // Array of matches starting with typed query
        var matches = $.map( categories, function(c)
        {
          if ( c.toUpperCase().indexOf(request.term.toUpperCase()) === 0 ) {
            return c;
          }
        });
        //response(matches);
        // Array of the rest of them
        var notsomuches = $.map( categories, function(c)
        {
          if ( c.toUpperCase().indexOf(request.term.toUpperCase()) > 0 ) {
            return c;
          }
        });
        var allmatches = matches.concat(notsomuches);
        if(force)
          if (allmatches.length == 0) allmatches = ['no matches'];
        response(allmatches);
      },
      close:function(){
        if(force)
        {
          if( $('#category').val() !== '' )
          {
            var firstinlist = $('.ui-autocomplete:first a:first').html();
            if ( firstinlist == 'no matches') firstinlist = '';
            $('#category').val( firstinlist );
          }
        }
      }
    });
}

registerInitFunction('initAutocompleteCategory');