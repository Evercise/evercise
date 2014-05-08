jQuery( document ).ready( function( $ ) {
/*	$('select').each(function(){
        var title = $(this).attr('title');
      	if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
        w = $(this).width();
        $(this)
        .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
        .after('<span class="drop_down" style="width:'+w+'px;">' + title + '</span>')
        .change(function(){
         val = $('option:selected',this).text();
        	$(this).next().text(val);
    	})
    });
*/
    $('input').keyup(function(){
       $(this).removeClass('error');
       $(this).closest('div').find('.error-msg').fadeOut(200,function(){ $(this).closest('div').find('.error_msg').remove()});
    });

    $(document).on('click','#displayName', function(){
      $('#displayName-dropdown').toggle(100,function(){
        $(document).mouseup(function (e)
        {
            var container = $('#displayName-dropdown');
            var link = $('#displayName');

            if (!container.is(e.target) && !link.is(e.target) && container.has(e.target).length === 0) 
            {
                container.hide(100);
            }
        });
      })
    })

    setTimeout(function() {
      $('.top-msg').fadeOut(500);
    }, 5000);

    /* sliders */

    $( "#price-slider" ).slider({
      range: "min",
      min: 1,
      max: 120,
      step: 0.50,
      value: 1,
      slide: function( event, ui ) {
        $( "#price" ).val( ui.value .toFixed(2) );
      }
    }); // end pricee slider

    $('#price').keyup(function(){
        $( "#price-slider" ).slider({ value: $(this).val() });
    })

    $( "#maxsize-slider" ).slider({
      range: "min",
      min: 1,
      max: 30,
      step: 1,
      value: 1,
      slide: function( event, ui ) {
        $( "#maxsize" ).val( ui.value );
      }
    }); // end pricee slider

    $('#maxsize').keyup(function(){
        $( "#maxsize-slider" ).slider({ value: $(this).val() });
    })

    $( "#duration-slider" ).slider({
      range: "min",
      min: 0,
      max: 240,
      step: 10,
      value: 0,
      slide: function( event, ui ) {
        $( "#duration" ).val( ui.value );
      }
    }); // end pricee slider

    $('#duration').keyup(function(){
        $( "#duration-slider" ).slider({ value: $(this).val() });
    })

});