@extends('frontend.home')
@inject('lesson','App\Models\Lesson')
@inject('lecture','App\Models\Lecture')
@inject('article','App\Models\Article')
@inject('speech','App\Models\Speech')
@inject('fatwas','App\Models\Fatwas')
@inject('religious','App\Models\ReligiousBenefits')
@inject('book','App\Models\Book')





@section('content')




<div class="slider">
  <div class="container">
    @if($sliders->count() > 0)
    <div class="carousel slide carousel-fade" id="carouselExampleFade" data-ride="carousel">
      <div class="carousel-inner">
       @foreach ($sliders as $slider)
       <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}" >
         <img class="d-block w-100 slider-img" src="{{ asset('files/images/'.$slider->image) }}" alt="{{ $slider->title }}" title="{{ $slider->title }}">
        <div class="carousel-caption">
          <h6 class="h3-responsive"><a href="{{ $slider->link }}"  target="_blank" title="{{ $slider->title }}">{{ $slider->title }}</a></h6>
        </div>
      </div> 
       @endforeach
       
      </div>
      @if($sliders->count() > 1)
      <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>

      @endif
     
      @else
      <img class="d-block w-100 slider-img" src="{{ asset('frontend/images/banner.jpg') }}" alt="default" title="{{ setting()->siteName }}">

    </div>
    
     
    @endif
   

  </div>
</div>
<!--start el sheikh news bar-->

<div class="news-bar container">
  <div class="row">
    <h1 class="hamd-news col-md-2">{{ trans('frontend/index/index.news') }}</h1>
    <div class="col-md-8" id="ticker">
      <ul class="news-list">
        <li class="show-news">{{ $news->first_news }}</li>
        <li class="show-news">{{ $news->second_news }}</li>
        <li class="show-news">{{ $news->third_news }}</li>
      </ul>
    </div>
  </div>
