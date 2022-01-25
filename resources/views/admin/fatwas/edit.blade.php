@extends('admin.layouts.admin')



@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>

    <div class="card-body">
    {!! Form::model($model,[
                     'action'=>['WebController\FatwasController@update' , $model->id],
                     'id'=>'myForm',
                     'method'=>'PUT',
                     'files'=>true ,
                     'enctype' =>'multipart/form-data'
      ])!!}
 
    <div class="form-group">
      {!! Form::label('from' , trans('admin/questions/index.text_from')) !!}
      <span class="client-name-ask"> {!! $model->name !!}</span>
    </div>
      <div class="form-group">
        {!! Form::label('message' , trans('admin/questions/index.text_message')) !!}
         <span class="client-ask"> {!! $model->message !!}</span>
     </div>

      <div class="form-group">
        {!! Form::label('answer' , trans('admin/questions/index.text_answer')) !!}
        {!! Form::textarea('answer' , old('answer') , ['class' => 'form-control' ,'id'=>'ckeditor']) !!}
      </div>
    

      <div class="form-group">
        {!! Form::label('mp3File' , trans('admin/questions/index.text_mp3File')) !!}
        {!! Form::file('mp3File' , ['class' => 'form-control style-inp']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('publish_date' , trans('admin/questions/index.text_publish_date')) !!}
        {!! Form::date('publish_date' , \Carbon\Carbon::now() , ['class' => 'form-control style-ar-date']) !!}
      </div>


      {!! Form::submit( trans('admin/questions/index.text_save') , ['class' => 'btn btn-primary']) !!}
      {!! Form::close() !!}
   </div>
    <!-- /.card-body -->
    
  </div>

  
  @push('ckeditor')

  <script src="{{ asset('adminlte/plugins/texteditor/ckeditor/ckeditor.js') }}"></script>
  <script>
    CKEDITOR.config.language = 'ar';
    CKEDITOR.replace('ckeditor', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
  </script>
  @endpush 
  
@endsection

