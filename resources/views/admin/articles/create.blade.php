@extends('admin.layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>

    <div class="card-body">
    {!! Form::model($model,[
                     'action'=>'WebController\ArticleController@store',
                     'id'=>'myForm',
                     'method'=>'POST',
                     'files'=>true ,
                     'enctype' =>'multipart/form-data'
      ])!!}
 
      <div class="form-group">
        {!! Form::label('name' , trans('admin/articles/create.text_name')) !!}
         <span style="
        display: block;
        font-weight: bold;
        color: red;"
        >best title (max length 30 characters)
        </span>
        {!! Form::text('name' , old('name') , ['class' => 'form-control']) !!}
     </div>
     <div class="form-group">
      {!! Form::label('category_id' , trans('admin/articles/create.text_category_id')) !!}
      {!! Form::select('category_id' , [''=>trans('admin/articles/create.text_cat')] + $categories , old('category_id') , ['class' => 'form-control style-inp']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('content' , trans('admin/articles/create.text_content')) !!}
        {!! Form::textarea('content' , old('content') , ['class' => 'form-control' ,'id'=>'ckeditor' ]) !!}
      </div>
      <div class="form-group">
        {!! Form::label('pdf_file' , trans('admin/articles/create.text_pdf_file')) !!}
        {!! Form::file('pdf_file[]' , ['class' => 'form-control style-inp' ,'multiple'=>'multiple']) !!}
      </div>

      {{-- <div class="form-group">
        {!! Form::label('image' , trans('admin/articles/create.text_image')) !!}
        {!! Form::file('image' , ['class' => 'form-control style-inp']) !!}
      </div> --}}

      <div class="form-group">
        {!! Form::label('publish_date' , trans('admin/articles/create.text_publish_date')) !!}
        {!! Form::date('publish_date' , \Carbon\Carbon::now() , ['class' => 'form-control style-ar-date']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('status' , trans('admin/articles/create.text_status')) !!}

        {!! Form::select('status' , ['1'=>trans('admin/articles/create.text_published') , '0'=>trans('admin/articles/create.text_hidden')] , old('status') ,['class'=>"form-control style-inp"]) !!}
   
     </div>


     <div class="form-group">
      {!! Form::label('keywords' , trans('admin/articles/create.text_keywords')) !!}
      {!! Form::text('keywords' , old('keywords') , ['class' => 'form-control']) !!}
   </div>

   <div class="form-group">
    {!! Form::label('description' , trans('admin/articles/create.text_description')) !!}
    {!! Form::textarea('description' , old('description') , ['class' => 'form-control']) !!}
  </div>
    
      {!! Form::submit( trans('admin/articles/create.text_save') , ['class' => 'btn btn-primary']) !!}
      {!! Form::close() !!}
   </div>
    <!-- /.card-body -->
    
  </div>


   @push('ckeditor')
  
  <script src="{{ asset('adminlte/plugins/texteditor/ckeditor/ckeditor.js') }}"></script>
  <script>

    
            
          // if ($_SESSION['lang'] == 'ar') 
          //   {
          //   CKEDITOR.config.language = 'ar';
          //  }    
    //CKEDITOR.config.extraPlugins = 'exportpdf';
    CKEDITOR.config.language = 'ar';
    CKEDITOR.replace('ckeditor', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
  </script>
  @endpush 

  
@endsection

