@section('header')
<meta name="keywords" content="{{ $book->keywords }}">
<meta name="description" content="{{ $book->description }}">
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
        <div class="row switch">
          <div class="col-md-6 content-book">
            <h1 class="content-title-name">{{ $book->name }}</h1>
            <div class="filter"><i class="fas fa-level-down-alt icon-path"></i>
              <span><a href="{{ route('frontend.books.books')}}" title="{{ trans('frontend/index/index.books') }}">{{ trans('frontend/index/index.books') }}</a></span>
              <i class="far fa-window-minimize dash-icon"></i><span><a href="{{ route('frontend.category.books', $book->category->slug )}}" title="{{ $book->category->name }}">{{ $book->category->name }}</a></span></div>
            <div class="details row">
              <div class="col-6"><i class="fas fa-calendar-alt"></i>{{ trans('frontend/pages/all.date') }}</div>
              <div class="col-6">{{ $book->publish_date }}</div>
              <div class="col-6"> <i class="fas fa-eye"></i>{{ trans('frontend/pages/all.view_num') }}</div>
              <div class="col-6">{{ $book->view_count }}</div>
              <div class="col-6"><i class="fas fa-download"> </i>{{ trans('frontend/pages/all.down_num') }}</div>
              <div class="col-6 downloaders">{{ $book->download_count }}</div>
              <div class="col-5 share-media"> <i class="fas fa-share-alt"></i>{{ trans('frontend/pages/all.share') }}</div>
              <div class="col-md-7 social-media-sharing">

                <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url={{ route('frontend.books.book-content',$book->slug) }}&ct=1&title={{ $book->name }}{{ setting()->siteName }}&pco=tbxnj-1.0"
                  rel="nofollow" target="_blank">
                <i class="fab fa-facebook-f facebook"></i>
              </a>
              
              <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url={{ route('frontend.books.book-content',$book->slug) }}&ct=1&title={{ $book->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
                  rel="nofollow" target="_blank">
                <i class="fab fa-twitter twitter"></i>
              </a>
              
              <a href="https://api.addthis.com/oexchange/0.8/forward/whatsapp/offer?url={{ route('frontend.books.book-content',$book->slug) }}&ct=1&title={{ $book->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
                  rel="nofollow" target="_blank">
              <i class="fab fa-whatsapp whatsapp"></i>
              </a>
              
              <a href="https://api.addthis.com/oexchange/0.8/forward/messenger/offer?url={{ route('frontend.books.book-content',$book->slug) }}&ct=1&title={{ $book->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
                rel="nofollow" target="_blank">
              <i class="fab fa-facebook-messenger messenger"></i>
              </a>
              
              <a href="https://api.addthis.com/oexchange/0.8/forward/telegram/offer?url={{ route('frontend.books.book-content',$book->slug) }}&ct=1&title={{ $book->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
                rel="nofollow" target="_blank">
                <i class="fab fa-telegram-plane telegram"></i>
              </a>
              
              <a href="https://api.addthis.com/oexchange/0.8/forward/gmail/offer?url={{ route('frontend.books.book-content',$book->slug) }}&ct=1&title={{ $book->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
                rel="nofollow" target="_blank">
                <i class="fas fa-envelope gmail"></i>
              </a>
      
                </div>
                  </div>
          
            <hr>
            <h6>{{ $book->name }}</h6>
            <p>{{ $book->note }}</p>
          </div>
          <div class="col-md-6 book-img">
            <div class="article-img">
              @if(!empty($book->image))
              <img class="img-fluid" src="{{ asset('/files/books/images/'.$book->image) }}" alt="{{ $book->name }}" title="{{ $book->name }}"></div>
              @endif
          </div>
        </div>
        <hr>
        <div class="down-share row">
          <div class="col-md-6 download">
            <ul class="click-download" ><i class="fas fa-download"></i>{{ trans('frontend/pages/all.download') }}
              <i class="fas fa-file-pdf" style="color: #d60000;font-size: 18px;"></i>
              @if(!empty($book->pdf_file))
              @foreach (json_decode($book->pdf_file) as $file)
              <li>
                <i class="fas fa-file-pdf"></i>
                <a   id="download-numbers" href="{{ asset('/files/books/'.$file) }}"  download >{{ $file }}</a>
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