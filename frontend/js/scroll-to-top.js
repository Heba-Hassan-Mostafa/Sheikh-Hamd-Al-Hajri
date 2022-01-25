$(document).ready(function () {
  // scrollUp
  $(window).scroll(function () {
    var scrollup = $(".scrollup");
    if ($(window).scrollTop() > 700) {
      scrollup.fadeIn();
    } else {
      scrollup.fadeOut();
    }
  });

  $(".scrollup").on("click", function (e) {
    e.preventDefault();
    $("html , body").animate(
      {
        scrollTop: 0,
      },
      1000
    );
  });
});
