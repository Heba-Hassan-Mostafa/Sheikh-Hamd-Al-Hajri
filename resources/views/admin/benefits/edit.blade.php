@extends('admin.layouts.admin')



@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>

    <div class="card-body">
    {!! Form::model($model,[
                     'action'=>['WebController\ReligiousBenefitsController@update' , $model->id],
                     'id'=>'myForm',
                     'method'=>'PUT',
                     
      ])!!}
 
      <div class="form-group">
        {!! Form::label('name' , trans('admin/benefits/create.text_name')) !!}
        <span style="
        display: block;
        font-weight: bold;
        color: red;"
        >best title (max length 30 characters)
        </span>
        {!! Form::text('name' , old('name' , $model->name) , ['class' => 'form-control']) !!}
     </div>
     <div class="form-group">
      {!! Form::label('category_id' , trans('admin/benefits/create.text_category_id')) !!}
       
      {!! Form::select('category_id' , [''=>trans('admin/benefits/create.text_cat')] + $category,old('category_id' , $model->category_id), ['class' => 'form-control style-inp']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('content' , trans('admin/benefits/create.text_content')) !!}
        {!! Form::textarea('content' , old('content' , $model->content) , ['class' => 'form-control' ,'id'=>'ckeditor']) !!}
      </div>
     
      <div class="form-group">
        {!! Form::label('publish_date' , trans('admin/benefits/create.text_publish_date')) !!}
        {!! Form::date('publish_date' , old('publish_date' , $model->publish_date), ['class' => 'form-control style-ar-date']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('status' , trans('admin/benefits/create.text_status')) !!}
        {!! Form::select('status' , ['1'=>trans('admin/benefits/create.text_published') , '0'=>trans('admin/benefits/create.text_hidden')] , old('status', $model->status) ,['class'=>"form-control style-inp"]) !!}

     </div>
     
     
     <div class="form-group">
      {!! Form::label('keywords' , trans('admin/benefits/create.text_keywords')) !!}
      {!! Form::text('keywords' , old('keywords', $model->keywords) , ['class' => 'form-control']) !!}
   </div>

   <div class="form-group">
    {!! Form::label('description' , trans('admin/benefits/create.text_description')) !!}
    {!! Form::textarea('description' , old('description', $model->description) , ['class' => 'form-control']) !!}
  </div>

      {!! Form::submit( trans('admin/benefits/create.text_save') , ['class' => 'btn btn-primary']) !!}
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

