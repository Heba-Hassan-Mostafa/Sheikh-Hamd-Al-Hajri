

$(function () {
    
    $("#alert-message").fadeTo(5000, 500).slideUp(500, function () {
        $('#alert-message').slideUp(500);
    });
});
$(document).ready(function(){

    

            $(".send-your-ask").on('click',function(e){

                if($(".prev-name").val() === "" ){
                    e.preventDefault();
                    $(".error-name").text("Name Field Is Required").css('color','red');
                }else if($(".prev-email").val() === "" ){
                    e.preventDefault();
                    $(".error-email").text("Email Field Is Required").css('color','red');
                }else if($(".prev-massage").val() === "" ){
                    e.preventDefault();
                    $(".error-massage").text("Text area Field Is Required").css('color','red');
                }else{
                    
                }
               });
          
    

    
});


// function downloadCounter()
//  {
//     // var currentValue = 0,
//     var count = $('.downloaders');
  
//   $(document).ready(function() {
//     count.each(function(i) {
//       $(this).addClass('' + (i += 1));
//     });
//   });
  
  
  
//   $('#download-numbers').on('click', function(e) {

//     var clickElement = $('.downloaders');
  
//     clickElement.html(parseInt(clickElement.html(), 10) + 1);


//   });
  
  
//   }
  
 
