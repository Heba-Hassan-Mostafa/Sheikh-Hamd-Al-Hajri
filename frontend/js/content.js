$(document).ready(function(){


    // display none if i will not use audio data
    var attr = $('.audio audio').attr('src')
    if (attr == '') {
      $(".audio").css("display","none")
    }

 // display none if i will not use audio youtube embed
    var attr = $('.audio-embed iframe').attr('src')
        if (attr == 'https://www.youtube.com/embed/') {
          $('.audio-embed').css('display', 'none')
        }
// display none if i will not use video youtube embed
    var attr = $('.video-embed iframe').attr('src')
            if (attr == 'https://www.youtube.com/embed/') {
            $('.video-embed').css('display', 'none')
            }
  // dropdown download for all pdf links
  $(".download .click-download").click(function(){
    $(".download .click-download li").toggle();
  });




  
  
});


 
