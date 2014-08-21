function initPlayVideo(){ 
  $("#playButton").click(function(e){
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


    
}

registerInitFunction('initPlayVideo');

/***
* auto play the video
***/

function videoControl(){
  $('.video').get(0).play();
}