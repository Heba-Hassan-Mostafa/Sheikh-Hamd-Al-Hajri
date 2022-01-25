


<div class="custom-control custom-switch">
 

    <input type="checkbox" class="custom-control-input" id="{{ $id }}" data-id="{{  $id }}" {{ $status == true ? 'checked' : '' }}>
    <label class="custom-control-label" for="{{  $id }}"></label> 
    

  </div>

  <script>

    $(function() {
  
      $('.custom-control-input').on('change',function() {
  
          var status = $(this).prop('checked') == true ? 1 : 0; 
  
          var id = $(this).data('id'); 
           console.log(status);
  
          $.ajax({
  
              type: "GET",
  
              dataType: "json",
  
              url: '{{ route("fatwas/change") }}',
  
              data: {'status': status, 'id': id},
  
              success: function(data){
  
                console.log(data.success)
  
              }
  
          });
  
      })
  
    })
  
  </script>
  