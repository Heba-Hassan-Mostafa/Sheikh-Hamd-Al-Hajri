@section('header')
<meta name="keywords" content="{{ $article->keywords }}">
<meta name="description" content="{{ $article->description }}">
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
        <h1 class="content-title-name">{{ $article->name }}</h1>
        <div class="filter"><i class="fas fa-level-down-alt icon-path"></i>
          <span><a href="{{ route('frontend.articles.articles')}}" title="{{ trans('frontend/index/index.articles') }}">{{ trans('frontend/index/index.articles') }}</a></span><i class="far fa-window-minimize dash-icon"></i>
          <span><a href="{{ route('frontend.category.articles', $article->category->slug )}}" title="{{ $article->category->name }}">{{ $article->category->name }}</a></span></div>
        <div class="details row">
          <div class="col-6"><i class="fas fa-calendar-alt"></i>{{ trans('frontend/pages/all.date') }}</div>
          <div class="col-6">{{ $article->publish_date }}</div>
          <div class="col-6"> <i class="fas fa-eye"></i>{{ trans('frontend/pages/all.view_num') }}</div>
          <div class="col-6">{{ $article->view_count }}</div>
          <div class="col-6"><i class="fas fa-download"> </i>{{ trans('frontend/pages/all.down_num') }}</div>
          <div class="col-6 downloaders">{{ $article->download_count }}</div>
          <div class="col-5 share-media"> <i class="fas fa-share-alt"></i>{{ trans('frontend/pages/all.share') }}</div>

          <div class="col-md-7 social-media-sharing">

            <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url={{ route('frontend.articles.article-content',$article->slug) }}&ct=1&title={{ $article->name }}{{ setting()->siteName }}&pco=tbxnj-1.0"
              rel="nofollow" target="_blank">
            <i class="fab fa-facebook-f facebook"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url={{ route('frontend.articles.article-content',$article->slug) }}&ct=1&title={{ $article->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
              rel="nofollow" target="_blank">
            <i class="fab fa-twitter twitter"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/whatsapp/offer?url={{ route('frontend.articles.article-content',$article->slug) }}&ct=1&title={{ $article->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
              rel="nofollow" target="_blank">
          <i class="fab fa-whatsapp whatsapp"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/messenger/offer?url={{ route('frontend.articles.article-content',$article->slug) }}&ct=1&title={{ $article->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
            rel="nofollow" target="_blank">
          <i class="fab fa-facebook-messenger messenger"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/telegram/offer?url={{ route('frontend.articles.article-content',$article->slug) }}&ct=1&title={{ $article->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
            rel="nofollow" target="_blank">
            <i class="fab fa-telegram-plane telegram"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/gmail/offer?url={{ route('frontend.articles.article-content',$article->slug) }}&ct=1&title={{ $article->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
            rel="nofollow" target="_blank">
            <i class="fas fa-envelope gmail"></i>
          </a>
  
            </div>
        </div>
        <hr>
        

          {!! $article->content !!}
        <hr>
        <div class="down-share">
          <div class="download">
            <ul  class="click-download" ><i class="fas fa-download"></i>
              {{ trans('frontend/pages/all.download') }}
              <i class="fas fa-file-pdf" style="color: #d60000;font-size: 18px;"></i>
              @if(!empty($article->pdf_file))
              @foreach (json_decode($article->pdf_file) as $file)
              <li>
                <i class="fas fa-file-pdf"></i>
                <a  id="download-numbers" href="{{ asset('/files/articles/'.$file) }}"  download >{{ $file }}</a>
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

    
   
   
    
   

   <script>
     
    
     $(document).on('click','#download-numbers',function(){

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