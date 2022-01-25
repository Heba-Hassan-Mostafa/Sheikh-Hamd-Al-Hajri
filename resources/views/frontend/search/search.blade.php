@include('frontend.design.header')
  <body>
    <div class="overlay"></div>
    <header>
      <!-- start first-nav-->
      @include('frontend.design.navbar')
    </header>
    <div class="content-form">
      <div class="container">
        <!--start live-air-->
        <div class="live-air-content">
            <h1 class="live-air-text"> {{ trans('frontend/index/index.search') }} </h1>

            @if($keyword)
            <div class="search-content-result">
              <div class="row">

              @if($lessons->count() > 0)
                <div class="col-12 search-outline">
                  <h4 class="title-search">{{ trans('frontend/index/index.lessons') }}</h4>
                  <hr>
                  <div class="row">
                    @foreach ($lessons as $lesson)
                    <div class="col-md-12 col-lg-6 select-search">
                      <i class="fas fa-book-reader"></i>
                      <a class="search-link" href="{{ route('frontend.lessons.lesson-show',$lesson->slug) }}">{{ $lesson->name }}</a>
                      <hr>
                    </div>

                    @endforeach
                   
                   
                   
                  </div>
                </div>
                @endif

                @if($lectures->count() > 0)
                <div class="col-12 search-outline">
                  <h4 class="title-search">{{ trans('frontend/index/index.lectures') }}</h4>
                  <hr>
                  <div class="row">
                    @foreach($lectures as $lecture)

                    <div class="col-md-12 col-lg-6 select-search">
                      <i class="fas fa-book"></i>
                      <a class="search-link" href="{{ route('frontend.lectures.lecture-content',$lecture->slug) }}">{{ $lecture->name }}</a>
                      <hr>
                    </div>

                    @endforeach
                   
                  
                   
                  </div>
                </div>
                @endif

                @if($speeches->count() > 0)
                <div class="col-12 search-outline">
                  <h4 class="title-search">{{ trans('frontend/index/index.speeches') }}</h4>
                  <hr>
                  <div class="row">
                    @foreach ($speeches as $speech)
                    <div class="col-md-12 col-lg-6 select-search">
                      <i class="fas fa-microphone-alt"></i>
                      <a class="search-link" href="{{ route('frontend.speeches.speech-content',$speech->slug) }}">{{ $speech->name }}</a>
                      <hr>
                    </div>
                    @endforeach
                   

                   
                  </div>
                </div>
                @endif

                @if($articles->count() > 0)
                <div class="col-12 search-outline">
                  <h4 class="title-search">{{ trans('frontend/index/index.articles') }}</h4>
                  <hr>
                  <div class="row">
                    @foreach ($articles as $article)
                    <div class="col-md-12 col-lg-6 select-search">
                      <i class="fas fa-pen-square"></i>
                      <a class="search-link" href="{{ route('frontend.articles.article-content',$article->slug) }}">{{ $article->name }}</a>
                      <hr>
                    </div>
                    @endforeach
                  </div>
                </div>
                @endif


                @if($books->count() > 0)
                <div class="col-12 search-outline">
                  <h4 class="title-search">{{ trans('frontend/index/index.books') }}</h4>
                  <hr>
                  <div class="row">
                    @foreach ($books as $book)

                    <div class="col-md-12 col-lg-6 select-search">
                      <i class="fas fa-swatchbook"></i>
                      <a class="search-link" href="{{ route('frontend.books.book-content',$book->slug) }}">{{ $book->name }}</a>
                      <hr>
                    </div>  
                    @endforeach
                  </div>
                </div>
                @endif

                {{-- <div class="col-12 search-outline">
                  <h4 class="title-search">اسئلة واجوبة</h4>
                  <hr>
                  <div class="row">
                    
                    <div class="col-md-12 col-lg-6 select-search">
                      <i class="fas fa-question-circle"></i>
                      <a class="search-link" href="#">دروس فى السنة النبوية</a>
                      <hr>
                    </div>
                   
                  </div>
                </div> --}}

                @if($benefits->count() > 0)

                <div class="col-12 search-outline">
                  <h4 class="title-search">{{ trans('frontend/index/index.benefits') }}</h4>
                  <hr>
                  <div class="row">
                    @foreach ($benefits as $benefit)
                    <div class="col-md-12 col-lg-6 select-search">
                      <i class="fas fa-hand-holding-heart"></i>
                      <a class="search-link" href="{{ route('frontend.religious-benefits.content',$benefit->slug) }}">{{ $benefit->name }}</a>
                      <hr>
                    </div>
                    @endforeach
                    

                  
                   
                  </div>
                </div>

                @endif

              </div>
            </div>
            @else 
            <span style="display: block;text-align: center;font-size: 70px;color: #8e1b1b;"> <i class="fas fa-exclamation-triangle"></i> </span>
            @endif

          </div>
        
      
        <div class="clearfloat" style="clear:both"></div>
      </div>
    </div>
    @include('frontend.design.footer')

  </body>
  </html>