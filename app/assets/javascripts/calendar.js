//Users.js
jQuery( document ).ready( function( $ ) {

    /*$('#calendar a').click(function(){
        console.log(this.id);
    });*/

});


function calendarSlide () {

	// create a array to store scrolling posistions
	 
	class_top = new Array();
	class_bottom = new Array();
	class_height = new Array();
	
	// find top of each class and add it to the class top array
	// get the height of each class

    $('.hub-row').each(function(){
    	class_top.push($(this).offset().top);
    	class_height.push($(this).height());
    })

    // set i
    var i = 0;
    var p = -1;

    mt = parseInt($('#calendar').css('marginTop'));
    topmt = mt;

    bottom = $('html').height();

    // get window position

    $(window).scroll(function(evt) {

    	var y = $(this).scrollTop();
    	if( y == 0 ){
    		$('#calendar').css({
        		marginTop: topmt+ 'px',
        		'-webkit-transition': 'all 0.5s ease',
        		'-moz-transition': 'all 0.5s ease',
        		'-o-transition': 'all 0.5s ease',
        		'transition': 'all 0.5s ease'
            });
    	} else if( y == bottom ){
    		$('#calendar').css({
        		marginTop: '37px',
        		'-webkit-transition': 'all 0.5s ease',
        		'-moz-transition': 'all 0.5s ease',
        		'-o-transition': 'all 0.5s ease',
        		'transition': 'all 0.5s ease'
            });
    	} 


    	else if (y >= class_top[i] ) {
    		mt = parseInt(mt + class_height[i]);
    		
    		$('#calendar').css({
        		marginTop: mt+'px',
        		'-webkit-transition': 'all 0.5s ease',
        		'-moz-transition': 'all 0.5s ease',
        		'-o-transition': 'all 0.5s ease',
        		'transition': 'all 0.5s ease'
            });
    		i++;
    		p++;
    	}
    	else if( y < class_top[p] && p >= 0){
    		i--;
    		//mt = parseInt($('#calendar').css('marginTop'));
    		mt = parseInt(mt - class_height[i]);
    		$('#calendar').css({
        		marginTop: mt+'px',
        		'-webkit-transition': 'all 0.5s ease',
        		'-moz-transition': 'all 0.5s ease',
        		'-o-transition': 'all 0.5s ease',
        		'transition': 'all 0.5s ease'
            });
            p--;
    	};
    });
   
}

registerInitFunction(calendarSlide);


