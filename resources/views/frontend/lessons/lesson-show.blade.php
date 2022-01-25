@section('header')
<meta name="keywords" content="{{ $lesson->keywords }}">
<meta name="description" content="{{ $lesson->description }}">
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
      <div class="container">
        <h1 class="content-title-name">{{ $lesson->name }}</h1>

        

        <div class="filter"><i class="fas fa-level-down-alt icon-path"></i><span>
          <a href="{{ route('frontend.lessons.lessons')}}" title="{{ trans('frontend/index/index.lessons') }}">{{ trans('frontend/index/index.lessons') }}</a></span><i class="far fa-window-minimize dash-icon"></i>
          <span><a href="{{ route('frontend.category.lessons', $lesson->category->slug )}}" title="{{ $lesson->category->name }}">{{ $lesson->category->name }}</a></span></div>
        <div class="details row">
          <div class="col-6"><i class="fas fa-calendar-alt"></i>{{ trans('frontend/pages/all.date') }}</div>
          <div class="col-6">{{ $lesson->publish_date }}</div>
          <div class="col-6"> <i class="fas fa-eye"></i>{{ trans('frontend/pages/all.view_num') }}</div>
          <div class="col-6">{{ $lesson->view_count }}</div>
          <div class="col-6"><i class="fas fa-download"> </i>{{ trans('frontend/pages/all.down_num') }}</div>
          <div class="col-6 downloaders">{{{ $lesson->download_count }}} </div>
          <div class="col-5 share-media"> <i class="fas fa-share-alt"></i>{{ trans('frontend/pages/all.share') }}</div>
          <div class="col-md-7 social-media-sharing">

            <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url={{ route('frontend.lessons.lesson-show',$lesson->slug) }}&ct=1&title={{ $lesson->name }}{{ setting()->siteName }}&pco=tbxnj-1.0"
              rel="nofollow" target="_blank">
            <i class="fab fa-facebook-f facebook"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url={{ route('frontend.lessons.lesson-show',$lesson->slug) }}&ct=1&title={{ $lesson->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
              rel="nofollow" target="_blank">
            <i class="fab fa-twitter twitter"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/whatsapp/offer?url={{ route('frontend.lessons.lesson-show',$lesson->slug) }}&ct=1&title={{ $lesson->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
              rel="nofollow" target="_blank">
          <i class="fab fa-whatsapp whatsapp"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/messenger/offer?url={{ route('frontend.lessons.lesson-show',$lesson->slug) }}&ct=1&title={{ $lesson->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
            rel="nofollow" target="_blank">
          <i class="fab fa-facebook-messenger messenger"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/telegram/offer?url={{ route('frontend.lessons.lesson-show',$lesson->slug) }}&ct=1&title={{ $lesson->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
            rel="nofollow" target="_blank">
            <i class="fab fa-telegram-plane telegram"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/gmail/offer?url={{ route('frontend.lessons.lesson-show',$lesson->slug) }}&ct=1&title={{ $lesson->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
            rel="nofollow" target="_blank">
            <i class="fas fa-envelope gmail"></i>
          </a>
  
            </div>
        </div>
        <hr>
        <div class="audio" >
        
          @foreach ($lesson->audios as $audio)
          @if(!empty($audio->audioFile))
          
          <a class="link-to-down" download href="{{ asset('/files/audios/'.$audio->audioFile) }}">{{ trans('frontend/pages/all.download') }} <i class="fas fa-download"> </i></a>
          <audio  src="{{ asset('/files/audios/'.$audio->audioFile) }}" controls controlsList="nodownload"></audio>
          

        @endif
        @endforeach
        </div>
       
        <div class="audio-embed">
          @foreach ($lesson->audios as $audio)
          @php
          $url = getYoutubeId($audio->embedLink)  
          @endphp
          @if($url)
    <iframe src="https://www.youtube.com/embed/{{ $url }}" frameborder="0"  allowfullscreen></iframe>
    @endif
    @endforeach
  </div>
         
   
        <div class="video-embed">
          @foreach ($lesson->videos as $video)
          @php
          $url = getYoutubeId($video->youtubeLink)  
          @endphp
          @if($url)
      <iframe src="https://www.youtube.com/embed/{{ $url }}" frameborder="0"  allowfullscreen></iframe>
      @endif
      @endforeach
      </div>
     
       {!! $lesson->content !!}
      
        <hr>
        <div class="down-share row">
          <div class="download">
            <ul   class="click-download" >
              <i class="fas fa-download"></i>
              {{ trans('frontend/pages/all.download') }}
              <i class="fas fa-file-pdf" style="color: #d60000;font-size: 18px;"></i>
              @if(!empty($lesson->pdf_file))
              @foreach (json_decode($lesson->pdf_file) as $file)
              <li>
                <i class="fas fa-file-pdf"></i>
                <a id="download-numbers" href="{{ asset('/files/lessons/'.$file) }}"  download >{{ $file }}</a>
              </li> 
              @endforeach
              @else
              <li style="cursor: context-menu;color: red;"> {{ trans('frontend/pages/all.down_message') }}</li>
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--start footer-->
    @include('frontend.design.footer')

    
   
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5fe36606d814c14d"></script>
   
    
   

   <script>
     
    

      $(document).on('click','#download-numbers , .link-to-down',function(){

        var  firstNum = $('.downloaders'),
            effect = $('.downloaders').text();

         effect++;

      $(firstNum).text(effect++);

     var newValue = $(firstNum).text();
     
  

        $.ajax({
            url:'{{ URL::current() }}',
            type: "get",
            dataType: "json",
            data: {'download_count' : newValue},
            success: function(data){
              console.log('done');
            }
          });
        

      });
      

     
        


   </script> 

  </body>
</html>