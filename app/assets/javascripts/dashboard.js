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
}

registerInitFunction(initDashboardPanel);