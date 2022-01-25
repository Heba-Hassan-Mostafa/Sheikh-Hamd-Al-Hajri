@extends('admin.layouts.admin')


@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>

    {!! Form::open([
        'action'=>'WebController\UserController@update_info',
        'id'=>'myForm',
        'method'=>'POST',
        'files'=>true ,
        'enctype' =>'multipart/form-data'
])!!}


<div class="card-body">


    <div class="form-group">
      {!! Form::label('name' , trans('admin/users/create.text_name')) !!}
      {!! Form::text('name' , old('name' , Auth::user()->name) , ['class' => 'form-control']) !!}
      @error('name')<span class="text-danger">{{ $message }}</span>@enderror
   </div>
   <div class="form-group">
      {!! Form::label('email' , trans('admin/users/create.text_email')) !!}
      {!! Form::email('email' , old('email',Auth::user()->email ) , ['class' => 'form-control']) !!}
      @error('email')<span class="text-danger">{{ $message }}</span>@enderror
   </div>
   <div class="form-group">
    {!! Form::label('mobile', trans('admin/users/info.mobile')) !!}
    {!! Form::text('mobile', old('mobile', Auth::user()->mobile), ['class' => 'form-control']) !!}
    @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
</div>
   {{-- <div class="form-group">
    {!! Form::label('receive_email' , trans('admin/users/info.receive_email')) !!}
    {!! Form::select('receive_email' , ['1' =>trans('admin/users/info.yes') , '0'=>trans('admin/users/info.no') ],
      old('receive_email' , Auth::user()->receive_email) , ['class' => 'form-control']) !!}
        @error('receive_email')<span class="text-danger">{{ $message }}</span>@enderror
 </div> --}}
 
 
   <div class="form-group">
    {!! Form::label('image' , trans('admin/users/info.text_image')) !!}
    {!! Form::file('image', ['class' => 'form-control style-inp']) !!} 
    @error('image')<span class="text-danger">{{ $message }}</span>@enderror   
    </div>
    @if(Auth::user()->image !='')
    <div class="col-12">
    <img src="{{ asset('files/users/'. Auth::user()->image) }}" class="img-fluid" width="150" alt="{{ Auth::user()->name }}">
    </div>
    @endif

    {!! Form::submit( trans('admin/users/create.text_save') , ['class' => 'btn btn-primary']) !!}

  <!-- /.card-body -->
  {!! Form::close() !!}
</div>
</div>

    @endsection