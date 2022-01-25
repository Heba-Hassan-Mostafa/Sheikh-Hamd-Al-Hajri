
  <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_admin{{ $id }}">
    <i class="fa fa-trash"></i>  {{ trans('admin/template/common.text_delete') }}</button>

<!-- Modal -->
<div id="del_admin{{ $id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      {!! Form::open(['route'=>['video.destroy',$id],'method'=>'delete']) !!}

      <div class="modal-body">
        <h4>{{ trans('admin/videos/messages.text_delete_record') }}</h4>
      </div>

      <div class="modal-footer">
        {!! Form::submit(trans('admin/template/common.text_yes'),['class'=>'btn  btn-danger waves-effect']) !!}
        <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin/template/common.text_no') }}</button>
      </div>
      {!! Form::close() !!}
    </div>

  </div>
</div>
