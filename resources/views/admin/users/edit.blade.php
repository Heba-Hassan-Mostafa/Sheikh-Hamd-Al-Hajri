
@extends('admin.layouts.admin')


@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>
    {!! Form::model($model,[
                     'action'=>['WebController\UserController@update' , $model->id],
                     'id'=>'myForm',
                     'method'=>'PUT',
                     'files'=>true ,
                     'enctype' =>'multipart/form-data'
      ])!!}
    <!-- /.card-header -->
    <div class="card-body">


      <div class="form-group">
        {!! Form::label('name' , trans('admin/users/create.text_name')) !!}
        {!! Form::text('name' , old('name', $model->name) , ['class' => 'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('email' , trans('admin/users/create.text_email')) !!}
        {!! Form::email('email' , old('email', $model->email) , ['class' => 'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('password' , trans('admin/users/create.text_password')) !!}
        {!! Form::password('password'  , ['class' => 'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('password_confirmation' , trans('admin/users/create.text_password_confirmation')) !!}
        {!! Form::password('password_confirmation'  , ['class' => 'form-control']) !!}
     </div>
     <div class="form-group">
      {!! Form::label('mobile', trans('admin/users/info.mobile')) !!}
      {!! Form::text('mobile', old('mobile', $model->mobile), ['class' => 'form-control']) !!}
  </div>
     {{-- <div class="form-group">
      {!! Form::label('receive_email' , trans('admin/users/info.receive_email')) !!}
      {!! Form::select('receive_email' , ['1' =>trans('admin/users/info.yes') , '0'=>trans('admin/users/info.no') ],
        old('receive_email' , $model->receive_email) , ['class' => 'form-control']) !!}
   </div> --}}
   
    @if($model->image !='')
    <div class="col-12">
    <img src="{{ asset('/files/users/'.$model->image) }}" class="img-fluid" width="150" alt="{{ $model->name }}">
    </div>
    @endif
     <div class="form-group">
      {!! Form::label('image' , trans('admin/users/info.text_image')) !!}
      {!! Form::file('image', ['class' => 'form-control style-inp']) !!} 
      </div>
    
     <div class="form-group">
      
       {!! Form::label('roles' , trans('admin/users/create.text_roles')) !!}
       {!! Form::select('roles[]', $roles , $userRole , ['class' => 'roles form-control style-inp','multiple'=>'multiple']) !!}
      
      </div>
      {!! Form::submit( trans('admin/users/create.text_save') , ['class' => 'btn btn-primary']) !!}

   </div>
    <!-- /.card-body -->
    {!! Form::close() !!}
  </div>


  @push('select')
  <script type="text/javascript">

    $(document).ready(function() {
    $('.roles').select2();
});

  </script>
  @endpush
@endsection

