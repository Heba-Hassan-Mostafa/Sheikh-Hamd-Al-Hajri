@extends('admin.layouts.admin')



@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>

    <div class="card-body">
    {!! Form::model($model,[
                     'action'=>['WebController\QuestionController@update' , $model->id],
                     'id'=>'myForm',
                     'method'=>'PUT',
                     'files'=>true ,
                     'enctype' =>'multipart/form-data'
      ])!!}
 
    <div class="form-group">
      {!! Form::label('from' , trans('admin/questions/index.text_from')) !!}
      <span class="client-name-ask"> {!! $name !!}</span>
    </div>

      <div class="form-group">
        {!! Form::label('fatwas_id' , trans('admin/questions/edit.text_fatwas_id')) !!}
        <span class="client-ask">{!! $fatwas !!}</span> 
     </div>

      <div class="form-group">
        {!! Form::label('answer' , trans('admin/questions/edit.text_answer')) !!}
        {!! Form::textarea('answer' , $model->answer , ['class' => 'form-control' ,'id'=>'ckeditor']) !!}
      </div>
    
     
      <div class="form-group">
        {!! Form::label('mp3File' , trans('admin/questions/edit.text_mp3File')) !!}
        {!! Form::file('mp3File' , ['class' => 'form-control style-inp']) !!}
        @if(!empty($model->mp3File))

        <audio src="{{ asset('/files/questions/audios/'.$model->mp3File) }}" controls></audio>  

        @else
        <span style="cursor: context-menu;color: red;"> {{ trans('admin/lectures/edit.text_no_audiofile')  }}  </span> 
        @endif
      </div>

      <div class="form-group">
        {!! Form::label('publish_date' , trans('admin/questions/edit.text_publish_date')) !!}
        {!! Form::date('publish_date' ,old('publish_date' , $model->publish_date) , ['class' => 'form-control style-ar-date']) !!}
      </div>


      {!! Form::submit( trans('admin/questions/edit.text_save') , ['class' => 'btn btn-primary']) !!}
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

