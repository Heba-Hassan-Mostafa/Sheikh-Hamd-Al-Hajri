
$(document).ready(function () {
    //Pagination numbers
    $('#paginationNumbers').DataTable({
      "pagingType": "numbers"
    });
    //add class active for nav list


    $(".nav-list ul li a").on('click',function () {
      $(this).addClass('active').parent().siblings().find('a').removeClass('active');
    });

    
    
  });
