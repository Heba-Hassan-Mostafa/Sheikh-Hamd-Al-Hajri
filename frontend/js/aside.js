$(document).ready(function (){

    $(".more-topics ul li").on('click',function () {
      $(this).addClass('active').siblings().removeClass('active');
      $(".more-vistors , .more-downloads").hide();
      $($(this).data('content')).fadeIn(1000).css("display","flex");
    });
  
  });