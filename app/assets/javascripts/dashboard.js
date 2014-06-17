//dashboard.js

function initDashboardPanel()
{

    $(document).on('click','.dashboard-dropdown-selected' ,function(){
        $('.dashboard-dropdown li:not(.selected)').slideToggle(200);
    } )

	$(document).on('click', '.dashboard-tab li', function(){
		$('li.selected').removeClass('selected');
		selected = $(this);
		var view = selected.data('view');
		selected.addClass('selected');
        //$('.dashboard-dropdown li:not(.selected)').hide();
		$('.dashboard-block').hide();
		$('#'+view).show();

	})

    $(document).on('click', '.dashboard-dropdown li:not(.selected)', function(){
        $('li.selected').removeClass('selected');
        selected = $(this);
        var clone = selected.clone();
        var view = selected.data('view');
        clone.addClass('selected');
        $('.dashboard-dropdown-selected').html(clone);
        $('.dashboard-dropdown li:not(.selected)').hide(0);
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