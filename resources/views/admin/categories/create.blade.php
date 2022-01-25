@extends('admin.layouts.admin')


@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>

    <div class="card-body">
    {!! Form::model($model,[
                     'action'=>'WebController\CategoryController@store',
                     'id'=>'myForm',
                     'method'=>'POST'
      ])!!}
 
      <div class="form-group">
        {!! Form::label('name' , trans('admin/categories/create.text_name')) !!}
        {!! Form::text('name' , old('name') , ['class' => 'form-control']) !!}
     </div>

     <div class="form-group">
      {!! Form::label('status' , trans('admin/categories/create.text_status')) !!}
      {!! Form::select('status' , ['1'=>trans('admin/categories/create.text_published') , '0'=>trans('admin/categories/create.text_hidden')] , old('status') ,['class'=>"form-control style-inp"]) !!}

   </div>
   
     
      {!! Form::submit( trans('admin/categories/create.text_save') , ['class' => 'btn btn-primary']) !!}
      {!! Form::close() !!}
   </div>
    <!-- /.card-body -->
    
  </div>

  
@endsection

