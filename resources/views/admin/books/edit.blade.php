@extends('admin.layouts.admin')



@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>

    <div class="card-body">
    {!! Form::model($model,[
                     'action'=>['WebController\BookController@update' , $model->id],
                     'id'=>'myForm',
                     'method'=>'PUT',
                     'files'=>true ,
                     'enctype' =>'multipart/form-data'
      ])!!}
 
      <div class="form-group">
        {!! Form::label('name' , trans('admin/books/create.text_name')) !!}
         <span style="
        display: block;
        font-weight: bold;
        color: red;"
        >best title (max length 30 characters)
        </span>
        {!! Form::text('name' , old('name' , $model->name) , ['class' => 'form-control']) !!}
     </div>
     <div class="form-group">
      {!! Form::label('category_id' , trans('admin/books/create.text_category_id')) !!}
      {!! Form::select('category_id' , [''=>trans('admin/books/create.text_cat')] + $category,old('category_id' , $model->category_id), ['class' => 'form-control style-inp']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('note' , trans('admin/books/create.text_note')) !!}
        {!! Form::text('note' , old('note') , ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('pdf_file' , trans('admin/books/create.text_pdf_file')) !!}
        {!! Form::file('pdf_file[]' ,  ['class' => 'form-control style-inp', 'multiple'=>'multiple']) !!}
        
      
        <ul style="list-style: none ; padding:0">
          @if(!empty($model->pdf_file))

         
          @foreach (json_decode($model->pdf_file) as $file)
          <li>
            <i class="fas fa-file-pdf" style="color:#ce0000"></i>
            <a href="{{ asset('/files/books/'.$file) }}">{{ $file }}</a>
          </li> 
          @endforeach
          @else
          <li style="cursor: context-menu;color: red;"> {{ trans('admin/books/edit.text_no_files')  }}  </li>
          @endif
        </ul>
      </div>

      <div class="form-group">
        {!! Form::label('image' , trans('admin/books/create.text_image')) !!}
        {!! Form::file('image' , ['class' => 'form-control style-inp']) !!}
       
        @if(!empty($model->image))
        <img src="{{ asset('/files/books/images/'.$model->image) }}" style="width:100px;height: 100px;" />
       @endif
      </div>
     
     
      <div class="form-group">
        {!! Form::label('publish_date' , trans('admin/books/create.text_publish_date')) !!}
        {!! Form::date('publish_date' , old('publish_date',$model->publish_date ), ['class' => 'form-control style-ar-date']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('status' , trans('admin/books/create.text_status')) !!}
        {!! Form::select('status' , ['1'=>trans('admin/books/create.text_published') , '0'=>trans('admin/books/create.text_hidden')] , old('status', $model->status) ,['class'=>"form-control style-inp"]) !!}

     </div>

     <div class="form-group">
      {!! Form::label('keywords' , trans('admin/books/create.text_keywords')) !!}
      {!! Form::text('keywords' , old('keywords', $model->keywords) , ['class' => 'form-control']) !!}
   </div>

   <div class="form-group">
    {!! Form::label('description' , trans('admin/books/create.text_description')) !!}
    {!! Form::textarea('description' , old('description', $model->description) , ['class' => 'form-control']) !!}
  </div>
     
     
      {!! Form::submit( trans('admin/books/create.text_save') , ['class' => 'btn btn-primary']) !!}
      {!! Form::close() !!}
   </div>
    <!-- /.card-body -->
    
  </div>

 
@endsection

