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
              <h5>{{ trans('frontend/auth/login.put_email') }}</h5>
              {!! Form::open(['route'=>'frontend.password.email' , 'method'=>'post' , 'class'=>'fill-in']) !!}
              {!! Form::email('email' ,old('email'), ['class'=>'form-control' , 'placeholder'=>trans('frontend/auth/login.email')]) !!}
              @error('email')<span class="text-danger">{{ $message }}</span> @enderror
                {!! Form::submit(trans('frontend/auth/login.send'), ['class' => 'send']) !!}
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
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  