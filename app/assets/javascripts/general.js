jQuery( document ).ready( function( $ ) {
	$('select').each(function(){
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
});