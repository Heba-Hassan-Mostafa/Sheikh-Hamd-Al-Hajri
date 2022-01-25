@extends('admin.layouts.admin')


@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>

    <div class="card-body">

        {!! Form::open([
                'action'=>'WebController\UserController@changePasswordSave',
                'id'=>'myForm',
                'method'=>'POST'
        ])!!}
    

        <div class="form-group">
            {!! Form::label('current_password' , trans('admin/users/create.text_old_password')) !!}
            {!! Form::password('current_password'  , ['class' => 'form-control']) !!}
        </div>
       <div class="form-group">
        {!! Form::label('password' , trans('admin/users/create.text_password')) !!}
        {!! Form::password('password'  , ['class' => 'form-control']) !!}
     </div>
     <div class="form-group">
        {!! Form::label('password_confirmation' , trans('admin/users/create.text_password_confirmation')) !!}
        {!! Form::password('password_confirmation'  , ['class' => 'form-control']) !!}
     </div>

    {!! Form::submit( trans('admin/users/create.text_save') , ['class' => 'btn btn-primary']) !!}

    {!! Form::close()!!}

        
    </div>
</div>

    @endsection