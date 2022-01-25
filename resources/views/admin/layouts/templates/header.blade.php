<!DOCTYPE html>
<html dir="{{ direction() }}" lang="{{ lang() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> {{ !empty($title) ? $title : trans('admin/users/index.title') }} </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="adminId" content="{{ auth()->check() ? auth()->id() : '' }}">

  
  <link rel="icon" href="{{ asset('/files/home/images/'.setting()->icon) }}" />


  <!-- DataTables -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
  
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <link href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />  
     <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatable2/css/dataTables.bootstrap4.css') }}" >
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" > --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatable2/css/rowReorder.dataTables.css') }}" >
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatable2/css/buttons.dataTables.css') }}">



    <link rel="stylesheet" href="{{ asset('adminlte/plugins/toggle/mdb.min.css') }}">

    {{-- file manager for ckeditor --}}
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">


    {{-- <link href="{{ asset('adminlte/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" /> --}}

    @if(direction() == 'ltr')
      <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{asset('adminlte/css/myedit.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  @else
  <link rel="stylesheet" href="{{asset('adminlte/rtl/plugins/fontawesome-free/css/all.min.css')}}">
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <link rel="stylesheet" href="{{asset('adminlte/rtl/css/adminlte.min.css')}}">
   <link rel="stylesheet" href="{{asset('adminlte/rtl/css/myedit-ar.css')}}">


    <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('adminlte/rtl/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
 <!-- Bootstrap 4 RTL -->
 <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="{{ asset('adminlte/rtl/css/custom.css') }}">
 <style type="text/css">
   html,body ,h1,h2,h3,h4,h5,h6,.alert
   {
    font-family: 'Cairo', sans-serif !important;
   }
 </style>
  @endif

  @livewireStyles
</head>
  