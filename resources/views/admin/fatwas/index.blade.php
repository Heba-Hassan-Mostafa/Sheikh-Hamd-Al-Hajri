@extends('admin.layouts.admin')


@section('content')


  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
  <div class="card">
      <div class="card-header">
        <h5 class="card-title">{{ $title }}</h5>
      </div>
      <!-- /.card-header -->
      
      <div class="card-body table-responsive" style="text-align:center;">
      {!! Form::open(['id'=>'form_data' , 'url'=> adminUrl('fatwas/destroy/all') , 'method'=>'delete']) !!}
      
             

              {!! $dataTable->table(['style'=>"width:100%",
                'class' => ' table table-bordered table-condensed table-striped'],true) !!}

          {!! Form::close() !!}
      </div>
      <!-- /.card-body -->
    </div>
      </div>
    </div>
  </div>
  
   

<!-- Modal -->
<div class="modal fade" id="multipleDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ trans('admin/template/common.modal_delete') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="alert alert-danger">
        <div class="empty_record hidden">
        	<h5>{{ trans('admin/template/common.check_record') }} </h5>
        	</div>
        	<div class="not_empty_record hidden" >
        	<h5>{{ trans('admin/template/common.ask_delete') }} <span class="record_count"></span> {{ trans('admin/template/common.ques_mark')}} </h5>
        	</div>
      </div>
      <div class="modal-footer">
        <div class="empty_record hidden">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin/template/common.text_close')  }}</button>
          </div>
          <div class="not_empty_record hidden">
            <input type="submit"  value="{{ trans('admin/template/common.text_yes') }}" onsubmit="" class="btn btn-danger del_all" />
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin/template/common.text_no') }}</button>
           
            </div>
       
      </div>
    </div>
  </div> 
</div>


@push('js')

<script>
 // fun in myedit.js
 delete_all(); 
 </script>
 {{ $dataTable->scripts() }}

 @endpush

@endsection