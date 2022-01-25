@section('header')
<meta name="keywords" content="البث,الصوتى,الشيخ,حمد,الهاجرى,دينية,اسلامية,مقاطع,صوتى">
<meta name="description" content="البث الصوتي للشيخ الدكتور حمد بن محمد الهاجرى فى علوم الشريعة والفقة المقارن والسياسة الشرعية">

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
        <h1 class="live-air-text benefits-name">{{ trans('frontend/index/index.live') }}</h1>

        <!--start live-air-->
        <div class="live-air-content">
            <div class="live-air">

              <iframe src="https://mixlr.com/users/8885383/embed" width="100%" height="180px" scrolling="no"
               frameborder="no" marginheight="0" marginwidth="0">
              </iframe>
              <small>
                <a href="https://mixlr.com/drhamadalhajri"
                 style="color:#1a1a1a;text-align:left; font-family:Helvetica, sans-serif; font-size:11px;">
                </a>
              </small>
    
            </div>

          </div>
        
      
        <div class="clearfloat" style="clear:both"></div>
      </div>
    </div>
    @include('frontend.design.footer')

  </body>
  </html>