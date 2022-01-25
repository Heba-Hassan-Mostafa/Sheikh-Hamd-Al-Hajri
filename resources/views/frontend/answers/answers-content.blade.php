@section('header')
<meta name="keywords" content="اسئلة,اجوبة,فتاوى,الشيخ,حمد">
<meta name="description" content="اسئلة واجوبة الاستاذ الدكتور حمد بن محمد الهاجرى استاذ الفقة المقارن والسياسة الشرعية كلية الشريعة جامعة الكويت">
<meta name="author" content="{{ setting()->siteName }}">
@endsection
@include('frontend.design.header')

  <body>
    <div class="overlay"></div>
    <header>
      <!-- start first-nav-->
      @include('frontend.design.navbar')

    </header>
    <div class="content-category">
      <h1 class="benefits-name">{{ trans('frontend/index/index.questions') }}</h1>
      <div class="container">
        
        <h6 class="qus-name"> {{ trans('frontend/pages/all.ques') }} </h6>
        <hr>
        <div class="qustion">{{ $answer->fatwas->message }}</div>
        
        <h6 class="qus-name"> {{ trans('frontend/pages/all.ans') }}</h6>
        <hr>
        <div class="answer-qustion">  
          <div class="audio">
            @if(!empty($answer->mp3File))
           
          
          <a class="link-to-down" download href="{{ asset('/files/questions/audios/'.$answer->mp3File) }}">{{ trans('frontend/pages/all.download') }} <i class="fas fa-download"> </i></a>
          <audio src="{{ asset('/files/questions/audios/'.$answer->mp3File) }}" controls controlsList="nodownload"></audio>
        @endif
          </div>
          
          <br>
            {!! $answer->answer !!}
       
        </div>
      </div>
    </div>
    <!--start footer-->
    @include('frontend.design.footer')

   
  </body>
</html>