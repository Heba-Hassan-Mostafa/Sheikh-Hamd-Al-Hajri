
@extends('admin.layouts.admin')


@section('content')

<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $title }}</h3>
    </div>
    {{-- {!! Form::open(['url'=>adminUrl('user'),]) !!} --}}
    {!! Form::model($role,[
                     'action'=>['WebController\RoleController@update' , $role->id],
                     'id'=>'myForm',
                     'method'=>'PUT'
      ])!!}
    <!-- /.card-header -->
    <div class="card-body">

      <div class="form-group">
        {!! Form::label('name' , trans('admin/roles/create.text_name')) !!}
        {!! Form::text('name' , null , ['placeholder' => 'Name','class' => 'form-control']) !!}
     </div>
    
     <div class="form-group">
       {!! Form::label('permission' , trans('admin/roles/create.text_permission')) !!}
       <br>
       <input id="selectAll" type="checkbox"> <label for='selectAll'> {{ trans('admin/roles/create.select_all') }} </label>
       <br>
       <div class="row">
          @foreach ($permission->all() as $value)
              <div class="col-sm-3">
    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}                {{ $value->name }}
    
              </div>
          @endforeach
    
       </div>
    </div>

      {!! Form::submit( trans('admin/roles/create.text_save') , ['class' => 'btn btn-primary']) !!}

   </div>
    <!-- /.card-body -->
    {!! Form::close() !!}
  </div>

  @push('scripts')
  <script>
    $("#selectAll").click(function() {
  $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
  });

    $("input[type=checkbox]").click(function() {
   if (!$(this).prop("checked")) {
      $("#selectAll").prop("checked", false);
  }
    });

  </script>
@endpush

@endsection

