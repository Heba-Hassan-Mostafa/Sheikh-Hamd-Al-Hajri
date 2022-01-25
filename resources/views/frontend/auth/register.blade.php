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
              <h5>{{ trans('frontend/auth/login.register') }}</h5>
              {!! Form::open(['route'=>'frontend.do_register' , 'method'=>'post' , 'class'=>'fill-in']) !!}
              {!! Form::text('name' ,old('name'), ['class'=>'form-control' , 'placeholder'=>trans('frontend/auth/login.name')]) !!}
              @error('name')<span class="text-danger">{{ $message }}</span> @enderror
              {!! Form::email('email' ,old('email'), ['class'=>'form-control' , 'placeholder'=>trans('frontend/auth/login.email')]) !!}
              @error('email')<span class="text-danger">{{ $message }}</span> @enderror
             <span style="font-weight: bold; color: red;text-align: right;display: block;margin-top:8px">برجاء ادخال كود الدولة قبل رقم الهاتف</span>            
             {!! Form::text('phone' ,old('phone'), ['class'=>'form-control','style'=>"margin:0px", 'placeholder'=>trans('frontend/auth/login.phone')]) !!}
              @error('phone')<span class="text-danger">{{ $message }}</span> @enderror
              {!! Form::password('password' , ['class'=>'form-control' , 'placeholder'=>trans('frontend/auth/login.pw')]) !!}
              @error('password')<span class="text-danger">{{ $message }}</span> @enderror
              {!! Form::password('password_confirmation' , ['class'=>'form-control' , 'placeholder'=>trans('frontend/auth/login.pw_confirm')]) !!}
                {!! Form::submit(trans('frontend/auth/login.register'), ['class' => 'send']) !!}


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
  