
// Use registerInitFunction() instead of document ready, either;
//    1) Specify the second parameter as true to run every time
//    2) flag which JS functions to run on each view from PHP as below:
//
// JavaScript::put(array('initSlider_price' =>  json_encode(array('name'=>'price', 'min'=>0, 'max'=>99, 'step'=>0.50, 'value'=>1))));
//
// The first paramenter should match the name of your
// Javascript function.  If a '_' is found, anything
// after this will be discarded.
// The second parameter should be a JSON encoded string
// of any parameters to pass to the JS function.

// Add functions to 'initFunctions' array, to be run on document ready
function registerInitFunction(functionName, always)
{
  //trace("register: "+always+' : '+f)
  //functionName = /\W*function\s+([\w\$]+)\(/.exec( f.toString() )[ 1 ];
  always = always || false;
  initFunctions.push({'name' : functionName, 'always' : always});
}

// Loop through Laracasts, and run the ones that match a registered function
jQuery( document ).ready( function( $ )
{
  var initLog = [];
  if(typeof laracasts !== 'undefined')
  {
    for(var l in laracasts){
       //trace('LARACASTS: '+l + ': ' + laracasts[l] + ': ' + initFunctions[l]);
       var name = l.split('_')[0];

       initFunctions.forEach(function(f) {
        if (f.name == name)
        {
           initLog.push('RUNNING: '+name+' : '+laracasts[l]);
           //f.run(laracasts[l]);
           window[f.name](laracasts[l]);
        }
      });
    }
  }
  // Loop through all registered init functions, and run the ones flagged 'always'
  initFunctions.forEach(function(f)
  {
    if(f.always)
    {
        //trace('ALWAYS: '+f.name);
        initLog.push("ALWAYS: "+f.name);
        //f.run(f.name);
        window[f.name]();
    }
  });
  trace(initLog, true);


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
});

function checkUrlForDev(){
  if(window.location.href.indexOf("dev") > -1) {
      // alert("your url contains the name dev");
      var check = '/dev';
  }else{
      var check = '';
  }
  return check;
}


function getView(url, callback)
{
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html'
    })
    .done(
        function(data) {
            callback(data);
         }
    );

    return false;
}


function trace(message, debug)
{
  if (debug == true)
  {
    console.log(arguments.callee.caller.name + ' => ');
    console.debug(message);
  }
  else
  {
    console.log(arguments.callee.caller.name + ' => ' + message);
  }
}

