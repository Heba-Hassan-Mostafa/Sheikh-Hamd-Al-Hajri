@include('admin.layouts.templates.header')

<body class="hold-transition sidebar-mini">


<div id="app">
    <div class="wrapper">

@include('admin.layouts.templates.nav')
@include('admin.layouts.templates.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>@yield('page_title')</h1>
                      <small>@yield('small_title')</small>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="{{url('admin/home')}}">{{ trans('admin/template/common.text_home') }}</a></li>
                          <li class="breadcrumb-item active">{{ trans('admin/template/common.text_dashboard') }}</li>
                      </ol>
                  </div>
                 

              </div>
            
          </div><!-- /.container-fluid -->
      </section>
      @include('admin.layouts.errors.validation-errors')
    @yield('content')
    </div>
</div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
          <b></b>
        </div>
        <strong>Copyright &copy; <a href="#"> Sheikh Hamd Al-HAJRI </a>.</strong> All rights
        reserved.
      </footer>
    
</div>



    @include('admin.layouts.templates.footer')
