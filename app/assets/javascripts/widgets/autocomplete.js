
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

var autoCompletesOnPage = 0;
function initAutocompleteCategory()
{
    var max_results = 8;

    trace('autocomplete-category');
    var categories = laracasts['initAutocompleteCategory']['list'];
    var force = laracasts['initAutocompleteCategory']['force'];
    trace(categories, true);

    $('.category').each(function(){
      autoCompletesOnPage++;
      $(this).data('num', autoCompletesOnPage);
    });

    var match = false;
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
        response(allmatches.slice(0, max_results));
      },
      select:function(){
        var firstinlist = $('#ui-id-'+$(this).data('num')+' a:first').html();
        if ( firstinlist != 'no matches') match = true;
      },
      close:function(){
        if(force)
        {
          if( $(this).val() !== '' && !match)
          {
            var firstinlist = $('#ui-id-'+$(this).data('num')+' a:first').html();
            if ( firstinlist == 'no matches') firstinlist = '';
            $(this).val( firstinlist );
          }
          match = false;
        }
      }
    });
}

registerInitFunction('initAutocompleteCategory');