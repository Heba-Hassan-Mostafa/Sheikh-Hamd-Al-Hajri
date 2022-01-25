<ul class="navbar-nav postion-setting">
   
  <admin-notification></admin-notification>
  
     <!-- language Dropdown Menu -->
     <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-globe"></i> {{ trans('admin/template/common.language') }} <i class="fas fa-chevron-down"></i>
      </a>
      <ul class="dropdown-menu">

         <li>
          <a href="{{ url('lang/en') }}" class="dropdown-item">
            <i class="fas fa-flag"></i> English </a>
         </li>
         <li>
          <a href="{{ url('lang/ar') }}" class="dropdown-item">
            <i class="fas fa-flag"></i> عربى </a>
         </li>
     

      </ul>
    </li> 

    {{-- Settings dropdown --}}

    <li class="nav-item dropdown">      
    {{-- Change Password --}}
      <a class="nav-link" data-toggle="dropdown" href="#">
        <span> {{ trans('admin/template/common.welcome') }}  {{  auth()->user()->name  }} </span>
        <i class="fas fa-chevron-down">
        </i>
      </a>


      <div class="dropdown-menu">

         {{-- Profile --}}
       
          <a href="{{adminUrl('user/info')}}" class="dropdown-item">
            <i class="fa fa-user"></i>   {{ trans('admin/template/common.profile') }}
          </a>
       
        
       
  
         {{-- Setting --}}
         <a href="{{ adminUrl('settings') }}" class="dropdown-item">
          <i class="fa fa-cog"></i>   {{ trans('admin/template/common.text_setting') }}
        </a>
        
      
        {{-- Change Password --}}
        <a href="{{adminUrl('user/change-password')}}" class="dropdown-item">
          <i class="fas fa-key"></i>   {{ trans('admin/template/common.text_change_password') }}
        </a>

      
     {{-- LogOut --}}

     <a class="dropdown-item" href="{{ url('admin/logout') }}"
     onclick="event.preventDefault();document.getElementById('logout-form').submit();"> 
     <i class="fas fa-sign-out-alt"></i>
     {{ trans('admin/template/common.text_log_out') }}</a>
     {!! Form::open(['method' => 'post', 'url' => url('admin/logout'),'id'=>'logout-form']) !!}
      @csrf
     {!! Form::close() !!}

    </div>
      
    </li> 


  </ul>
               
