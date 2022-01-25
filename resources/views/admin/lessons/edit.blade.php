@extends('admin.layouts.admin')



@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>

    <div class="card-body">
    {!! Form::model($model,[
                     'action'=>['WebController\LessonController@update' , $model->id],
                     'id'=>'myForm',
                     'method'=>'PUT',
                     'files'=>true ,
                     'enctype' =>'multipart/form-data'
      ])!!}
 
      <div class="form-group">
        {!! Form::label('name' , trans('admin/lessons/create.text_name')) !!}
        <span style="
        display: block;
        font-weight: bold;
        color: red;"
        >best title (max length 30 characters)
        </span>
        {!! Form::text('name' , old('name') , ['class' => 'form-control']) !!}
     </div>
     <div class="form-group">
      {!! Form::label('category_id' , trans('admin/lessons/create.text_category_id')) !!}
      {!! Form::select('category_id' ,[''=>trans('admin/lessons/create.text_cat')] + $category , old('category_id',$model->category_id) , ['class' => 'form-control style-inp']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('content' , trans('admin/lessons/create.text_content')) !!}
        {!! Form::textarea('content' , old('content') , ['class' => 'form-control' ,'id'=>'ckeditor']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('pdf_file' , trans('admin/lessons/create.text_pdf_file')) !!}
        {!! Form::file('pdf_file[]' ,  ['class' => 'form-control style-inp', 'multiple'=>'multiple']) !!}
        
        <ul style="list-style: none ; padding:0">
          @if(!empty($model->pdf_file))

          @foreach (json_decode($model->pdf_file) as $file)

          <li>
            <i class="fas fa-file-pdf" style="color:#ce0000"></i>
            <a href="{{ asset('/files/lessons/'.$file) }}">{{ $file }}</a>
          </li> 
          @endforeach
          @else
          <li style="cursor: context-menu;color: red;"> {{ trans('admin/lessons/edit.text_no_files')  }}</li>
          @endif
        </ul>
      </div>
     
      <div class="form-group">
        {!! Form::label('publish_date' , trans('admin/lessons/create.text_publish_date')) !!}
        {!! Form::date('publish_date' , old('publish_date' , $model->publish_date), ['class' => 'form-control style-ar-date']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('status' , trans('admin/lessons/create.text_status')) !!}
        {!! Form::select('status' , ['1'=>trans('admin/lessons/create.text_published') , '0'=>trans('admin/lessons/create.text_hidden')] , old('status',$model->status) ,['class'=>"form-control style-inp"]) !!}

     </div>
    
      <div class="form-group">

          @foreach ($model->videos as $video)
              
        
        {!! Form::label('youtubeLink' , trans('admin/lessons/create.text_youtubeLink')) !!}
        {!! Form::url('youtubeLink' , $video->youtubeLink , ['class' => 'form-control']) !!}
   
        <br>
        @php
        $url = getYoutubeId($video->youtubeLink)
            
        @endphp
        @if($url)

        <iframe width="320" height="200"  src="https://www.youtube.com/embed/{{ $url }}" frameborder="0"  allowfullscreen>
        </iframe>

        @endif
        @endforeach
                   
      </div>

     
      <div class="form-group">

        @foreach ($model->audios as $audio)

        {!! Form::label('audioFile' , trans('admin/lessons/create.text_audioFile')) !!}
        {!! Form::file('audioFile' ,  ['class' => 'form-control style-inp']) !!}
       
       @if(!empty($audio->audioFile))
    
        <audio src="{{ asset('/files/audios/'.$audio->audioFile) }}" controls></audio>
        @else
        <span style="cursor: context-menu;color: red;">  {{ trans('admin/lessons/edit.text_no_audiofile')  }} </span>

       
     @endif
     @endforeach
     
      </div>

      <div class="form-group">

          @foreach ($model->audios as $audio)
              
        
        {!! Form::label('embedLink' , trans('admin/lessons/create.text_embedLink')) !!}
        {!! Form::url('embedLink' , $audio->embedLink , ['class' => 'form-control']) !!}
   
        <br>
        @php
        $url = getYoutubeId($audio->embedLink)
            
        @endphp
        @if($url)

        <iframe width="320" height="200" src="https://www.youtube.com/embed/{{ $url }}" frameborder="0"  allowfullscreen>
        </iframe>

        @endif
        @endforeach
                   
      </div>

      <div class="form-group">
        {!! Form::label('keywords' , trans('admin/lessons/create.text_keywords')) !!}
        {!! Form::text('keywords' , old('keywords', $model->keywords) , ['class' => 'form-control']) !!}
     </div>
  
     <div class="form-group">
      {!! Form::label('description' , trans('admin/lessons/create.text_description')) !!}
      {!! Form::textarea('description' , old('description', $model->description) , ['class' => 'form-control']) !!}
    </div>
     
      {!! Form::submit( trans('admin/lessons/create.text_save') , ['class' => 'btn btn-primary']) !!}
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

