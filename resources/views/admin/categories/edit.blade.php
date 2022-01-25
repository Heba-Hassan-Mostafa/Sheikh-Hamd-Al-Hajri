
@extends('admin.layouts.admin')


@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>
    {{-- {!! Form::open(['url'=>adminUrl('user'),]) !!} --}}
    {!! Form::model($model,[
                     'action'=>['WebController\CategoryController@update' , $model->id],
                     'id'=>'myForm',
                     'method'=>'PUT'
      ])!!}
    <!-- /.card-header -->
    <div class="card-body">


      <div class="form-group">
        {!! Form::label('name' , trans('admin/categories/create.text_name')) !!}
        {!! Form::text('name' , $model->name , ['class' => 'form-control']) !!}
     </div>

     <div class="form-group">
      {!! Form::label('status' , trans('admin/categories/create.text_status')) !!}
      {!! Form::select('status' , ['1'=>trans('admin/categories/create.text_published') , '0'=>trans('admin/categories/create.text_hidden')] , old('status' ,$model->status) ,['class'=>"form-control style-inp"]) !!}

   </div>

   
    
      {!! Form::submit( trans('admin/categories/create.text_save') , ['class' => 'btn btn-primary']) !!}

   </div>
    <!-- /.card-body -->
    {!! Form::close() !!}
  </div>

@endsection

