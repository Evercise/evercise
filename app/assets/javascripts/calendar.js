//calendar.js

function calendarSlide () {

	// create a array to store scrolling posistions
	 
	class_top = new Array();
	class_height = new Array();
	class_id = new Array();
    class_name = new Array();
    class_duration = new Array();
	
	// find top of each class and add it to the class top array
	// get the height of each class

    $('.hub-row').each(function(){
    	class_id.push($(this).data('id'));
        class_name.push($(this).data('name'));
    	class_top.push($(this).offset().top);
    	class_height.push($(this).height());
        class_duration.push($(this).data('duration'));
    })

    // set i
    var i = 0;
    var p = -1;

    mt = parseInt($('#calendar').css('marginTop'));
    topmt = mt;
    bottom = parseInt(class_height[class_height.length - 1] + mt);

    trace(bottom);

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
            $('#evercisegroupName').val(class_name[0]);
            $('#evercisegroupDuration').val(class_duration[0]);
            $('.hub-row').removeClass('selected');
    		$('div[data-id="'+class_id[0]+'"]').addClass('selected');
    	} 
        else if( y > class_top[class_top.length - 1] ){
            trace('bottom');
            $('#calendar').css({
                marginTop: bottom+ 'px',
                '-webkit-transition': 'all 0.5s ease',
                '-moz-transition': 'all 0.5s ease',
                '-o-transition': 'all 0.5s ease',
                'transition': 'all 0.5s ease'
            });
            $('#evercisegroupId').val(class_id.length-1);
            $('#evercisegroupName').val(class_name.length-1);
            $('#evercisegroupDuration').val(class_duration.length-1);
            $('.hub-row').removeClass('selected');
            $('div[data-id="'+class_id[class_id.length-1]+'"]').addClass('selected');
        }
    	else if (y >= class_top[i] && y < class_top[class_top.length - 1] ) {
            trace('norm');
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
            $('#evercisegroupName').val(class_name[i]);
            $('#evercisegroupDuration').val(class_duration[i]);
    		$('.hub-row').removeClass('selected');
    		$('div[data-id="'+class_id[i]+'"]').addClass('selected');
    	}
    	else if( y < class_top[p] && p >= 0){

    		$('.hub-row').removeClass('selected');
    		$('div[data-id="'+class_id[p]+'"]').addClass('selected');
            $('#evercisegroupId').val(class_id[p]);
            $('#evercisegroupName').val(class_name[p]);
            $('#evercisegroupDuration').val(class_duration[p]);
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


