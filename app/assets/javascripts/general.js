function registerInitFunction(f)
{
  functionName = /\W*function\s+([\w\$]+)\(/.exec( f.toString() )[ 1 ];
  initFunctions.push({'name' : functionName, 'run' : f});
}


jQuery( document ).ready( function( $ ) {

    if(typeof laracasts !== 'undefined')
    {
      initFunctions.forEach(function(f) {
        console.log('function: '+f.name)
        //f.f();
        if(typeof laracasts[f.name] !== 'undefined')
        {
            f.run();
        }
      });
    }

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
    $(document).on('click','#cancel_login',function(){
        $('.mask').hide();
        $('.login_wrap, .modal').remove();
    })
    
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

    
});

function initSlider(sliderName)
{
  console.log("initSlider("+sliderName+")");
  if(typeof laracasts !== 'undefined')
  {
    if(typeof laracasts[sliderName] !== 'undefined')
    {
      sliderParams = JSON.parse(laracasts[sliderName]);

      $( "#"+sliderName+"-slider" ).slider({
        range: "min",
        min: sliderParams.min,
        max: sliderParams.max,
        step: sliderParams.step,
        value: sliderParams.value,
        slide: function( event, ui ) {
          $( "#"+sliderName+"" ).val( ui.value .toFixed(2) );
        }
      }); // end General slider

      $("#"+sliderName).keyup(function(){
          $( "#"+sliderName+"-slider" ).slider({ value: $(this).val() });
      })
    }
  }
}
registerInitFunction(initSlider);