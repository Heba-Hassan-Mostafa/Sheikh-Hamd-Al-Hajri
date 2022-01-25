
//checkbox of yajra
function check_all()
{
    $('input[class="item_checkbox"]:checkbox').each(function(){
        if($('input[class="check_all"]:checkbox:checked').length == 0)
        {
            $(this).prop('checked',false);
        }else
        {
            $(this).prop('checked',true);
        }

    });
}

// delete all
function delete_all()
{
    $(document).on('click','.del_all', function(){

       $('#form_data').submit();
    });



    $(document).on('click','.delBtn', function(){
        var item_check = $('input[class="item_checkbox"]:checkbox').filter(':checked').length;
        if(item_check > 0)
        {
            $('.record_count').text(item_check);
            $('.not_empty_record').removeClass('hidden');
            $('.empty_record').addClass('hidden');

        }else
        {
            $('.record_count').text('');
            $('.not_empty_record').addClass('hidden');
            $('.empty_record').removeClass('hidden');

        }
       $('#multipleDelete').modal('show');

    });
}


$('#exampleModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body input').val(recipient)
  })


// $(document).ready(function(){


//     $(".waves-effect").click(function(){
//        $(".badge-warning").text("");
//     });
// });