</div>



  <!--start new topics in site-->
  <div class="new-topics">
    <div class="container">
      <ul class="row">
        <li class="active" data-content=".articles">{{ trans('frontend/index/index.article_new') }}</li>
        <li data-content=".lessons">{{ trans('frontend/index/index.lesson_new') }}</li>
        <li data-content=".lectures">{{ trans('frontend/index/index.lecture_new') }}</li>
        <li data-content=".speaches">{{ trans('frontend/index/index.speech_new') }}</li>
      </ul>
    </div>
  </div>
  <!--start topics content-->
  <!--start new articles-->
  <div class="new-add articles">
    <div class="container">
      <div class="back">
        <div class="title-add row">
          <div class="col-md-8">{{ trans('frontend/index/index.title-new') }}</div>
          <div class="col-md-3">{{ trans('frontend/index/index.date') }}</div>
        </div>
        <div class="container back-color">
          <div id="wrapper">
            <div class="contents">
              @forelse ($articles as $article)

              <div class="new-content row">
                <div class="col-md-8"> 
                  <a href="{{ route('frontend.articles.article-content', $article->slug) }}" title="{{ $article->name }}">{{ \Illuminate\Support\Str::limit( $article->name, 25 ,'.....') }}</a></div>
                <div class="col-md-3">{{ $article->publish_date }} </div>
              </div>

              @empty
            <div class="text-center">{{ trans('frontend/index/index.noarticle') }}</div>

              @endforelse
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--start new lessons-->
  <div class="new-add lessons hide">
    <div class="container">
      <div class="back">
        <div class="title-add row">
          <div class="col-md-8">{{ trans('frontend/index/index.title-new') }}</div>
          <div class="col-md-3">{{ trans('frontend/index/index.date') }}</div>
        </div>
        <div class="container back-color">
          <div id="wrapper">
            <div class="contents">
            @forelse ($lessons as $lesson)

            <div class="new-content row">
                <div class="col-md-8">
             <a href="{{ route('frontend.lessons.lesson-show', $lesson->slug) }}" title="{{ $lesson->name }}">{{ \Illuminate\Support\Str::limit( $lesson->name, 25 ,'.....')}}</a></div>
                <div class="col-md-3">{{ $lesson->publish_date }} </div>
            </div>

            @empty
            <div class="text-center">{{ trans('frontend/index/index.nolesson') }}</div>

            @endforelse
            
            </div>
              
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--start new lectures-->
  <div class="new-add lectures hide">
    <div class="container">
      <div class="back">
        <div class="title-add row">
          <div class="col-md-8">{{ trans('frontend/index/index.title-new') }}</div>
          <div class="col-md-3">{{ trans('frontend/index/index.date') }}</div>
        </div>
        <div class="container back-color">
          <div id="wrapper">
            <div class="contents">
                @forelse ($lectures as $lecture)
    
                <div class="new-content row">
                    <div class="col-md-8"> <a href="{{ route('frontend.lectures.lecture-content', $lecture->slug) }}" title="{{ $lecture->name }}">{{ \Illuminate\Support\Str::limit( $lecture->name, 25 ,'.....') }}</a></div>
                    <div class="col-md-3">{{ $lecture->publish_date }} </div>
                </div>
    
                @empty
                <div class="text-center">{{ trans('frontend/index/index.nolec') }}</div>
    
                @endforelse
                
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--start new speaches-->
  <div class="new-add speaches hide">
    <div class="container">
      <div class="back">
        <div class="title-add row">
          <div class="col-md-8">{{ trans('frontend/index/index.title-new') }}</div>
          <div class="col-md-3">{{ trans('frontend/index/index.date') }}</div>
        </div>
        <div class="container back-color">
          <div id="wrapper">
            <div class="contents">
                @forelse ($speeches as $speech)
    
                <div class="new-content row">
                    <div class="col-md-8"> <a href="{{ route('frontend.speeches.speech-content', $speech->slug) }}" title="{{ $speech->name }}">{{ \Illuminate\Support\Str::limit( $speech->name, 25 ,'.....') }}</a></div>
                    <div class="col-md-3">{{ $speech->publish_date }} </div>
                </div>
    
                @empty
                <div class="text-center">{{ trans('frontend/index/index.nospeech') }}</div>
    
                @endforelse
                
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--start aside content with all home content-->
  <div class="page-content">
    <div class="container">

     <aside>
      <div class="azan">
        <iframe src="https://timesprayer.com/widgets.php?frame=1&amp;lang=ar&amp;name=kuwait&amp;fcolor=0EA4C4&amp;tcolor=080A03&amp;frcolor=38A616"
         style="border: none; overflow: hidden; width: 100%; height: 129px;" __idm_frm__="46"  rel="nofollow"></iframe>
      </div>
      <div class="twitter-posts"><a  class="twitter-timeline" href="https://twitter.com/DrHamadAlhajri?ref_src=twsrc%5Etfw" rel="nofollow" target="_blank">Tweets by DrHamadAlhajri</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script></div>
      

      <div class="download-vistors">
        <div class="more-topics">
          <ul class="row">
            <li class="active col-md-5" data-content=".more-vistors">{{ trans('frontend/index/index.most_visit') }}</li>
            <li class="col-md-5" data-content=".more-downloads">{{ trans('frontend/index/index.most_down') }}</li>
          </ul>
        </div>
        <div class="download-vistors-links">
          <div class="more-vistors">
            <div class="row">
              @foreach ($lesson_views as $lesson)
              <div class="col-md-12">
                <i class="fas fa-book-reader icon"></i>
                 <a href="{{ route('frontend.lessons.lesson-show', $lesson->slug) }}" title="{{ $lesson->name }}">{{ $lesson->name }}</a>
                </div>
    
              @endforeach

              @foreach ($lecture_views as $lecture)
              <div class="col-md-12">
                <i class="fas fa-book icon"></i>
                 <a href="{{ route('frontend.lectures.lecture-content', $lecture->slug) }}" title="{{ $lecture->name }}">{{ $lecture->name }}</a>
                </div>
    
              @endforeach

              
              @foreach ($speech_views as $speech)
              <div class="col-md-12">
                <i class="fas fa-microphone-alt icon"></i>
                 <a href="{{ route('frontend.speeches.speech-content', $speech->slug) }}" title="{{ $speech->name }}">{{ $speech->name }}</a>
                </div>
    
              @endforeach

                   
              @foreach ($article_views as $article)
              <div class="col-md-12">
                <i class="fas fa-pen-square icon"></i>
                 <a href="{{ route('frontend.articles.article-content', $article->slug) }}" title="{{ $article->name }}">{{ $article->name }}</a>
                </div>
    
              @endforeach

              @foreach ($book_views as $book)
              <div class="col-md-12">
                <i class="fas fa-swatchbook icon"></i>
                 <a href="{{ route('frontend.books.book-content', $book->slug) }}" title="{{ $book->name }}">{{ $book->name }}</a>
                </div>
    
              @endforeach

              @foreach ($benefit_views as $benefit)
              <div class="col-md-12">
                <i class="fas fa-hand-holding-heart icon"></i>
                 <a href="{{ route('frontend.religious-benefits.content', $benefit->slug) }}" title="{{ $benefit->name }}">{{ $benefit->name }}</a>
                </div>
    
              @endforeach
             
            </div>
          </div>
          <div class="more-downloads">
            <div class="row">
              @foreach ($lesson_downloads as $lesson)
              <div class="col-md-12">
                <i class="fas fa-book-reader icon"></i>
                 <a href="{{ route('frontend.lessons.lesson-show', $lesson->slug) }}" title="{{ $lesson->name }}">
                  {{ $lesson->name }}</a>
                </div>
                @endforeach

                @foreach ($lecture_downloads as $lecture)
                <div class="col-md-12">
                  <i class="fas fa-book icon"></i>
                   <a href="{{ route('frontend.lectures.lecture-content', $lecture->slug) }}" title="{{ $lecture->name }}">
                    {{ $lecture->name }}</a>
                  </div>
                  @endforeach

                  @foreach ($speech_downloads as $speech)
                  <div class="col-md-12">
                    <i class="fas fa-microphone-alt icon"></i>
                     <a href="{{ route('frontend.speeches.speech-content', $speech->slug) }}" title="{{ $speech->name }}">
                      {{ $speech->name }}</a>
                    </div>
                    @endforeach

                    @foreach ($article_downloads as $article)
                    <div class="col-md-12">
                      <i class="fas fa-pen-square icon"></i>
                       <a href="{{ route('frontend.articles.article-content', $article->slug) }}" title="{{ $article->name }}">
                        {{ $article->name }}</a>
                      </div>
                      @endforeach

                      @foreach ($book_downloads as $book)
                      <div class="col-md-12">
                        <i class="fas fa-swatchbook icon"></i>
                         <a href="{{ route('frontend.books.book-content', $book->slug) }}" title="{{ $book->name }}">
                          {{ $book->name }}</a>
                        </div>
                        @endforeach

                      
            </div>
          </div>
        </div>
      </div>
    </aside>


      <div class="home-content">
        <div class="counting-all-topics row">
          <div class="counter-style "><i class="fas fa-microphone-alt"></i><span class="counter">{{ $speech->count() }}</span>
            <h5>{{ trans('frontend/index/index.speeches') }}</h5>
          </div>
          <div class="counter-style "><i class="fas fa-question-circle"></i><span class="counter">{{ $fatwas->count() }}</span>
            <h5>{{ trans('frontend/index/index.questions') }}</h5>
          </div>
          <div class="counter-style "><i class="fas fa-book"></i><span class="counter">{{ $lecture->count() }}</span>
            <h5>{{ trans('frontend/index/index.lectures') }}</h5>
          </div>
          <div class="counter-style "><i class="fas fa-book-reader"></i><span class="counter">{{ $lesson->count() }}</span>
            <h5>{{ trans('frontend/index/index.lessons') }}</h5>
          </div>
          <div class="counter-style "><i class="fas fa-hand-holding-heart"></i><span class="counter">{{ $religious->count() }}</span>
            <h5>{{ trans('frontend/index/index.benefits') }}</h5>
          </div>
          <div class="counter-style "><i class="fas fa-pen-square"></i><span class="counter">{{ $article->count() }}</span>
            <h5>{{ trans('frontend/index/index.articles') }}</h5>
          </div>
          <div class="counter-style "><i class="fas fa-swatchbook"></i><span class="counter">{{ $book->count() }}</span>
            <h5>{{ trans('frontend/index/index.books') }}</h5>
          </div>
        </div>


        <!--start email subscribe newsletter-->
        <div class="subscribe-email">
          <h5>{{ trans('frontend/index/index.subscribe') }}</h5>
        
            {!! Form::open(['route' =>'frontend.add_subscribe' , 'method'=>'post' , 'class'=>'all-input']) !!}
           
            {!! Form::email('email' , old('email') , ['class' => 'form-control' ,'placeholder'=> trans('frontend/index/index.email')]) !!}

            {!! Form::submit( trans('frontend/index/index.sub')  , ['class' => 'accept']) !!}

            {!! Form::close() !!}
          
        </div>


        <!--start ask for fatwa-->

        <div class="fatawa-ask">
          <div class="overlay"></div>
          <h5>{{ trans('frontend/index/index.ques') }}</h5>

            {!! Form::open(['route' =>'frontend.add_fatwas' , 'method'=>'post' , 'class'=>'fill-in']) !!}
    
              {!! Form::text('name' , old('name') , ['class' => 'prev-name form-control' ,'placeholder'=>trans('frontend/index/index.name')]) !!}
              {{-- @error('name')<span class="text-danger">{{ $message }}</span> @enderror --}}
              <span class="error-name"></span>
              {!! Form::email('email' , old('email') , ['class' => 'prev-email form-control' ,'placeholder'=>trans('frontend/index/index.email')]) !!}
              {{-- @error('email')<span class="text-danger">{{ $message }}</span> @enderror --}}
              <span class="error-email"></span>
              {!! Form::textarea('message' , old('message') , ['class' => 'prev-massage form-control' ,'placeholder'=>trans('frontend/index/index.message')]) !!}
              {{-- @error('message')<span class="text-danger">{{ $message }}</span> @enderror --}}
              <span class="error-massage"></span>
              {!! Form::submit(trans('frontend/index/index.send')  , ['class' => 'send-your-ask']) !!}

            {!! Form::close() !!}
          
        </div>
      </div>
    </div>
  </div>
  <div class="clearfloat" style="clear:both"></div>
  <div class="lib-video-audio">
    <div class="container">
      <div class="row">
        
        
        <div class="last-video-updated col-lg-7"><i class="fas fa-tv"></i>
          <h4>{{ trans('frontend/index/index.videos') }}</h4>

        
          <div class="video-iframe">
            @foreach ($videos as $video)
            @php
            $url = getYoutubeId($video->youtubeLink)  
            @endphp
            @if($url)
            <iframe src="https://www.youtube.com/embed/{{ $url }}" frameborder="0"  allowfullscreen="">
            </iframe>
           
            @endif
        @endforeach
          </div>
        
         
          <button ><a href="{{ route('frontend.videos.all-videos') }}" title="{{ trans('frontend/index/index.morevideos') }}">{{ trans('frontend/index/index.morevideos') }}</a></button>
        </div>




        <div class="last-audio-updated col-lg-5"><i class="fas fa-microphone-alt"></i>
          <h4>{{ trans('frontend/index/index.audios') }}</h4>
          <div class="audio-links">
           
            <ul>
               
                @foreach ($audios as $audio)
              <li><i class="fas fa-volume-up"></i><a href="{{route('frontend.audios.audio-content' , $audio->slug) }}" title={{ $audio->name }} >{{ $audio->name }}</a></li>
              @endforeach
             
            </ul>
           
          </div>
          <button><a href="{{ route('frontend.audios.all-audios') }}"  title="{{ trans('frontend/index/index.more') }}">{{ trans('frontend/index/index.more') }}</a> </button>
        </div>
      </div>
    </div>
  </div>
 
@endsection