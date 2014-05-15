//calendar.js

function calendarSlide () {

	// create a array to store scrolling posistions
	 
	class_top = new Array();
	class_height = new Array();
	class_id = new Array();
	
	// find top of each class and add it to the class top array
	// get the height of each class

    $('.hub-row').each(function(){
    	class_id.push($(this).data('id'));
    	class_top.push($(this).offset().top);
    	class_height.push($(this).height());
    })

    // set i
    var i = 0;
    var p = -1;

    mt = parseInt($('#calendar').css('marginTop'));
    topmt = mt;

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
            $('#evercisegroupId').val(class_id[0]);
            $('.hub-row').removeClass('selected');
    		$('div[data-id="'+class_id[0]+'"]').addClass('selected');
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
    		$('#evercisegroupId').val(class_id[i]);
    		$('.hub-row').removeClass('selected');
    		$('div[data-id="'+class_id[i]+'"]').addClass('selected');
    	}
    	else if( y < class_top[p] && p >= 0){

    		$('.hub-row').removeClass('selected');
    		$('div[data-id="'+class_id[p]+'"]').addClass('selected');
            $('#evercisegroupId').val(class_id[p]);
    		i--;
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


