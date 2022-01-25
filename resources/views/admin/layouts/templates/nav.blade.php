<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{url('admin/home')}}" class="nav-link">{{ trans('admin/template/common.text_home') }}</a>
    </li>
   
  </ul>

  <!-- SEARCH FORM -->
  <form class="form-inline ml-3">
    <div class="input-group">
      {{-- <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search"> --}}
      {{-- <div class="input-group-append">
        <button class="btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div> --}}
    </div>
  </form>
  @include('admin.layouts.templates.menu')
</nav>
<!-- /.navbar -->

