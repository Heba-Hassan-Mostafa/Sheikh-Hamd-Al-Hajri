@section('header')
<meta name="keywords" content="اتصل بنا">
<meta name="description" content="اتصل بنا">
<meta name="author" content="{{ setting()->siteName }}">
@endsection
@include('frontend.design.header')
  <body>
    <div class="overlay"></div>
    <header>
      <!-- start first-nav-->
      @include('frontend.design.navbar')
    </header>
    <div class="content-form">
      <div class="container">
        <!--start login form-->
        <div class="login-form">
          <div class="login">
            <div class="overlay"></div>
      <h5>{{ trans('frontend/index/index.contacts') }} </h5>
            {!! Form::open(['route' =>'frontend.do_contact' , 'method'=>'post' ,'class' =>'fill-in' ]) !!}
    
              {!! Form::text('name' , old('name') , ['class' => 'form-control' ,'placeholder'=>trans('frontend/index/index.name')]) !!}
              @error('name')<span class="text-danger">{{ $message }}</span> @enderror
              {!! Form::email('email' , old('email') , ['class' => 'form-control' ,'placeholder'=>trans('frontend/index/index.email')]) !!}
              @error('email')<span class="text-danger">{{ $message }}</span> @enderror
              <span style="font-weight: bold; color: red;text-align: right;display: block;margin-top:8px">برجاء ادخال كود الدولة قبل رقم الهاتف</span> 
              {!! Form::text('phone' , old('phone') , ['class' => 'form-control' ,'style'=>"margin:0px",'placeholder'=>trans('frontend/auth/login.phone')]) !!}
              @error('phone')<span class="text-danger">{{ $message }}</span> @enderror
              {!! Form::textarea('message' , old('message') , ['class' => 'form-control' ,'placeholder'=>trans('frontend/index/index.message')]) !!}
              @error('message')<span class="text-danger">{{ $message }}</span> @enderror
              {!! Form::submit(trans('frontend/index/index.send')  , ['class' => 'send']) !!}

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