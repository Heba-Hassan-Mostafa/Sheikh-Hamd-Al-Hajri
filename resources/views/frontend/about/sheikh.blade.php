@section('header')
<meta name="keywords" content="عن الشيخ,السيرة الذاتية,نبذة عن الشيخ,اعمال الشيخ,الشيخ حمد بن محمد الهاجرى">
<meta name="description" content=" السيرة الذاتية عن الشيخ ا.د حمد بن محمد الهاجرى استاذ الفقة المقارن والسياسة الشرعية كلية الشريعة جامعة الكويت نبذة عن فضيلة الشيخ الدكتور ا.د. حمد بن محمد الهاجرى">
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
        <div class="about">
          <h1>{{ trans('frontend/index/index.about') }}</h1>
          
            {!! $setting->about_sheikh !!}
          
        </div>
        @include('frontend.design.sidebar')
        <div class="clearfloat" style="clear:both"></div>
      </div>
    </div>
    @include('frontend.design.footer')

  </body>
  </html>