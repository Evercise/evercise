function MapWidgetInit() {
  trace('maps go');
  $(document).on('click', '#findLocation',function(){
    
    //var url = '/dev/widgets/postGeo';
    //var url = window.location.href;

   // url =  url.replace(url.substr(url.lastIndexOf('/') + 2), '')

    //url = url.split( '/' );

   // url = url+'/widgets/postGeo';

   //var host = window.location.hostname.port;
   //var pathname = window.location.pathname.split('/evercisegroups')[0];

   var pathname = (window.location.pathname.split('/dev/')).length > 1 ? '/dev' : '';

   if (pathname != '') {
     var url = pathname+'/widgets/postGeo';
   }else{
     var url = '/widgets/postGeo';
   }
  
   trace(url);

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
            trace('data');
            trace(data);
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

function DiscoverMapWidgetInit() {
  /* style the map  */

  //trace(laracasts.classes.evercisegroup);
  check = checkUrlForDev();
  var everciseGroups = JSON.parse($('#places').val());


  everciseGroups = everciseGroups.data;

  trace('DiscoverMapWidgetInit');
  trace(laracasts, true);
  if(!everciseGroups.length){
    $('#map-canvas').html('<h5>'+laracasts.zero_results+'</h5>');
  }else{


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
        }
    ];

    // set ap options  

    var mapOptions = {
      styles: styles,
      zoom: 10,
      maxZoom: 16,
      center: new google.maps.LatLng( 51.5143825, -0.11134839999999713),
      zoomControl: true,
      disableDefaultUI: true,
    };

    // set map 

    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    //set up marker




    // multiple markers
    var clusterStyles = [

      {
        textSize: '0',
        url: '/img/mapmarks_multi.png',
        height: 73,
        width: 48
      }
    ];

    var mcOptions = { 
      gridSize: 8,
      maxZoom: 15,
      zoom: 5,
      styles: clusterStyles
     };

    var markers = [];
    var bounds = new google.maps.LatLngBounds();
    var icon = '/img/mapmark.png';
    var infos = [];

    

    

    for (i = 0; i < everciseGroups.length; i++) { 
      var venue = everciseGroups[i].venue;
     // var category = everciseGroups[i].category;
      var sessions = everciseGroups[i].futuresessions;

      if (venue) {


        marker = new google.maps.Marker({
          position: new google.maps.LatLng(venue.lat, venue.lng),
          icon: icon,
          map: map
        });
        
        var latlng = new google.maps.LatLng(
                  parseFloat(venue.lat),
                  parseFloat(venue.lng));

        bounds.extend(latlng);
       
       var rating = 0;
       for (j = 0; j < everciseGroups[i].ratings.length; j++) {
          rating += everciseGroups[i].ratings[j].stars;
       }
       rating /= everciseGroups[i].ratings.length;
        
        //trace(i, true);
        var infowindow = new google.maps.InfoWindow({
          maxWidth: 280
        });
        var content = '<div class="info-window recommended-block"><div class="block-header"><a href="/evercisegroups/'+everciseGroups[i].id+'">'+everciseGroups[i].name+'</a></div><div class="recommended-info"><div class="recommended-aside"><p>'+getStars(rating)+'</p></div><div class="recommended-aside"><img class="date-icon" src="'+check+'/img/date_icon.png"><span>'+moment(sessions[0].date_time).format('DD MMM YYYY - hh:mma')+'</span></div></div><div class="block-footer"><span>price: &pound;'+everciseGroups[i].default_price+'<span></div></div>';

        google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
        return function() {
        
        /* close the previous info-window */
       closeInfos(infos);
        
           infowindow.setContent(content);
           infowindow.open(map,this);
           
        
        /* keep the handle, in order to close it on next click event */
       infos[0]=infowindow;
        
        };
      })(marker,content,infowindow)); 

        marker.set('content', content);
        markers.push(marker);
      }
      map.fitBounds(bounds);


      


    }

    var clusterWindow = new google.maps.InfoWindow({
      maxWidth: 320
    });
    var markerCluster = new MarkerClusterer(map, markers,mcOptions);

      google.maps.event.addListener(markerCluster, 'click', function(cluster) {
        //Get markers
          var markers = cluster.getMarkers(); 

          content = '';
          content+= '<div style="width:300px; height:140px;" class="cluster-wrap">';
          for(var i = 0; i < markers.length; i++) {
            content+= '<div class="cluster">';
            
            content+= markers[i].get('content');
            content+= '</div>';

            position = markers[i].getPosition();
          }
          content+= '</div>';

          // close the previous info-window 
          closeInfos(infos);
        
          trace(position , true);
          trace(cluster.getCenter() , true);

          map.setCenter(cluster.getCenter());
          map.setZoom(15);

          clusterWindow.setContent(content);
          clusterWindow.open(map,this);

          // keep the handle, in order to close it on next click event 
          infos[0]=clusterWindow;
          
      })
  }

}


function closeInfos(infos){
 
   if(infos.length > 0){
 
      /* detach the info-window from the marker ... undocumented in the API docs */
      infos[0].set("marker", null);
 
      /* and close it */
      infos[0].close();
 
      /* blank the array */
      infos.length = 0;
   }
}

function MapWidgetloadScript(params) {
  trace('MapWidgetloadScript');
  params = params ? params : 1;

  var func = 'MapWidgetInit';
  params = JSON.parse(params);

  if(typeof params.discover !== 'undefined')
  {
    trace('discover');
    func = 'DiscoverMapWidgetInit';
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=DiscoverMapWidgetInit&libraries=places';

    document.body.appendChild(script);
    var cluster = document.createElement('script');
    cluster.type = 'text/javascript';
    cluster.src = 'http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclustererplus/src/markerclusterer.js';
    document.body.appendChild(cluster);

  }
  else
  {
    trace('plot');
    func = 'MapWidgetInit';
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=MapWidgetInit&libraries=places';
    document.body.appendChild(script);

  }
  
}

//window.onload = MapWidgetloadScript;
// Initialised from general.js using laracast.

registerInitFunction('MapWidgetloadScript');

function InitSearchForm(){
   $(".search-form").submit(function(){
      var isFormValid = true;

      $("input").each(function(){
          if ($.trim($(this).val()).length == 0){
              $(this).addClass("highlight");
              $(this).val($(this).data('default'));
              isFormValid = true;
          }
          else{
              $(this).removeClass("highlight");
          }
      });

     // if (!isFormValid) alert("Please fill in all the required fields (indicated by *)");

      return isFormValid;
  });
 
}

registerInitFunction('InitSearchForm');

function getStars(rating)
{
  var returnHtml = '';
  for (var i = 0; i < 5; i++)
  {
    if(i < Math.floor(rating))
      returnHtml += '<img src="/img/yellow_star.png" class="star-icons" alt="stars">';
    else if(i < Math.ceil(rating))
      returnHtml += '<img src="/img/yellow_halfstar.png" class="star-icons" alt="stars">';
    else
      returnHtml += '<img src="/img/yellow_emptystar.png" class="star-icons" alt="stars">';
  }
  return returnHtml;
}