//dashboard.js

function initDashboardPanel()
{
	$(document).on('click', '.trainer-dashboard-wrapper-left li', function(){
		$('li.selected').removeClass('selected');
		selected = $(this);
		var view = selected.data('view');
		selected.addClass('selected');
		$('.dashboard-block').hide();
		$('#'+view).show();

	})
	
    $('.mail_trainer').click(function(){

        var url = this.href;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(
            function(data) {
                //trace('id: '+ data);
                $('.mask').show();
                $('.container').append(data);
                initPut();
             }
        );

        return false;
    });
}

registerInitFunction(initDashboardPanel);

function mailSent()
{
	trace('mail sent');
	$('.mask').hide();
	$('.login_wrap, .modal').remove();
}