@include('frontend.design.header')

  <body>
    <div class="overlay"></div>
    <header>
      <!-- start first-nav-->
      @include('frontend.design.navbar')

    </header>
    <div class="content-category">
      <div class="container">
        <h1 class="content-title-name">{{ $audio->name }}</h1>
          <div class="filter"><i class="fas fa-level-down-alt icon-path"></i>
          <span>
            @if($audio->audioable_type == "lesson" && $audio->audioable_id == $lessons->id)

            {{ $lesson }}

            @elseif($audio->audioable_type == "lecture" && $audio->audioable_id == $lectures->id)
            {{ $lecture }}

            @elseif($audio->audioable_type == "speech" && $audio->audioable_id == $speeches->id)
            {{ $speech }}
            @endif
          
          
          </span></div>
        <div class="details row">
          <div class="col-6"><i class="fas fa-calendar-alt"></i>{{ trans('frontend/pages/all.date') }}</div>
          <div class="col-6">{{ $audio->publish_date }}</div>
          <div class="col-6"> <i class="fas fa-eye"></i>{{ trans('frontend/pages/all.view_num') }}</div>
          <div class="col-6">{{ $audio->view_count }}</div>
          <div class="col-6"><i class="fas fa-download"> </i>{{ trans('frontend/pages/all.down_num') }}</div>
          <div class="col-6 downloaders">{{ $audio->download_count }}</div>
          <div class="col-5 share-media"> <i class="fas fa-share-alt"></i>{{ trans('frontend/pages/all.share') }}</div>
          <div class="col-11 social-media-sharing">

            <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url={{ route('frontend.audios.audio-content',$audio->slug) }}&ct=1&title={{ $audio->name }}{{ setting()->siteName }}&pco=tbxnj-1.0"
              rel="nofollow" target="_blank">
            <i class="fab fa-facebook-f facebook"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url={{ route('frontend.audios.audio-content',$audio->slug) }}&ct=1&title={{ $audio->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
              rel="nofollow" target="_blank">
            <i class="fab fa-twitter twitter"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/whatsapp/offer?url={{ route('frontend.audios.audio-content',$audio->slug) }}&ct=1&title={{ $audio->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
              rel="nofollow" target="_blank">
          <i class="fab fa-whatsapp whatsapp"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/messenger/offer?url={{ route('frontend.audios.audio-content',$audio->slug) }}&ct=1&title={{ $audio->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
            rel="nofollow" target="_blank">
          <i class="fab fa-facebook-messenger messenger"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/telegram/offer?url={{ route('frontend.audios.audio-content',$audio->slug) }}&ct=1&title={{ $audio->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
            rel="nofollow" target="_blank">
            <i class="fab fa-telegram-plane telegram"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/gmail/offer?url={{ route('frontend.audios.audio-content',$audio->slug) }}&ct=1&title={{ $audio->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
            rel="nofollow" target="_blank">
            <i class="fas fa-envelope gmail"></i>
          </a>
  
            </div>
          </div>
        <hr>
        <div class="audio">
          @if(!empty($audio->audioFile))
          <a class="link-to-down" href="{{ asset('/files/audios/'.$audio->audioFile) }}" >{{ trans('frontend/pages/all.download') }} <i class="fas fa-download"> </i></a>
          <audio src="{{ asset('/files/audios/'.$audio->audioFile) }}" controls controlslist="nodownload"></audio>
        @endif
        </div>

        <div class="audio-embed">
          @php
          $url = getYoutubeId($audio->embedLink)  
          @endphp
          @if($url)
          <iframe src="https://www.youtube.com/embed/{{ $url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
          </iframe>
          @endif
        </div>
      </div>
    </div>
  <!--start footer-->
    @include('frontend.design.footer')



    <script>
         $(document).on('click','.link-to-down',function(){

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