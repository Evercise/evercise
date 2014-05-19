function MapWidgetInit() {

  $(document).on('click', '#findLocation',function(){
    var url = '/widgets/postGeo';

    var data = {
          street: $('#street').val(),
          city: $('#city').val(),
          post_code: $('#postcode').val()
      }


      $.ajax({
          url: url,
          type: 'POST',
          data: data,
          dataType: 'json'
      })
      .done(
          function(data) { 
            debugOutput(data);
            $('#latbox').val(data.lat);
            $('#lngbox').val(data.lng);
            MapWidgetInit();
           }
      );
      return false;
  })

	/* style the map  */

	var styles = [  
		{  
		    featureType: 'water',  
		    elementType: 'geometry.fill',  
		    stylers: [  
		        { color: '#5bc0de' }  
		    ]  
		},{  
	        featureType: 'landscape.natural',  
	        elementType: 'all',  
	        stylers: [  
	            { hue: '#00a651' },  
	            { lightness: 0 }  
	        ]  
	    },{  
		    featureType: 'road',  
		    elementType: 'geometry',  
		    stylers: [  
		        { hue: '#ffd21e' },  
		        { lightness: 0 }  
		    ]  
		},{  
		    featureType: 'road.local',  
		    elementType: 'geometry',  
		    stylers: [  
		        { hue: '#ffd21e' },  
		        { saturation: 100 },  
		        { lightness: -40 }  
		    ]  
		}     
	];

  /* set lat and long  */

  // Added these defaults to stop errors. (TRIS)
  var latitude = 0;
  var longitude = 0;

  if ($('#latbox').val() != 0) {
  	latitude = $('#latbox').val();
    longitude = $('#lngbox').val();
  }
  else
  {
  	if(typeof laracasts !== 'undefined')
    {
        if(typeof laracasts.latitude !== 'undefined')
        {
        	var latitude = laracasts.latitude;
        }

        if(typeof laracasts.latitude !== 'undefined')
        {
        	var longitude = laracasts.longitude;
        }
    }
  	
  };
	
  var myLatLng = new google.maps.LatLng(latitude, longitude);

  if(document.getElementById("latbox"))
    document.getElementById("latbox").value = latitude;
  if(document.getElementById("lngbox"))
    document.getElementById("lngbox").value = longitude;

   // set ap options  

  var mapOptions = {
  	styles: styles,
    zoom: 14,
    center: new google.maps.LatLng(latitude, longitude),
    disableDefaultUI: true,
  };

  // set map 

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

   // add marker 

  var image = '/img/mapmark.png';
  var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      icon: image,
      draggable:true,
  });

  	

  google.maps.event.addListener(marker, 'dragend', function (event) {
    document.getElementById("latbox").value = this.getPosition().lat();
    document.getElementById("lngbox").value = this.getPosition().lng();
  });

}

function MapWidgetloadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
      'callback=MapWidgetInit';
  document.body.appendChild(script);
}

//window.onload = MapWidgetloadScript;
// Initialised from general.js using laracast.

registerInitFunction(MapWidgetloadScript);

