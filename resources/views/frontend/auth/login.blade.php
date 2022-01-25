@include('frontend.design.header')

<body>
    <div class="overlay"></div>
    <header>

     @include('frontend.design.navbar')
    </header>
 <div class="content-form">
      <div class="container">
        <!--start login form-->
        <div class="login-form">
          <div class="login">
            <div class="overlay"></div>
            <h5>{{ trans('frontend/auth/login.login') }}</h5>
            {!! Form::open(['route'=>'frontend.do_login' , 'method'=>'post' , 'class'=>'fill-in']) !!}
            {!! Form::text('name' ,old('name'), ['class'=>'form-control' , 'placeholder'=> trans('frontend/auth/login.name') ]) !!}
            @error('name')<span class="text-danger">{{ $message }}</span> @enderror
            {!! Form::email('email' ,old('email'), ['class'=>'form-control' , 'placeholder'=>trans('frontend/auth/login.email') ]) !!}
            @error('email')<span class="text-danger">{{ $message }}</span> @enderror
            {!! Form::password('password' , ['class'=>'form-control' , 'placeholder'=>trans('frontend/auth/login.pw') ]) !!}
            @error('password')<span class="text-danger">{{ $message }}</span> @enderror

          
            <div class="forget-password">
                <ul>
                  <li> <a href="{{ route('frontend.password.request') }}">{{ trans('frontend/auth/login.forget_pw') }}</a></li>
                  <li><a class="new-account" href="{{ route('frontend.register_form') }}">{{ trans('frontend/auth/login.register') }}</a></li>
                </ul>
              </div>
              {!! Form::submit( trans('frontend/auth/login.login') , ['class' => 'send']) !!}
    
           {!! Form::close() !!}
          </div>
        </div>

        @include('frontend.design.sidebar')
        <div class="clearfloat" style="clear:both"></div>
    </div>
  </div>
        @include('frontend.design.footer')

    </body>
  </html>























