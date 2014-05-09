function initialize() {

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
		    elementType: 'all',  
		    stylers: [  
		        { hue: '#ffd21e' },  
		        { saturation: 100 },  
		        { lightness: -40 }  
		    ]  
		}     
	];

  /* set lat and long  */
	
  var myLatLng = new google.maps.LatLng(-33.890542, 151.274856);

  /* set ap options  */

  var mapOptions = {
  	styles: styles,
    zoom: 10,
    center: new google.maps.LatLng(-33.890542, 151.274856)
  };

  /*set map */

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  /* add marker */

  var image = '/img/mapmark.png';
  var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      icon: image,
      draggable:true,
  });

  google.maps.event.addListener(marker, 'dragend', function (event) {
  	console.log( this.getPosition().lat());
    //document.getElementById("latbox").value = this.getPosition().lat();
    //document.getElementById("lngbox").value = this.getPosition().lng();
  });

}

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
      'callback=initialize';
  document.body.appendChild(script);
}

window.onload = loadScript;