<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ adminUrl('home') }}" class="brand-link">
    <img src="{{ asset('adminlte/img/AdminLTELogo.png') }}"
         alt="AdminLTE Logo"
         class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text">Hamd El-HAJRI</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar" style="font-weight:bold;overflow:overlay;">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="display: block!important">
      <div class="image" style="text-align: center">
        @if (auth()->user()->image != '')
        <img src="{{ asset('files/users/' . auth()->user()->image) }}" class="img-circle elevation-2" alt="User Image" 
        style="max-width: 50%;
        border-radius: 50%;
        width:auto">
    @else
        <img  src="{{ asset('adminlte/img/default.jpg') }}" class="img-circle elevation-2" alt="User Image" style="max-width: 50%;
        border-radius: 50%;
        width:auto">
    @endif
      </div>
      <div class="info" 
        style="
          display: block;
          text-align: center;
          margin-top: 10px;
          font-size: 18px;
          color: #fff;">
        {{ Auth::user()->name }}
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

            {{-- Dashboard --}}
        <li class="nav-item has-treeview active">
          <a  href="{{ adminUrl('home') }}" class="nav-link" style="padding:10px;">
            <i class="nav-icon fas fa-tachometer-alt"></i>
               <p>{{ trans('admin/template/common.text_general_statistics') }}</p>
          </a>
      </li>


                  {{-- slider --}}
              <li class="nav-item has-treeview active">
                <a  href="{{ adminUrl('slider') }}" class="nav-link" style="padding:10px;">
                  <i class="fas fa-images"></i>
                    <p>{{ trans('admin/template/common.slider') }}</p>
                </a>
            </li>

                {{-- Categories --}}
                <li class="nav-item has-treeview active">
                  <a  href="{{ adminUrl('category') }}" class="nav-link" style="padding:10px;">
                    <i class="fa fa-list"></i>
                      <p>{{ trans('admin/template/common.text_category') }}</p>
                  </a>
              </li>

              {{-- Lessons --}}
              <li class="nav-item has-treeview active">
                <a  href="{{ adminUrl('lesson') }}" class="nav-link" style="padding:10px;">
                  <i class="fas fa-book-open"></i>
                    <p>{{ trans('admin/template/common.text_lesson') }}</p>
                </a>
            </li>

            {{-- Lectures --}}
            <li class="nav-item has-treeview active">
              <a  href="{{ adminUrl('lecture') }}" class="nav-link" style="padding:10px;">
                <i class="fas fa-book"></i>
                  <p>{{ trans('admin/template/common.text_lecture') }}</p>
              </a>
          </li>

          {{-- Speeches --}}
          <li class="nav-item has-treeview active">
            <a  href="{{ adminUrl('speech') }}" class="nav-link" style="padding:10px;">
              <i class="fas fa-microphone-alt"></i>
              <p>{{ trans('admin/template/common.text_speech') }}</p>
            </a>
          </li>


              {{-- Articles --}}
          <li class="nav-item has-treeview active">
            <a  href="{{ adminUrl('article') }}" class="nav-link" style="padding:10px;">
              <i class="fas fa-pen-square"></i>
              <p>{{ trans('admin/template/common.text_article') }}</p>
            </a>
          </li>

          {{-- Books --}}
          <li class="nav-item has-treeview active">
            <a  href="{{ adminUrl('book') }}" class="nav-link" style="padding:10px;">
              <i class="fas fa-swatchbook"></i>
              <p>{{ trans('admin/template/common.text_book') }}</p>
            </a>
          </li>


        {{-- ReligiousBenefits --}}
    <li class="nav-item has-treeview active">
      <a  href="{{ adminUrl('religious-benefits') }}" class="nav-link" style="padding:10px;">
        <i class="fas fa-hand-holding-heart"></i>
        <p>{{ trans('admin/template/common.text_benefits') }}</p>
      </a>
    </li>

            {{-- Library --}}
        <li class="nav-item has-treeview">
          <a href="" class="nav-link">
            <i class="fas fa-film"></i>
              <p>{{ trans('admin/template/common.text_library') }}</p>
              <i class="right fas fa-angle-left"></i>
            </a>
              <ul class="nav nav-treeview" style="padding: 0 18px;">
                <li class="nav-item active">
                  <a href="{{ adminUrl('video') }}" class="nav-link">
                    <i class="fas fa-tv"></i>
                    <p>{{ trans('admin/template/common.videos') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ adminUrl('audio') }}" class="nav-link">
                    <i class="fas fa-volume-up"></i> 
                  <p>{{ trans('admin/template/common.audios') }}</p>
                  </a>
                </li>
              </ul>
      
        </li>

            {{-- Fatwas --}}
            <li class="nav-item has-treeview active">
              <a  href="{{ adminUrl('fatwas') }}" class="nav-link" style="padding:10px;">
                <i class="fas fa-question-circle"></i>
                <p>{{ trans('admin/template/common.fatwas') }}</p>
              </a>
          </li>


              {{-- Question --}}
            <li class="nav-item has-treeview active">
              <a  href="{{ adminUrl('answer') }}" class="nav-link" style="padding:10px;">
                <i class="fas fa-question-circle"></i>
                <p>{{ trans('admin/template/common.question') }}</p>
              </a>
          </li>


        {{-- live --}}
        <li class="nav-item has-treeview active">
          <a  href="{{ adminUrl('live') }}" class="nav-link">
            <i class="fas fa-wifi"></i>
               <p>{{ trans('admin/template/common.text_live') }}</p>
          </a>
      </li>
      
      {{-- Sheikh News --}}
      <li class="nav-item has-treeview active">
        <a  href="{{ adminUrl('news') }}" class="nav-link">
          <i class="far fa-newspaper"></i>
             <p>{{ trans('admin/template/common.text_news') }}</p>
        </a>
    </li>


          {{-- Users --}}
          <li class="nav-item has-treeview {{ activeMenu('user')[0] }}">
            <a href="" class="nav-link">
              <i class="fas fa-users-cog"></i>
                <p>{{ trans('admin/template/common.text_users') }}</p>
                <i class="right fas fa-angle-left"></i>
              </a>
                <ul class="nav nav-treeview {{ activeMenu('user')[1] }} " style="padding: 0 18px;">
                  <li class="nav-item active">
                    <a href="{{ adminUrl('user') }}" class="nav-link">
                      <i class="fa fa-user-circle"></i>
                      <p>{{ trans('admin/template/common.users_list') }}</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ adminUrl('role') }}" class="nav-link">
                      <i class="fas fa-user-lock"></i>
                      <p>{{ trans('admin/template/common.users_roles') }}</p>
                    </a>
                  </li>
                </ul>
            
        </li>


      


          
            {{-- Clients --}}
            <li class="nav-item has-treeview active">
              <a  href="{{ adminUrl('client') }}" class="nav-link" style="padding:10px;">
                <i class="fa fa-users"></i>
                   <p>{{ trans('admin/template/common.clients') }}</p>
              </a>
          </li>

           {{-- subcribers --}}
           <li class="nav-item has-treeview active">
            <a  href="{{ adminUrl('subcriber') }}" class="nav-link" style="padding:10px;">
              <i class="fa fa-users"></i>
                 <p>{{ trans('admin/template/common.subcribers') }}</p>
            </a>
        </li>

         

        
           {{-- Contacts --}}
           <li class="nav-item has-treeview active">
            <a  href="{{ adminUrl('contact') }}" class="nav-link" style="padding:10px;">
              <i class="fas fa-phone"></i>
                 <p>{{ trans('admin/template/common.contacts') }}</p>
            </a>
        </li>

      


          
            {{-- Settings --}}
        <li class="nav-item has-treeview active">
          <a  href="{{ adminUrl('settings') }}" class="nav-link">
            <i class="fa fa-cogs"></i>
               <p>{{ trans('admin/template/common.text_setting') }}</p>
          </a>
      </li>




      {{-- <li class="nav-item has-treeview ">

      <a class="nav-link" href="{{ route('logout') }}"
      onclick="event.preventDefault();document.getElementById('logout-form').submit();"> 
      <i class="fas fa-sign-out-alt"></i>
      {{ trans('admin/template/common.text_log_out') }}</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

        @csrf

    </form>
      </li> --}}

      
  </ul>
 
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>