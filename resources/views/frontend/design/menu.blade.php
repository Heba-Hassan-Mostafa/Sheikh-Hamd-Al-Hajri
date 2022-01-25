 <!-- start first-nav-->
 <nav class="first-nav">
    <div class="container">
      <div class="row">
        <div class=" col-md-6 p-acount">

          <div class="personal-account dropdown">
            <i class="fas fa-user account"></i>
            <button class="btn btn-secondary dropdown-toggle" type="button"
             id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             {{ trans('frontend/index/index.account') }}
            </button>
            <div class="personal-account-setting dropdown-menu" aria-labelledby="dropdownMenuButton">

              
              @if(!session()->has('data'))
              <a class="dropdown-item" href="{{ route('frontend.login_form') }}">{{ trans('frontend/index/index.login') }}</a>
              <a class="dropdown-item" href="{{ route('frontend.register_form') }}">{{ trans('frontend/index/index.register') }}</a>
        @else
      
              <span class="dropdown-item" style="font-weight: bold ;color:#fff;pointer-events: none;">  {{ trans('frontend/index/index.hello') }} {{ session('data')['name'] }}</span>
              <a class="dropdown-item" href="{{ route('frontend.do_logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ trans('frontend/index/index.logout') }} </a>
              <form id="logout-form" action="{{ route('frontend.do_logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
             
           @endif
              
            </div>
          </div> 
         </div>

        <div class="live-air col-md-6">

          <div class=" dropdown">
            <i class="fas fa-wifi"></i>
            <button class="btn btn-secondary dropdown-toggle" type="button"
             id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             {{ trans('frontend/index/index.live') }}
            </button>
            <div class="live-air-setting dropdown-menu" aria-labelledby="dropdownMenuButton">


              <a class="dropdown-item" href="{{ route('frontend.live-air.live') }}" title="{{ trans('frontend/index/index.livevideo') }}"> {{ trans('frontend/index/index.livevideo') }}</a>
              <a class="dropdown-item" href="{{ route('frontend.live-air.live-sound') }}" title="{{ trans('frontend/index/index.liveaudio') }}">  {{ trans('frontend/index/index.liveaudio') }} </a>
            </div>
          </div>
          
          
          <div> <i class="fas fa-phone contact-call"></i><a class="contact-us" href="{{ route('frontend.contacts.contact-us') }}">{{ trans('frontend/index/index.contacts') }}</a></div>
          
          
          
          <div class=" dropdown">
            <i class="fas fa-globe-americas lang-icon"></i>
            <button class="btn btn-secondary dropdown-toggle" type="button"
             id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             {{ trans('frontend/index/index.lang') }}
            </button>
            <div class="live-air-setting dropdown-menu" aria-labelledby="dropdownMenuButton">


              <a class="dropdown-item" href="{{ url('lang/ar') }}" title=""> {{ trans('frontend/index/index.ar') }}</a>
              <a class="dropdown-item" href="{{ url('lang/en') }}" title="">  {{ trans('frontend/index/index.en') }}  </a>
            </div>
          </div>
        

         </div>




      </div>
    </div>
  </nav>
  @include('frontend.design.errors.validation-errors')

  <!-- end first-nav-->
  <!-- start logo with social media options-->
  <div class="welcome container row">
    <div class="logo col-md-6 col-sm-12"><a href="{{ route('frontend.index') }}">

      @if(!empty(setting()->logo))
      <img class="img-fluid" src="{{ asset('/files/home/images/'.setting()->logo) }}" title="{{ setting()->siteName }}" alt="{{ setting()->siteName }}" />
     @endif
      </a>
    </div>
 

    <div class="options col-md-6 col-sm-12">
      <div class="social-media">
        <a href="{{ setting()->twitter_url }}" target="_blank" rel="nofollow"><i class="fab fa-twitter twitter" title="twitter"></i></a>
        <a href="{{ setting()->instagram_url }}" target="_blank" rel="nofollow" ><i class="fab fa-instagram instagram" title="instagram"></i></a>
        <a href="{{ setting()->telegram_url }}" target="_blank" rel="nofollow"><i class="fab fa-telegram-plane telegram" title="telegram"></i></a>
        <a href="{{ setting()->youtube_url }}" target="_blank" rel="nofollow"><i class="fab fa-youtube youtube" title="youtube"></i></a>
        <a href="{{ setting()->facebook_url }}" target="_blank" rel="nofollow"><i class="fab fa-facebook-f facebook" title="facebook"></i></a>
      </div>
     
     
      {!! Form::open(['route'=>'frontend.search' , 'method'=>'get' , 'class'=>'search-content']) !!}
      {!! Form::text('keyword' , old('keyword', request()->keyword) , ['class' => 'form-control input-search' ,'placeholder'=> trans('frontend/index/index.search') ]) !!}
      {!! Form::button('<i class="fas fa-search"></i>',['type'=>'submit' , 'class'=>'start-search']) !!}
      {!! Form::close() !!}
    </div>
  </div>
  <!-- end logo with social media options-->