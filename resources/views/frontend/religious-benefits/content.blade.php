@section('header')
<meta name="keywords" content="{{ $benefit->keywords }}">
<meta name="description" content="{{ $benefit->description }}">
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
        <h1 class="content-title-name">{{ $benefit->name }}</h1>
        <div class="filter"><i class="fas fa-level-down-alt icon-path"></i>
          <span><a href="{{ route('frontend.religious-benefits.benefits')}}" title="{{ trans('frontend/index/index.benefits') }}">{{ trans('frontend/index/index.benefits') }}</a></span>
          <i class="far fa-window-minimize dash-icon"></i><span><a href="{{ route('frontend.category.benefits', $benefit->category->slug )}}" title="{{ $benefit->category->name }}">{{ $benefit->category->name }}</a></span></div>
        <div class="details row">
          <div class="col-6"><i class="fas fa-calendar-alt"></i>{{ trans('frontend/pages/all.date') }}</div>
          <div class="col-6">{{ $benefit->publish_date }}</div>
          <div class="col-6"> <i class="fas fa-eye"></i>{{ trans('frontend/pages/all.view_num') }}</div>
          <div class="col-6">{{ $benefit->view_count }}</div>
          <div class="col-5 share-media"> <i class="fas fa-share-alt"></i>{{ trans('frontend/pages/all.share') }}</div>
          <div class="col-md-7 social-media-sharing">

            <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url={{ route('frontend.religious-benefits.content',$benefit->slug) }}&ct=1&title={{ $benefit->name }}{{ setting()->siteName }}&pco=tbxnj-1.0"
              rel="nofollow" target="_blank">
            <i class="fab fa-facebook-f facebook"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url={{ route('frontend.religious-benefits.content',$benefit->slug) }}&ct=1&title={{ $benefit->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
              rel="nofollow" target="_blank">
            <i class="fab fa-twitter twitter"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/whatsapp/offer?url={{ route('frontend.religious-benefits.content',$benefit->slug) }}&ct=1&title={{ $benefit->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
              rel="nofollow" target="_blank">
          <i class="fab fa-whatsapp whatsapp"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/messenger/offer?url={{ route('frontend.religious-benefits.content',$benefit->slug) }}&ct=1&title={{ $benefit->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
            rel="nofollow" target="_blank">
          <i class="fab fa-facebook-messenger messenger"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/telegram/offer?url={{ route('frontend.religious-benefits.content',$benefit->slug) }}&ct=1&title={{ $benefit->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
            rel="nofollow" target="_blank">
            <i class="fab fa-telegram-plane telegram"></i>
          </a>
          
          <a href="https://api.addthis.com/oexchange/0.8/forward/gmail/offer?url={{ route('frontend.religious-benefits.content',$benefit->slug) }}&ct=1&title={{ $benefit->name }}{{ setting()->siteName }}&pco=tbxnj-1.0" 
            rel="nofollow" target="_blank">
            <i class="fas fa-envelope gmail"></i>
          </a>
  
            </div>
        </div>
        <hr>
        <h6>{{ $benefit->name }}</h6>
        <hr>
        <br>
         {!! $benefit->content !!}
        <hr>
      </div>
    </div>
    <!--start footer-->
    @include('frontend.design.footer')



   
  </body>
</html>