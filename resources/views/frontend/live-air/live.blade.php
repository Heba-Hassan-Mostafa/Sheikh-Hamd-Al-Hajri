@section('header')
<meta name="keywords" content="البث,المرئى,الشيخ,حمد,الهاجرى,دينية,اسلامية,مقاطع,مرئى">
<meta name="description" content="البث المرئى للشيخ الدكتور حمد بن محمد الهاجرى فى علوم الشريعة والفقة المقارن والسياسة الشرعية">

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

                @if(!empty($live->live_link))
                @php
                $url = getYoutubeId($live->live_link)
                    
                @endphp
                @if($url)
              <iframe style="max-width:100%" width="720" height="420" src="https://www.youtube.com/embed/{{ $url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="">
            </iframe>
            @endif
            @else
            <iframe style="max-width:100%" width="720" height="420" src="https://www.youtube.com/embed/" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="">
            </iframe>
            <h6 class="alram-text">  {{ trans('frontend/pages/all.live_mes') }} </h6>
            @endif
   
            </div>

          </div>
        
      
        <div class="clearfloat" style="clear:both"></div>
      </div>
    </div>
    @include('frontend.design.footer')

  </body>
  </html>