//dashboard.js

function initDashboardPanel()
{

    $(document).on('click','.dashboard-dropdown-selected' ,function(){
        $('.dashboard-dropdown li:not(.selected)').slideToggle(200);
    } )

	$(document).on('click', '.dashboard-tab li', function(){
		/*$('li.selected').removeClass('selected');
		selected = $(this);
		var view = selected.data('view');
		selected.addClass('selected');
        //$('.dashboard-dropdown li:not(.selected)').hide();
		$('.dashboard-block').hide();
		$('#'+view).show();*/

        selectTab({'tab':$(this).data('view')});

	})

    /*$(document).on('click', '.dashboard-dropdown li:not(.selected)', function(){
        $('li.selected').removeClass('selected');
        selected = $(this);
        var clone = selected.clone();
        var view = selected.data('view');
        clone.addClass('selected');
        $('.dashboard-dropdown-selected').html(clone);
        $('.dashboard-dropdown li:not(.selected)').hide(0);
        $('.dashboard-block').hide();
        $('#'+view).show();

        selectTab({'tab':$(this).data('view')});

    })*/
	
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

    $('.btn-leave-session , .refund').click(function(){

        var url = $(this).attr('href');


        trace(url);
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(
            function(data) {
                trace(data);
                $('.mask').show();
                $('.container').append(data);
                initPut();
             }
        );

        return false;
    });

    /*$('#withdrawalform').on( 'submit', function() {

        var url = $(this).attr('action');
        trace('URL: '+url);
        $.ajax({
            url: url,
            type: 'GET',
            data: $( this ).serialize(),
            dataType: 'html'
        })
        .done(
            function(data) {
                trace('data: '+ data);
                $('.mask').show();
                $('.container').append(data);
                initPut();
             }
        );

        return false;
    });*/

}

registerInitFunction('initDashboardPanel');


registerInitFunction('updateCountryCode');
function updateCountryCode()
{
    $('.country_code').each(function(){
        var val = $(this).closest('div').find('.areacode').val();
        $(this).html(val);
    })

    $('.areacode').on('change', function () {
        $(this).closest('div').find('.country_code').html($(this).val());
        updateCountryCode();
    });
}

function openPopup(data)
{
    trace(data.popup, true);
    $('.mask').show();
    $('.container').append(data.popup);
    initPut();
}
function openConfirmPopup(data)
{
    trace(data.popup, true);
    $('.modal').remove();
    $('.mask').show();
    $('.container').append(data.popup);
    
    $('.close, .cancel').click(function(){
      $('.mask').hide();
      $('.modal').remove();
      trace(data.url);
       gotoUrl(data);
    });
}

function mailSent()
{
    trace('mail sent');
    $('.mask').hide();
    $('.login_wrap, .modal').remove();
}

function leftSession(data)
{
	trace('left session : '+(data.message));
	//$('.mask').hide();
	//$('.login_wrap, .modal').remove();
    setTimeout(function() {
        window.location.href = '';
    }, 1000);
}

function selectTab(params)
{
    defaultTab = $('.dashboard-tab li:first').data('view');

    selected = $('*[data-view="'+params.tab+'"]');
    selected = selected.length ? selected : $('*[data-view="'+defaultTab+'"]');
    //trace("selectTab: "+selected.data('view'));
    var view = selected.data('view');

    $('li.selected').removeClass('selected');
    selected.addClass('selected');
    $('.dashboard-block').hide();
    $('#'+view).show();
}
registerInitFunction('selectTab');

function confirmWithdrawal(data)
{
    trace("withdrawal successful : "+data.amount);
}
