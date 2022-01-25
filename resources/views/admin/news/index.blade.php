@extends('admin.layouts.admin') 

@section('content')

<div class="card">
    <div class="card-header">
      <h5 class="card-title">{{ $title }}</h5>
    </div>

    <!-- /.card-header -->
  <div class="card-body">

    {!! Form::model($model,[
        'action' => ['WebController\SheikhNewsController@update', $model->id],
        'method' => 'put'
        ]) !!}

    <div class="form-group">

    {!! Form::label('first_news' , trans('admin/news/index.text_first_news')) !!}
    {!! Form::text('first_news' , $model->first_news , ['class' => 'form-control']) !!}
  </div>


  
  <div class="form-group">

    {!! Form::label('second_news' , trans('admin/news/index.text_second_news')) !!}
    {!! Form::text('second_news' , $model->second_news , ['class' => 'form-control']) !!}
  </div>


  
  <div class="form-group">

    {!! Form::label('third_news' , trans('admin/news/index.text_third_news')) !!}
    {!! Form::text('third_news' , $model->third_news , ['class' => 'form-control']) !!}
  </div>

  {!! Form::submit( trans('admin/news/index.text_save') , ['class' => 'btn btn-primary']) !!}
  {!! Form::close() !!}
  </div>
</div>
@endsection