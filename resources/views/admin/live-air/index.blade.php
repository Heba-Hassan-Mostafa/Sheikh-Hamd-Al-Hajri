@extends('admin.layouts.admin') 

@section('content')

<div class="card">
    <div class="card-header">
      <h5 class="card-title">{{ $title }}</h5>
    </div>

    <!-- /.card-header -->
  <div class="card-body">

    {!! Form::model($model,[
        'action' => ['WebController\LiveController@update', $model->id],
        'method' => 'put'
        ]) !!}

    <div class="form-group">

       

    {!! Form::label('live_link' , trans('admin/live/index.text_youtubeLink')) !!}
    {!! Form::url('live_link' , $model->live_link , ['class' => 'form-control']) !!}
       
    <br>
    @php
    $url = getYoutubeId($model->live_link)
        
    @endphp
    @if($url)

    <iframe width="320" height="200"  src="https://www.youtube.com/embed/{{ $url }}" frameborder="0"  allowfullscreen>
    </iframe>

    @endif
   

  </div>

  {!! Form::submit( trans('admin/live/index.text_save') , ['class' => 'btn btn-primary']) !!}
  {!! Form::close() !!}
  </div>
</div>
@endsection