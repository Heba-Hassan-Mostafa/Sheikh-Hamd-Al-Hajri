@section('header')
<meta name="keywords" content="المكتبة,المرئية,الشيخ,حمد,الهاجرى,دينية,اسلامية,مقاطع,صوتية,مرئية,تحميل">
<meta name="description" content="المكتبة المرئية للشيخ الدكتور حمد بن محمد الهاجرى فى علوم الشريعة والفقة المقارن والسياسة الشرعية">

<meta name="author" content="{{ setting()->siteName }}">
@endsection
@include('frontend.design.header')

  <body>
    <div class="overlay"></div>
    <header>
      <!-- start first-nav-->
      @include('frontend.design.navbar')

    </header>

    <h1 class="lib-videos-text"> <i class="fas fa-tv"></i>{{ trans('frontend/index/index.videos') }}</h1>
    <div class="container">
      <div id="wrapper">
        <div class="contents row">
          @foreach ($videos as $video)
          @php
          $url = getYoutubeId($video->youtubeLink)  
          @endphp
          @if($url)
          <div class="col-lg-6 video-embed-lib">
            <iframe  src="https://www.youtube.com/embed/{{ $url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
          </div>
           
          @endif
          @endforeach
        </div>
        {!! $videos->links() !!}
      </div>
    </div>
     <!--start footer-->
    @include('frontend.design.footer')

   
  </body>
</html>