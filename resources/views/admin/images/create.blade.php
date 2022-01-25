@extends('admin.layouts.admin')


@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>

    <div class="card-body">
    {!! Form::model($model,[
                     'action'=>'WebController\SliderImageController@store',
                     'id'=>'myForm',
                     'method'=>'POST',
                     'files'=>true ,
                     'enctype' =>'multipart/form-data'
      ])!!}
 
      <div class="form-group">
        {!! Form::label('title' , trans('admin/images/create.text_title')) !!}
        {!! Form::text('title' , old('title') , ['class' => 'form-control']) !!}
     </div>

     <div class="form-group">
      {!! Form::label('image' , trans('admin/images/create.text_image')) !!}
      <span style="color:red;display:block;font-weight:bold;margin-bottom:5px"> Requirment : (width:1200px) x (height:400px) </span>

      {!! Form::file('image', ['class' => 'form-control style-inp']) !!}    
      </div>

      <div class="form-group">
        {!! Form::label('link' , trans('admin/images/create.text_link')) !!}
        {!! Form::url('link', old('link'), ['class' => 'form-control']) !!}    
        </div>

     
      {!! Form::submit( trans('admin/images/create.text_save') , ['class' => 'btn btn-primary']) !!}
      {!! Form::close() !!}
   </div>
    <!-- /.card-body -->
    
  </div>

  
@endsection