function initLoginBox()
{

  $(document).on('click','#cancel_login',function(){
      $('.mask').hide();
      $('.login_wrap, .modal').remove();
  })
  
  //$('input').keyup(function(){
  $(document).on('keyup','input', function(){
     $(this).removeClass('error');
     $(this).closest('div').find('.error-msg').fadeOut(200,function(){ $(this).closest('div').find('.error_msg').remove()});
  });

  $(document).on('click','#displayName', function(){
    $('#displayName-dropdown').toggle(100,function(){
      $(document).mouseup(function (e)
      {
        //trace('displayName click');
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
}
registerInitFunction('initLoginBox', true);

// jquery ui's tool tip for input fields

function initToolTip()
{
    $('.tooltip').each(function(){
      var info = $(this);
      info.tooltip({
          items: "[data-tooltip]",
          content: function () {
              return info.data("tooltip");
          }
      })
      .off( "mouseover" )
      .on( "click", function(){
          $( this ).tooltip( "open" );
          return false;
        })
      .attr( "title", "" ).css({ cursor: "pointer" });
     // $(this).tooltip('option', {disabled: false}).tooltip('open'); // uncomment for testing
    })

    
}

registerInitFunction('initToolTip');

// params: name, min, max, step, value,
// callback - a selector of a field to update with the value
function initSlider(params)
{
  sliderParams = JSON.parse(params);
  var sliderName = sliderParams.name;
  //trace("initSlider("+sliderName+") - callback:"+sliderParams.callback);
  $( "#"+sliderName+"-slider" ).slider({
    range: "min",
    min: sliderParams.min,
    max: sliderParams.max,
    step: sliderParams.step,
    value: sliderParams.value,
    format: sliderParams.format,

    slide: function( event, ui ) {

    if (ui.value % 1 != 0) {
      $( "#"+sliderName+"" ).val( ui.value .toFixed(2) );
    }else{
        $( "#"+sliderName+"" ).val( ui.value );
    };
      
      if (sliderParams.callback){
        window[sliderParams.callback]();
      } 
      //if (sliderParams.callback) $(sliderParams.callback).html(ui.value .toFixed(2) );
    }
  }); // end General slider

  $("#"+sliderName).keyup(function(){
    updateSlider(sliderName);
  });
  updateSlider(sliderName);
}
registerInitFunction('initSlider');

function updateSlider(sliderName)
{
  //trace("sliderName: "+sliderName +', value: '+ $("#"+sliderName).val());
  $( "#"+sliderName+"-slider" ).slider({ value: $("#"+sliderName).val() });
}


/* used for read more buttons */
function initReadMore()
{
  $(document).on('click', '.expand-wrapper', function(){
    $('.expand').toggle(300);
  })
}

registerInitFunction('initReadMore');


/* use for creating charts */
function initChart(params)
{

  try {
     params = JSON.parse(params);
     id = params.id;
     trace(params.id);
  } catch(error) {
     id = params;
  }

  var chart = $('#'+id);
  var total = parseInt(chart.data('total'));
  var fill = parseInt(chart.data('filled'));

  result = Math.ceil((fill*100)/ total);
  left = 100 - result;

  var data = [
    {
      value: result,
      color:"#ffd21e"
    },
    {
      value : left,
      color : "#ebebeb"
    }

  ];

  var options = 
    {
          percentageInnerCutout : 87,
          animationEasing       : 'easeInOutQuart',
          onAnimationComplete :  function(){ 
            $(chart).closest('div').find('.canvas-overlay').fadeIn(300);
          }
    };

  var myDoughnut = new Chart(chart.get(0).getContext("2d")).Doughnut(data, options);

  
}


registerInitFunction('initChart');

// edit form

// NOW gets the method from the form and sends via that method
function initPut (params) {

  if (params == null) {
      selector = '.create-form';
  }else{
      params = JSON.parse(params);
      selector = params.selector;
  }


  trace(selector, true);
  $( '.create-form, .update-form' ).on( 'submit', function() {

      loading();
      var method = ($(this).find('input').val() == 'PUT') ? 'PUT' : $(this).attr('method');
      var url = $(this).attr('action');
      trace('submitting via initPut. Method: '+ method+', url: '+url);

      $('.error-msg').remove();
      $('input').removeClass('error');
      // post to controller
      var form = $(this);
      form.find('.btn').addClass('disabled');
      $.ajax({
          url: url,
          type: method,
          data: $( this ).serialize(),
          dataType: 'json'
      })
      .done(
          function(data) {
              trace("initPut >> Sending data.....");
              loaded();
              if (data.validation_failed == 1)
              {
                  console.debug("failed: "+data);
                  form.find('.btn').removeClass('disabled');
                  // show validation errors
                  var arr = data.errors;
                  var scroll = false;
                  $.each(arr, function(index, value)
                  {
                      if (scroll == false) {
                          $('html, body').animate({ scrollTop: $("#" + index).offset().top }, 400);
                          scroll = true;
                      };
                      if (value.length != 0)
                      {
                        form.find("#" + index).addClass('error');
                        form.find("#" + index).after('<span class="error-msg">' + value + '</span>');
                         /*$("#" + index).addClass('error');
                         $("#" + index).after('<span class="error-msg">' + value + '</span>');
                         */
                      }
                  });
              }else{
                  // call back

                  var callback = data.callback;

                  window[callback](data, form);

              }
          }
      );

      return false;
  });
}

function gotoUrl(data)
{
  
  setTimeout(function() {
      window.location.href = data.url;
  }, 300);

}
function successAndRefresh(data, form)
{
  form.find('.success_msg').show();
  setTimeout(function() {
      window.location.href = '';
  }, 300);
}
function fail(data, form)
{
  setTimeout(function() {
      window.location.href = './';
  }, 300);
}

registerInitFunction('initPut');

function initPlayVideo(){ 
  $(".play-button").click(function(e){
        var url = this.href;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(
            function(data) { 
                $('.mask').show();
               $('.lower_footer').append(data);
               videoControl();
             }
        );
        return false;
    });


  /*$(document).on('click', '.play-button' , function(){
    $(this).fadeToggle(600 ,function(){
      $('.video').fadeToggle(600).delay(100).get(0).play();
    })
  })*/
    
}

registerInitFunction('initPlayVideo');

function videoControl(){
  $('.video').get(0).play();
}

function initSwitchView(){
    $(document).on('click','.icon-btn', function(){
        $('.icon-btn').removeClass('selected');
        $(this).addClass('selected');
        var view = $(this).data('view');
        $('.tab-view').removeClass('selected');
        $('#'+view).addClass('selected');

    })
}

registerInitFunction('initSwitchView');

function InitAccordian(){
  $(document).on('click', '.tab-header', function(){
    var tab = $(this).data('tab');

    if ($(this).hasClass('selected') ) {
      $(this).removeClass('selected');
      $('#'+tab).slideUp(500);
      $('#'+tab).removeClass('selected');
    }else{
      $('.tab-header').removeClass('selected');
      $(this).addClass('selected');
      $('.tab-body.selected').slideUp(500);
      $('#'+tab).slideDown(500);
      $('.tab-body').removeClass('selected');
      $('#'+tab).addClass('selected');
    
    };
    
  })
}

registerInitFunction('InitAccordian');


function initScrollAnchor(string) {

  var locationPath = filterPath(location.pathname);

  var sticky_header = 0;

  if ($('.sticky-header')) {
    sticky_header = $('.sticky-header').height();
  };
  
  $('a[href*=#]').each(function() {
    var thisPath = filterPath(this.pathname) || locationPath;
    if (  locationPath == thisPath
    && (location.hostname == this.hostname || !this.hostname)
    && this.hash.replace(/#/,'') ) {
      var $target = $(this.hash), target = this.hash;
      
      if (target) {
        var targetOffset = ($target.offset().top - sticky_header) - sticky_header;
        //targetOffset = (targetOffset - sticky_header)- sticky_header;
        $(this).click(function(event) {
          event.preventDefault();
          $('html, body').animate({scrollTop: targetOffset}, 400, function() {
            location.hash = target;
          });
        });
      }
    }
  });
}

registerInitFunction('initScrollAnchor');

function filterPath(string) {
  return string
    .replace(/^\//,'')
    .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
    .replace(/\/$/,'');
}


function initStickHeader(){
  var target = $('.sticky-header');
  var targetOffset = target.offset().top;
  var width = target.width();
  $(window).scroll(function(){
      if ($(window).scrollTop() >= targetOffset) {
         $('.sticky-header').addClass('fixed').css({
          'width': width+'px'
         });
      }
      else {
         $('.sticky-header').removeClass('fixed');
      }
  });
}

registerInitFunction('initStickHeader');

function refreshpage(){
  setTimeout(function() {
    window.location.href = '';
  }, 10);
}

function sendhome(data){
  trace(data.message);
  setTimeout(function() {
    window.location.href = '/';
  }, 1000);
}

function loading(){
  $('.mask').show();
  check = checkUrlForDev();
  $('html').append('<img src="'+check+'/img/e-circle-loading-yellow-on-black.gif" class="loading_circle">');
}


function loaded(){
  $('.mask').hide();
  $('.modal').remove();
  $('.loading_circle').remove();
}